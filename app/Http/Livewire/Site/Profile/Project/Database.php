<?php

namespace App\Http\Livewire\Site\Profile\Project;

use Livewire\Component;
use App\Traits\Site\LiaraApi;

class Database extends Component
{
    public $project;
    public $database;


    public function mount()
    {
        $this->getDatabase();
    }

    public function getDatabase()
    {
        $res = LiaraApi::get_database($this->project->liara_database_id);
        $this->database = $res['database'];
        
    }

    public function phpmyadmin(){
        $res = LiaraApi::enable_phpmyadmin($this->database['_id']);
        if($res->successful()){
            
            $this->getDatabase();
            $this->emit('success-alert');
        }
    }

    public function render()
    {
        return view('livewire.site.profile.project.database')->layout('layouts.profile');
    }
}
