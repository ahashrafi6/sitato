<?php

namespace App\Http\Livewire\Site\Profile\Project;

use Livewire\Component;
use App\Traits\Site\LiaraApi;

class Domain extends Component
{
    public $project;
    public $domains;

    public $removeModal = false;

    protected $listeners = ['refresh' => 'getDomains'];

    public function mount()
    {
        $this->getDomains();

    }


    public function getDomains(){
        $domains = LiaraApi::get_domains();

        $this->domains = [];
        foreach($domains['domains'] as $item){
            if($item['project']['project_id'] == $this->project->username){
                $this->domains[] = $this->getDomain($item['name']);
            }
        }
    }
    
    public function getDomain($name)
    {
        $domain = LiaraApi::get_domain($name);
        return $domain['domain'];
    }

    public function Check()
    {
        $this->emit('refresh');
        $this->emit('success-alert');

    }


    public function deleteDomain($domain_id){

        $res = LiaraApi::domain_delete($domain_id);

        if($res->successful()){
            $this->removeModal = false;
            $this->emit('refresh');
            $this->emit('success-alert');
        }

    }

    public function render()
    {
        return view('livewire.site.profile.project.domain')->layout('layouts.profile');
    }
}
