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

    public static function get() {
        $url = self::url(self::getRoute());
        $response = Http::withToken(Session::token());
        return json_decode($response->body());
    }

    public static function post($data) {
        $url = self::url(self::getRoute());
        $response = Http::withToken(Session::token())->post($url, $data);
        return $response->status();

    }

}
