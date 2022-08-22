<?php

namespace App\Console\Commands;

use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Traits\Site\LiaraApi;

class ProjectInstallChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Project Install Checker Command';

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
        $projects = Project::where('status' , 'install')->get();

      //  $ids = [];
        foreach ($projects as $item) {
            $project = LiaraApi::get_project($item->username);
            if($project['project']['isDeployed'] == true){
                //$ids[] = $item->id;
                Project::find($item->id)->update(['status' => 'active']);
            }
        }

       // Project::find($ids)->update(['status' => 'active']);
    }
}
