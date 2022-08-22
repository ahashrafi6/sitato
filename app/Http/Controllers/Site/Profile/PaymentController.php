<?php

namespace App\Http\Controllers\Site\Profile;

use App\Http\Controllers\Controller;
use App\Jobs\ReleaseProject;
use App\Models\Factor;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Shetabit\Payment\Facade\Payment as Paymenter;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use App\Traits\Site\LiaraApi;

class PaymentController extends Controller
{

    public function verify(Request $request)
    {
        $user = auth()->user();

        $transactionId = session()->get('zarinpal.payments.transaction_id', null);
        $factorId = session()->get('zarinpal.payments.factor_id', null);


        session()->forget('zarinpal.payments.transaction_id');
        session()->forget('zarinpal.payments.factor_id');

        $factor = Factor::where('id', $factorId)
            ->where('user_id', $user->id)
            ->first();



        if (!empty($factor)) {
            try {
                $receipt = Paymenter::amount($factor->final_price)->transactionId($transactionId)->verify();
                $referenceId = $receipt->getReferenceId();


                if ($referenceId) {

                    // update factor
                    $factor->update(['status' => true, 'refNumber' => $referenceId, 'paid_at' => now()]);

                    switch ($factor->type) {
                        case 'factor':

                            // forget cart
                            session()->forget('cart');

                            // create project
                            foreach ($factor->items as $item) {
                                $user->projects()->create([
                                    'product_id' => $item['product_id'],
                                    'plan_id' => $item['plan_id'],
                                    'server_id' => $item['server_id'],
                                    'month' => $item['per'],
                                    'support_at' => now()->addMonths($item['plan']['support']),
                                    'payment_start' => now(),
                                    'payment_end' => now()->addMonths($item['per']),
                                ]);
                            }

                            // redirect to project lists with success session pay
                            return redirect(route('projects', ['success-payment' => true]));

                            break;

                        case 'plan':

                            // add plan to project
                            $project = Project::find($factor->items['project_id']);
                            $project->update(['plan_id' => $factor->items['plan']['id']]);

                            // add env plan to liara project


                            // redirect to project lists with success session pay
                            return redirect(route('project', ['project' => $project->username, 'type' => 'plan', 'success-plan' => true]));

                            break;

                        case 'server':

                            // add server to project
                            $project = Project::find($factor->items['project_id']);
                            $project->update([
                                'server_id' => $factor->items['server']['id'],
                                'payment_start' => now(),
                                'payment_end' => now()->addMonths($factor->items['month']),
                                'month' => $factor->items['month'],
                                'lastNotify' => false
                            ]);

                            // active status app and database
                           LiaraApi::scale($project->username , ['scale' => 1]);
                            LiaraApi::database_scale($project->liara_database_id , ['scale' => 1]);

                            // redirect to project lists with success session pay
                            return redirect(route('project', ['project' => $project->username, 'type' => 'server', 'success-server' => true]));

                            break;

                        case 'renew':

                            // add server to project
                            $project = Project::find($factor->items['project_id'])->with('server')->first();
                            $project->update([
                                'server_id' => $factor->items['server']['id'],
                                'payment_start' => now(),
                                'payment_end' => now()->addMonths($factor->items['month']),
                                'month' => $factor->items['month'],
                                'lastNotify' => false
                            ]);

                            // crate project and database on liara
                            $created = LiaraApi::create_project([
                                'name' => $project->username,
                                'planID' => $project->server->server_id,
                                'platform' => $project->platform,
                            ]);

                            if ($created->successful()) {

                                // create database
                                $database = LiaraApi::create_database([
                                    'hostname' => $project->username . '-db',
                                    'publicNetwork' => true,
                                    'planID' => $project->server->database_id,
                                    'type' => 'mariadb',
                                    'version' => '10.6.8'
                                ]);
                    
                                // create disks
                                $storage = LiaraApi::create_disk($project->username , [
                                    'name' => 'storage',
                                    'size' => '3'
                                ]);
                                $store = LiaraApi::create_disk($project->username , [
                                    'name' => 'store',
                                    'size' => '15'
                                ]);
                    
                    
                                $app_id = null;
                                $db_id = null;
                                if($database->successful()){
                    
                                   // sleep 2s while database complete create
                                   sleep(2);
                    
                                   $db_data = LiaraApi::get_database($database['databaseID']);
                    
                             
                                   $db_host = $db_data['database']['hostname'];
                                   $db_name = $db_data['database']['dbName'];
                                   $db_username = $db_data['database']['username'];
                                   $db_password = $db_data['database']['root_password'];
                                   $db_port = $db_data['database']['internalPort'];
                                   $db_id = $db_data['database']['_id'];
                                   
                                   $db_array =  [
                                    'DB_CONNECTION' => 'mysql',
                                    'DB_HOST' => $db_host,
                                    'DB_DATABASE' => $db_name,
                                    'DB_USERNAME' => $db_username,
                                    'DB_PASSWORD' => $db_password,
                                    'DB_PORT' => $db_port,
                                    ];
                    
                                   // add database env
                                   $envs = LiaraApi::get_project($project->username);
                                   $app_id = $envs['project']['_id'];
                                   $envs = $envs['project']['envs'];
                                  
                    
                    
                                   foreach($db_array as $key => $item){
                                    $envs[] = [
                                            'key' => $key,
                                            'value' => $item
                                    ];
                                   }
                                   LiaraApi::update_env([
                                    'project' => $project->username,
                                    'variables' => $envs
                                    ]);
                                    
                                }
                    
                    
                                // update project
                                // set username and install status
                                $project->update(['liara_database_id' => $db_id , 'liara_app_id' => $app_id, 'status' => 'install']);
                    
                    
                                // uplaod source and create release on job
                                ReleaseProject::dispatch($project);
                    

                            }


                            // redirect to project lists with success session pay
                            return redirect(route('projects', ['success-renew' => true]));

                            break;


                        case 'support':

                            $project = Project::find($factor->items['project_id']);

                            if ($project->support_at > now()) {
                                $from = $project->support_at;
                                $support_at = Carbon::parse($from)->addMonths($factor->items['support']['month'])->toDateTimeString();
                            } else {
                                $from = Carbon::now();
                                $support_at = Carbon::now()->addMonths($factor->items['support']['month'])->toDateTimeString();
                            }

                            // add server to project

                            $project->update([
                                'support_at' => $support_at,
                            ]);

                            // redirect to project lists with success session pay
                            return redirect(route('projects', ['success-support' => true]));

                            break;
                    }
                } else {
                    // fail pay redurect to cart
                    return redirect(route('cart', ['fail-payment' => true]));
                }
            } catch (InvalidPaymentException $exception) {
                echo $exception->getMessage();
            }
        }
    }
}
