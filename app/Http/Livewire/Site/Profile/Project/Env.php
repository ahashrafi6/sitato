<?php

namespace App\Http\Livewire\Site\Profile\Project;

use Livewire\Component;
use App\Traits\Site\LiaraApi;

class Env extends Component
{
    public $project;
    public $envs;
    public $envs_string;

    public $block = [];


    public function mount()
    {
        $this->getEnv();
    }

    public function getEnv()
    {
        $res = LiaraApi::get_project($this->project->username);
        $this->envs = $res['project']['envs'];

        
        $this->envs_string = $this->env_array_to_string($this->envs);
    }

    private function env_array_to_string($envs){

        $envs_string = '';

        //$num = count($this->envs);
        //$i = 0;

        $array_block = [
            'DB_',
            //'FTP',
            'APP',
            'MAI',
        ];
        foreach ($envs as $item) {
            $first = substr($item['key'] , 0 ,3);
            if(in_array($first , $array_block)){
                $this->block[] = $item['key'] . '=' . $item['value'];
                continue;
            }
           // if (++$i === $num) {
              //  $envs_string .= $item['key'] . '=' . $item['value'];
            //} else {
                $envs_string .= $item['key'] . '=' . $item['value'] . PHP_EOL;
            //}
        }

        return $envs_string;
    }
    private function env_string_to_array($envs){
        $array = explode(PHP_EOL, $envs);
        $array = array_filter($array);

        $array = array_merge($this->block , $array);

        $lists = [];
        foreach($array as $item){
            $item = explode('=' , $item);
            $lists[] = [
                'key' => $item[0],
                'value' => $item[1],
            ];
        }

        return $lists;
    }

    public function Update()
    {
        $envs = $this->env_string_to_array($this->envs_string);
        $res = LiaraApi::update_env([
            'project' => $this->project->username,
            'variables' => $envs
        ]);


        if ($res->successful()) {
            $this->emit('success-alert');
        }
    }

    public function render()
    {
        return view('livewire.site.profile.project.env')->layout('layouts.profile');
    }
}
