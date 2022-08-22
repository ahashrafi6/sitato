<?php

namespace App\Http\Livewire\Site\Profile\Project;

use Livewire\Component;
use App\Traits\Site\LiaraApi;

class AddDomain extends Component
{
    public $project;
    public $domain;

    public $addModal = false;

    protected function rules()
    {
        return [
            'domain' => 'required',
        ];
    }

    public function Add()
    {

        $project = LiaraApi::get_project($this->project->username);

        $this->validate();

        $res = LiaraApi::add_domain([
            'type' => 'PROJECT',
            'name' => $this->domain,
        ]);


        if ($res->successful()) {
            $domain_id = $res['domain']['_id'];
            $project = LiaraApi::get_project($this->project->username);

            $connect = LiaraApi::domain_connect([
                'projectID' => $project['project']['_id'],
                'domainID' => $domain_id,
            ]);


            if ($connect->successful()) {
                $this->emitUp('refresh');
                $this->emit('success-alert');
                $this->domain = '';
                $this->addModal = false;
            }
        }
    }


    public function render()
    {
        return view('livewire.site.profile.project.add-domain')->layout('layouts.profile');
    }
}
