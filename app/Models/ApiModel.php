<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ApiModel extends Model
{
    use HasFactory;

    private static function getRoute(): string
    {
        $childClass = get_called_class();
        return strtolower(substr($childClass, strrpos($childClass, '\\')+1));
    }
    private static function url($route): string {
        //dd(config('api.url').'/'.config('api.version').'/'.$route);
        return config('api.url').'/'.config('api.version').'/'.$route;

    }

    /**
     * Get all of the models from the API REST
     *
     * @param array|string $columns
     * @return Collection|void
     */
    public static function all($columns = ['*'])
    {

        $url=self::url(self::getRoute());
        $response = Http::get($url);
        return json_decode($response->body());

    }

    /**
     * Get one of the models from the API REST
     *
     * @param int $id
     * @return Object|void
     */
    public static function find(int $id)
    {
        $url=self::url(self::getRoute().'/'.$id);
        $response = Http::get($url);
        return json_decode($response->body());
    }

    public static function loginPost($credentials) {
        $url = self::url('login');
        $response = Http::post($url, $credentials);
        return $response;

    }
    public static function create(array $attributes = [], array $options = [])
    {
        $childClass = get_called_class();
        $shortClassName = substr($childClass, strrpos($childClass, '\\') + 1);
        $model = strtolower($shortClassName);
        return self::postWithToken($model,$attributes);
    }

    public static function get() {
        $url = self::url(self::getRoute());
        $response = Http::withToken(Session::get('apitoken'), 'Bearer')->get($url);
        return json_decode($response->body());
    }

    public static function getOne($route) {
        // $route must have the '/' at the beginning!
        $url = self::url(self::getRoute().$route);
        $response = Http::withToken(Session::get('apitoken'), 'Bearer')->get($url);
        return json_decode($response->body());
    }
    public static function deleteOne($route) {
        // $route must have the '/' at the beginning!
        $url = self::url(self::getRoute().$route);
        $response = Http::withToken(Session::get('apitoken'), 'Bearer')->delete($url);
        return json_decode($response->body());
    }

    public static function getCustomRoute($path) {
        $url = self::url($path);
        $response = Http::withToken(Session::get('apitoken'), 'Bearer')->get($url);
        return json_decode($response->body());
    }

    public static function post($data) {
        $url = self::url(self::getRoute());
        $response = Http::withToken(Session::get('apitoken'))->post($url, $data);
       // dd($response);
        return $response->status();


    }
    public static function postWithToken($route, $formParams)
    {
        $response = Http::withToken(Session::get('apitoken'))->post(config('api.url').'/'.config('api.version').'/'.$route,$formParams);
        //dd($response);
        return json_decode($response->body());
    }


}
