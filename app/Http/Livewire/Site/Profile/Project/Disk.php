<?php

namespace App\Http\Livewire\Site\Profile\Project;

use Livewire\Component;
use App\Traits\Site\LiaraApi;

class Disk extends Component
{
    public $project;
    public $disks;


    public function mount()
    {
        $this->getDisks();
    }

    public function getDisks()
    {
        $res = LiaraApi::get_disks($this->project->liara_app_id);

        $disks = [];
        foreach( $res['disks'] as $disk){
            $ftp = LiaraApi::get_ftp($this->project->username , $disk['name']);
            $disks[] = [
                'disk' => $disk,
                'ftp' => (isset($ftp['accesses']) && count($ftp['accesses']) > 0) ? $ftp['accesses'][0] : null,
                'host' => isset( $ftp['host']) ? $ftp['host'] : null
            ];
        }
        $this->disks = $disks;
        
    }


    public function createFtp($disk_name){


        $res = LiaraApi::create_ftp($this->project->username , $disk_name , [
            'readOnly' => false,
            'username' => $this->project->username . rand(100,999),
        ]);
        
        if($res->successful()){
            $this->getDisks();

            $this->emit('success-alert');
        }
    }


    public function render()
    {
        return view('livewire.site.profile.project.disk')->layout('layouts.profile');
    }
}
