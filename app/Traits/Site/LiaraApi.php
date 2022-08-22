<?php

namespace App\Traits\Site;

use Illuminate\Support\Facades\Http;

trait LiaraApi{

    public static function get_domains($param = null)
    {
        return self::get('domains' , $param);
    }
    public static function get_domain($param = null)
    {
        return self::get('domains/' , $param);
    }
    public static function update_redirect($id , $params){
      
        return Http::withToken(env('LIARA_TOKEN'))->post(env('LIARA_URL') . 'domains/' . $id .'/set-redirect', $params);
    }
    public static function active_ssl($params){
        return Http::withToken(env('LIARA_TOKEN'))->post(env('LIARA_URL') . 'domains/provision-ssl-certs', $params);
    }
    public static function deactive_ssl($id){
        return Http::withToken(env('LIARA_TOKEN'))->post(env('LIARA_URL') . 'domains/' . $id .'/ssl/disable');
    }
    public static function add_domain($params){
        return self::post('domains' , $params);
    }
    public static function domain_connect($params){
        return self::post('domains/set-project' , $params);
    }

    public static function domain_delete($id){
        return Http::withToken(env('LIARA_TOKEN'))->delete(env('LIARA_URL') . 'domains/' . $id);
    }
    

    public static function get_project($param = null)
    {
        return self::get('projects/' , $param);
    }

    public static function update_env($params){
        return self::post('projects/update-envs' , $params);
    }


    public static function create_project($params){
        return self::post('projects' , $params);
    }
    public static function release($project_name , $params){
        return Http::withToken(env('LIARA_TOKEN'))->post('https://api.iran.liara.ir/v2/projects/' . $project_name . '/releases' , $params); 
    }
    public static function upload_tar($project_name , $file){
        $upload = fopen($file, 'r');
        return Http::withToken(env('LIARA_TOKEN'))->attach('file', $upload)->post('https://api.iran.liara.ir/v2/projects/' . $project_name . '/sources'); 
    }


    public static function create_database($params){
        return self::post('databases' , $params);
    }
    public static function enable_phpmyadmin($database_id){
        return Http::withToken(env('LIARA_TOKEN'))->post('https://api.iran.liara.ir/v1/databases/' . $database_id . '/control-panel/enable'); 
    }
    public static function get_database($param = null)
    {
        return self::get('databases/' , $param);
    }


    public static function create_disk($project_name , $params){
        return Http::withToken(env('LIARA_TOKEN'))->post('https://api.iran.liara.ir/v1/projects/' . $project_name . '/disks', $params); 
    }
    public static function get_disks($project_id)
    {
        return Http::withToken(env('LIARA_TOKEN'))->get('https://api.iran.liara.ir/v1/projects/' . $project_id . '/disks'); 
    }
    public static function create_ftp($project_name, $disk_name , $params)
    {
        return Http::withToken(env('LIARA_TOKEN'))->post('https://api.iran.liara.ir/v1/projects/' . $project_name . '/disks/' . $disk_name . '/ftp' , $params); 
    }
    public static function get_ftp($project_name, $disk_name)
    {
        return Http::withToken(env('LIARA_TOKEN'))->get('https://api.iran.liara.ir/v1/projects/' . $project_name . '/disks/' . $disk_name . '/ftp'); 
    }


    public static function scale($project_name , $params)
    {
        return Http::withToken(env('LIARA_TOKEN'))->post('https://api.iran.liara.ir/v1/projects/' . $project_name . '/actions/scale' , $params); 
    }
    public static function database_scale($database_id , $params)
    {
        return Http::withToken(env('LIARA_TOKEN'))->post('https://api.iran.liara.ir/v1/databases/' . $database_id . '/actions/scale' , $params); 
    }
    public static function restart($project_name)
    {
        return Http::withToken(env('LIARA_TOKEN'))->post('https://api.iran.liara.ir/v1/projects/' . $project_name . '/actions/restart'); 
    }


    public static function delete_app($project_name)
    {
        return Http::withToken(env('LIARA_TOKEN'))->delete('https://api.iran.liara.ir/v1/projects/' . $project_name); 
    }
    public static function delete_database($database_id)
    {
        return Http::withToken(env('LIARA_TOKEN'))->delete('https://api.iran.liara.ir/v1/databases/' . $database_id); 
    }


    private static function post($path , $params = null){
        return Http::withToken(env('LIARA_TOKEN'))->post(env('LIARA_URL') . $path, $params);
    }

    private static function get($path , $param){
       return Http::withToken(env('LIARA_TOKEN'))->get(env('LIARA_URL') . $path . $param);
    }
}
