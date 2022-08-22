<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Traits\Site\LiaraApi;
use Illuminate\Support\Facades\Storage;

class ReleaseProject implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $timeout = 120;

    public $project;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($project)
    {
        $this->project = $project;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file = Storage::disk('local')->path('learnato/file.tar.gz');
   
        $upload = LiaraApi::upload_tar('learnato' , $file);

        if($upload->successful()){

            $released = LiaraApi::release($this->project->username, [
                'disks' => [['name' => 'storage' , 'mountTo' => '/storage'] , ['name' => 'store' , 'mountTo' => '/public/store']],
                'sourceID' => $upload['sourceID'],
                'port' => '80',
                'type' => $this->project->platform
            ]);
    
            if ($released->successful()) {
               
            }else{
                $this->fail('release');
            }

        }else{
            $this->fail('upload');
        }

       
    }
}
