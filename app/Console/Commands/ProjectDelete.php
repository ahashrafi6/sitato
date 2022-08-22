<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Notifications\DeleteNotification;
use App\Notifications\LastDeleteNotification;
use Illuminate\Console\Command;
use App\Traits\Site\LiaraApi;

class ProjectDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'project delete';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // last notify delete
        $last_notify_date = now()->subDays(3)->toDateTimeString();
        $last_notify = Project::where('status' , 'freeze')->where('lastNotify' , false)->whereDate('payment_end' , '<=' , $last_notify_date)->with(['user'])->take(2)->get();
        foreach ($last_notify as $project) {
            
                   $project->user->notify(new LastDeleteNotification($project));   
                   $update = $project->update(['lastNotify' => true]);
        }


        // delete notify
        $delete_date = now()->subDays(5)->toDateTimeString();
        $delete_notify = Project::where('status' , 'freeze')->whereDate('payment_end' , '<=' , $delete_date)->with(['user'])->take(2)->get();
        foreach ($delete_notify as $project) {
        
            // freeze project
            $app = LiaraApi::delete_app($project->username);
            $db = LiaraApi::delete_database($project->liara_database_id);

            if($app->successful() && $db->successful()){

                $update = $project->update(['status' => 'delete' , 'liara_app_id' => null , 'liara_database_id' => null]);
                if($update){
                    // notification freeze
                   $project->user->notify(new DeleteNotification($project));
                }
            }
            
        }


    }
}
