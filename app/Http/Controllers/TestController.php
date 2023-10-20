<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class TestController extends Controller
{
    public function index()
    {
        $filtered_routes = [];
        $all_routes = Route::getRoutes();
        foreach ($all_routes as $route) {
            $route_name = $route->getName();

                if(str_contains($route_name, 'debugbar.')){
                    continue;
                }else if(str_contains($route_name, 'sanctum.')){
                    continue;
                }else if(str_contains($route_name, 'ignition.')){
                    continue;
                }else if($route_name === null ){
                    continue;
                }

            array_push($filtered_routes,$route_name);
        }

        foreach($filtered_routes as $route) {
            $response = Route::get($route);
            var_dump($response);
            die();
        }
    }
}
