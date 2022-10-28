<?php

namespace App\Http\Views;

use App\Models\User;

class MenuViewsComposer
{
    public function compose($view)
    {
        // $roleUser = auth()->user()->role;
        $roleUser = User::find(1)->role;

        $modulesFiltered = session()->get('modules');

        if(!$modulesFiltered) {
            foreach ($roleUser->modules as $key =>  $module) {
                $modulesFiltered[$key]['name'] = $module->name;
    
                foreach ($module->resources as $resource ) {
                    if($resource->roles->contains($roleUser)) {
                        $modulesFiltered[$key]['resources'][] = $resource;
                    }
                }
            }
            // dump($modulesFiltered);
            session()->put('modules',$modulesFiltered);
        }
        $view->with('modules', $modulesFiltered);
    }
}
