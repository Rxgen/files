<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\MenuItem;
use App\Menu;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $crumbs = Array();
		$url = url()->current(); 
        $base_url = config('app.url');
        $url = str_replace($base_url, '', $url);
        $child_menu = MenuItem::where('url', $url)->orderBy('order','ASC')->get()->toArray();
        if(count($child_menu) > 0){
            $parent_id = $child_menu[0]['parent_id'];
            $i = 5;
            $crumbs[$i]['active'] = $child_menu;
            while ($parent_id != NULL) {
                $i--;
                $child_menu = MenuItem::where('parent_id', $parent_id)->orderBy('order','ASC')->get()->toArray();
                $parent_menu = MenuItem::where('id', $child_menu[0]['parent_id'])->orderBy('order','ASC')->get()->toArray();
                //dd($parent_menu);
                $crumbs[$i]['parent'] = $parent_menu;
                $crumbs[$i]['child'] = $child_menu;
                //dd($crumbs);
                $parent_id = $parent_menu[0]['parent_id'];
            }
            $i--;
            ksort($crumbs);
        }
		
		//dd($crumbs);
        view()->share('bread_crumbs',$crumbs);
    }
}
