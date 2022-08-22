<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Notifications\FreezeNotification;
use Illuminate\Console\Command;
use App\Traits\Site\LiaraApi;

class ProjectFreeze extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:freeze';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'peoject freeze';

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
        $projects = Project::whereIn('status' , ['active' , 'disable' , 'username'])->whereDate('payment_end' , '<=' , now())->with(['user'])->take(2)->get();
   

        foreach ($projects as $project) {
        
            // freeze project
            $app = LiaraApi::scale($project->username , ['scale' => 0]);
            $db = LiaraApi::database_scale($project->liara_database_id , ['scale' => 0]);

            if($app->successful() && $db->successful()){

                $update = $project->update(['status' => 'freeze']);
                if($update){
                    // notification freeze
                   $project->user->notify(new FreezeNotification($project));
                }
            }
            
        }

        
    }
}
