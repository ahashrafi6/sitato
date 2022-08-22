<?php

namespace App\Http\Livewire\Site\Profile;

use Livewire\Component;
use App\Traits\Site\LiaraApi;

class Project extends Component
{
    public \App\Models\Project $project;

    public $type = 'info';

    protected $queryString = ['type'];

    public function mount()
    {
       if($this->project->status == 'delete' || $this->project->status == 'install' || auth()->user()->id != $this->project->user_id){
            abort(404);
       }

       $this->project->with(['product' , 'plan' , 'server']);
    }

    public function restart(){

        if($this->project->status == 'active'){
            $res = LiaraApi::restart($this->project->username);

            if($res->successful()){
        
                $this->emit('success-alert');
            }
        }

    }

    public function scale()
    {

        if($this->project->status == 'active' || $this->project->status == 'disable'){

            if($this->project->status == 'active'){
                $scale = 0;
            }else{
                $scale = 1;
            }
    
    
            $app = LiaraApi::scale($this->project->username , ['scale' => $scale]);
            $db = LiaraApi::database_scale($this->project->liara_database_id , ['scale' => $scale]);
            if($app->successful() && $db->successful()){
                $this->project->update(['status' => $scale == 0 ? 'disable' : 'active']);
                return redirect(route('project' , ['project' => $this->project->username , 'type' => 'info']));
            }

        }
       
    }


    public function render()
    {
        return view('livewire.site.profile.project')->layout('layouts.profile');
    }
}
