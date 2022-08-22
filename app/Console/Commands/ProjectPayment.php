<?php

namespace App\Console\Commands;

use App\Models\Factor;
use App\Models\Project;
use Illuminate\Console\Command;
use App\Notifications\FactorNotification;
use Carbon\Carbon;

class ProjectPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $date = now()->addDays(5)->toDateString();
    
        $projects = Project::whereDate('payment_end' , '=' , $date)->with(['server' , 'user'])->take(5)->get();

    
        foreach ($projects as $project) {
            $price = $project->server->price * $project->month;

            // create factor
            $factor = Factor::create([
                'user_id' => $project->user_id,
                'final_price' => $price,
                'type' => 'server',
                'isSystem' => true,
                'items' => [
                    'server' => $project->server,
                    'project_id' => $project->id,
                    'month' => $project->month,
                ],
                'expire_at' => Carbon::parse($project->payment_end)->addDays(5)->toDateTimeString()
            ]);

            if($factor){
                // notification factor
               $project->user->notify(new FactorNotification($factor));
            }
        }
    }
}
