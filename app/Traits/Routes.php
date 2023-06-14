<?php

namespace App\Traits;
use App\Models\Permission;
use Route;
use App\Models\permission_user;
Trait Routes {


    public function insertRoute(){

        $routes = Route::getRoutes();

        foreach($routes as $route) {
            //Checa as rotas
            if(isset($route->getAction()['nickname']) && isset($route->getAction()['groupname'])){
                $permission = Permission::where('name', $route->getName())->get();

                if($permission->isEmpty())
                {
                    $permission = Permission::create(array(
                        'nickname'  => $route->getAction()['nickname'],
                        'name'      => $route->getName(),
                        'groupname' => (isset($route->getAction()['groupname'])) ? $route->getAction()['groupname'] : null,
                    ));

                    permission_user::create([
                        "grupo_id" => 1,
                        "permission_id" => $permission->id
                    ]);
                }


            }
        }

    }


}
