<?php

namespace App\Http\Views;

use App\Models\Module;
use App\Models\User;

class MenuViewsComposer
{
    private $module;
    public function __construct(Module $module)
    {
        $this->module = $module;
    }

    public function compose($view)
    {
        $user = auth()->user();
        $user = User::find(1);
        // dd($user);
        
        $modulesFiltered = session()->get('modules') ?: [];
        // session()->forget('modules');

        if(!$modulesFiltered) {

            if($user->isAdmin()) {

                $modulesFiltered = ($this->getModules($this->module))->toArray();

            } else {
                $modules = $this->getModules($user->role->modules());

                foreach ($modules as $key =>  $module) {
                    $modulesFiltered[$key]['name'] = $module->name;
        
                    foreach ($module->resources as $k => $resource ) {
                        if($resource->roles->contains($user->role)) {
                            $modulesFiltered[$key]['resources'][$k]['name'] = $resource->name;
                            $modulesFiltered[$key]['resources'][$k]['resource'] = $resource->resource;
                        }
                    }
                }
            }


            session()->put('modules', $modulesFiltered);
        }
        $view->with('modules', $modulesFiltered);
    }

    public function getModules($module) 
    {
        return $module->with(['resources'=> function($queryBuilder) {
            $queryBuilder->where('is_menu', true);
        }])->get();
    }
}
