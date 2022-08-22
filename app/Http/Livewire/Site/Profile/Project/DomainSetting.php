<?php

namespace App\Http\Livewire\Site\Profile\Project;

use Livewire\Component;
use App\Traits\Site\LiaraApi;

class DomainSetting extends Component
{
    public $project;
    public $domain;
    public $domains;

    public $redirect_to = '';
    public $redirect_status = 301;
    public $ssl;


    public function mount()
    {
        $this->redirect_to = $this->domain['redirectTo'];
        $this->redirect_status = $this->domain['redirectStatus'];
        $this->ssl = $this->domain['certificatesStatus'];
    }

    public function updateRedirect(){

        $res = LiaraApi::update_redirect($this->domain['_id'] , ['redirectTo' => $this->redirect_to , 'redirectStatus' => (int)$this->redirect_status]);
    

        if($res->successful()){

         //   $this->emitUp('refresh');
            $this->emit('success-alert');
        }
      
    }

    public function updateSSL($status){
    
        if($status == 'ACTIVE'){
            $res = LiaraApi::active_ssl(['domain' => $this->domain['name']]);
    
        }else{
            $res = LiaraApi::deactive_ssl($this->domain['_id']);
        }

        if($res->successful()){
            $this->ssl = $status;
             //  $this->emitUp('refresh');
               $this->emit('success-alert');
           }

    }


    public function render()
    {
        return view('livewire.site.profile.project.domain-setting')->layout('layouts.profile');
    }
}
