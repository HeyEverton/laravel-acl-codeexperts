<?php

namespace Database\Seeders;

use App\Models\Resource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;

class ResourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Route::getRoutes()->getRoutes() as $routes) {
            $nameRoute = $routes->getName();

            if($nameRoute) {
                Resource::create([
                    'name' => ucwords(str_replace('.', ' ', $nameRoute)),
                    'resource' => $nameRoute,
                    'is_menu' => false,
                ]);
            }

        };
    }
}
