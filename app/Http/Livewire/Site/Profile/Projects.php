<?php

namespace App\Http\Livewire\Site\Profile;

use App\Jobs\ReleaseProject;
use App\Models\Factor;
use App\Models\Project as ModelsProject;
use Livewire\Component;
use Livewire\WithPagination;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as Paymenter;
use App\Traits\Site\LiaraApi;

class Projects extends Component
{
    use WithPagination;
    public $count = 10;

    public $username;

    public $username_exist = false;

    protected function rules()
    {
        return [
            'username' => 'required|unique:projects,username',
        ];
    }

    public function support($project_id)
    {
        $project = ModelsProject::find($project_id);
        $plan = $project->plan;

        $price = $plan->price * 15 / 100;

        $user = auth()->user();

        $factor = Factor::create([
            'user_id' => $user->id,
            'final_price' => round($price),
            'type' => 'support',
            'items' => [
                'support' => [
                    'month' => $plan->support,
                ],
                'project_id' => $project->id
            ],
        ]);


        $invoice = (new Invoice)->amount($factor->final_price)
            ->detail([
                'description' => 'پرداخت فاکتور',
                'email' => $user->email,
                'mobile' => $user->phone,
            ]);



        $json = Paymenter::callbackUrl(url('/payments/verify'))
            //->via('idpay')
            ->purchase(
                $invoice,
                function ($driver, $transactionId) use ($factor) {
                    session()->put('zarinpal.payments.transaction_id', $transactionId);
                    session()->put('zarinpal.payments.factor_id', $factor->id);
                }
            )->pay()->toJson();
        return redirect(json_decode($json)->action);


        $this->emit('fail-alert');
    }

    public function Username($type, $project_id)
    {
        $this->validate();

        $project =  ModelsProject::find($project_id)->with('server')->first();

        // check username on liara
        $created = LiaraApi::create_project([
            'name' => $this->username,
            'planID' => $project->server->server_id,
            'platform' => $project->platform,
        ]);

        if ($created->successful()) {

            // create database
            $database = LiaraApi::create_database([
                'hostname' => $this->username . '-db',
                'publicNetwork' => true,
                'planID' => $project->server->database_id,
                'type' => 'mariadb',
                'version' => '10.5'
            ]);

            // create disks
            $storage = LiaraApi::create_disk($this->username , [
                'name' => 'storage',
                'size' => '3'
            ]);
            $store = LiaraApi::create_disk($this->username , [
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
               $envs = LiaraApi::get_project($this->username);
               $app_id = $envs['project']['_id'];
               $envs = $envs['project']['envs'];
              


               foreach($db_array as $key => $item){
                $envs[] = [
                        'key' => $key,
                        'value' => $item
                ];
               }
               LiaraApi::update_env([
                'project' => $this->username,
                'variables' => $envs
                ]);
                
            }


            // update project
            // set username and install status
            $project->update(['username' => $this->username, 'liara_database_id' => $db_id , 'liara_app_id' => $app_id, 'status' => 'install']);


            // uplaod source and create release on job
            ReleaseProject::dispatch($project);


            session()->flash('success');
            return redirect()->to(route('projects'));


        } else {

            $this->username_exist = true;
        }
    }

    public function render()
    {
        $user = auth()->user();
        $projects = $user->projects()->latest()->paginate($this->count);


        return view('livewire.site.profile.projects', [
            'projects' => $projects
        ])->layout('layouts.profile');
    }
}
