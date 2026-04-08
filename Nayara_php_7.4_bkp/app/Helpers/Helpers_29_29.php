<?php  
use App\MenuItem;
use App\Menu;
use Illuminate\Support\Facades\DB;


function headerMenu() {
  $header_menu = [];
  $header_main_menu = MenuItem::join('menus','menus.id','=','menu_items.menu_id')->select('menu_items.id','menu_items.title','menu_items.url','target','content','image','description')->where('menu_id',3)->orderBy('order','ASC')->where('parent_id',null)->get();
  foreach ($header_main_menu as $parentKey => $parentMenu) {
    $header_menu[$parentKey]['title'] = $parentMenu->title;
    $header_menu[$parentKey]['url'] = $parentMenu->url;
    $header_menu[$parentKey]['target'] = $parentMenu->target;
    $header_menu[$parentKey]['content'] = $parentMenu->content;
    $header_menu[$parentKey]['description'] = $parentMenu->description;
    $header_menu[$parentKey]['image'] = $parentMenu->image;
    $header_menu[$parentKey]['sub_parent'] = [];
    $sub_parent_menu =  DB::table('menu_items')->select('menu_items.id','menu_items.title','menu_items.url','menu_items.order','target','content','description','image')->where('parent_id',$parentMenu->id)->orderBy('order','ASC')->get();
   $sub_parent_menu_count =  $sub_parent_menu->count();
    if($sub_parent_menu_count > 0){
      foreach ($sub_parent_menu as $subParentKey => $subParentMenu) {
        $header_menu[$parentKey]['sub_parent'][$subParentKey]['title'] = $subParentMenu->title;
        $header_menu[$parentKey]['sub_parent'][$subParentKey]['url'] = $subParentMenu->url;
        $header_menu[$parentKey]['sub_parent'][$subParentKey]['target'] = $subParentMenu->target;
        $header_menu[$parentKey]['sub_parent'][$subParentKey]['sub_parent'] = [];
        $child_menu =  DB::table('menu_items')->select('menu_items.id','menu_items.title','menu_items.url','menu_items.order','target')->where('parent_id',$subParentMenu->id)->orderBy('order','ASC')->get();
        $child_menu_count = $child_menu->count();
        if($child_menu_count > 0){
          foreach ($child_menu as $childKey => $childValue) {
            $header_menu[$parentKey]['sub_parent'][$subParentKey]['sub_parent'][$childKey]['title'] = $childValue->title;
            $header_menu[$parentKey]['sub_parent'][$subParentKey]['sub_parent'][$childKey]['url'] = $childValue->url;
            $header_menu[$parentKey]['sub_parent'][$subParentKey]['sub_parent'][$childKey]['sub_parent'] = [];
            $sub_child_menu =  DB::table('menu_items')->select('menu_items.id','menu_items.title','menu_items.url','menu_items.order')->where('parent_id',$childValue->id)->orderBy('order','ASC')->get();
            $sub_child_menu_count = $sub_child_menu->count();
            if($sub_child_menu_count > 0){
              foreach ($sub_child_menu as $subChildKey => $subChildValue) {
                $header_menu[$parentKey]['sub_parent'][$subParentKey]['sub_parent'][$childKey]['sub_parent'][$subChildKey]['title'] = $subChildValue->title;
                $header_menu[$parentKey]['sub_parent'][$subParentKey]['sub_parent'][$childKey]['sub_parent'][$subChildKey]['url'] = $subChildValue->url;
                $last_sub_child_menu =  DB::table('menu_items')->select('menu_items.id','menu_items.title','menu_items.url','menu_items.order')->where('parent_id',$subChildValue->id)->orderBy('order','ASC')->get();
                $last_sub_child_menu_count = $last_sub_child_menu->count();
                if($last_sub_child_menu_count > 0) {
                  foreach($last_sub_child_menu as $lastChildKey => $lastChildValue){
                    $header_menu[$parentKey]['sub_parent'][$subParentKey]['sub_parent'][$childKey]['sub_parent'][$subChildKey]['sub_parent'][$lastChildKey]['title'] = $lastChildValue->title;
                    $header_menu[$parentKey]['sub_parent'][$subParentKey]['sub_parent'][$childKey]['sub_parent'][$subChildKey]['sub_parent'][$lastChildKey]['url'] = $lastChildValue->url;
                  }

                }
              }
            }
          }
        }
      }
    }
  }
  return $header_menu;
}

function singaporefooterMenu() {
  $footer_menu = [];
	$footer_main_menu = MenuItem::join('menus','menus.id','=','menu_items.menu_id')->select('menu_items.id','menu_items.title','menu_items.url')->where('menu_id',5)->where('parent_id','=',null)->get();
	foreach ($footer_main_menu as $parent_key => $parent_menu) {
            
            $footer_menu[$parent_key]['title'] = $parent_menu->title;
            $footer_menu[$parent_key]['url'] = $parent_menu->url;

            $sub_parent_menu =  DB::table('menu_items')->select('menu_items.id','menu_items.title','menu_items.url','menu_items.order')->where('parent_id',$parent_menu->id)->orderBy('order','ASC')->get();
            $sub_parent_menu_count =  $sub_parent_menu->count();
        
            if($sub_parent_menu_count > 0){
      
                 $child = Array();
                 foreach ($sub_parent_menu  as $sub_parent_key => $sub_menu ) {
                 $footer_menu[$parent_key]['sub_parent'][] = $sub_menu;
                
                       $child = Array();

                      $child_menues =   DB::table('menu_items')->select('menu_items.id','menu_items.title','menu_items.url')->where('parent_id',$sub_menu->id)->orderBy('order','ASC')->get();
                      $child_menu_count = $child_menues->count();
                      if($child_menu_count > 0){

                        foreach ($child_menues as $child_menu) {
                         
                            $child[] = $child_menu;
                        }

                        $footer_menu[$parent_key]['sub_parent'][$sub_parent_key]->child_menu = $child;
                       

                      
                      }
                      
                  } 
            }
        }

        return $footer_menu;

}

function footerMenu() {
	$footer_menu = [];
	$footer_main_menu = MenuItem::join('menus','menus.id','=','menu_items.menu_id')->select('menu_items.id','menu_items.title','menu_items.url')->where('menu_id',2)->where('parent_id','=',null)->get();
	foreach ($footer_main_menu as $parent_key => $parent_menu) {
            
            $footer_menu[$parent_key]['title'] = $parent_menu->title;
            $footer_menu[$parent_key]['url'] = $parent_menu->url;

            $sub_parent_menu =  DB::table('menu_items')->select('menu_items.id','menu_items.title','menu_items.url','menu_items.order')->where('parent_id',$parent_menu->id)->orderBy('order','ASC')->get();
            $sub_parent_menu_count =  $sub_parent_menu->count();
        
            if($sub_parent_menu_count > 0){
      
                 $child = Array();
                 foreach ($sub_parent_menu  as $sub_parent_key => $sub_menu ) {
                 $footer_menu[$parent_key]['sub_parent'][] = $sub_menu;
                
                       $child = Array();

                      $child_menues =   DB::table('menu_items')->select('menu_items.id','menu_items.title','menu_items.url')->where('parent_id',$sub_menu->id)->orderBy('order','ASC')->get();
                      $child_menu_count = $child_menues->count();
                      if($child_menu_count > 0){

                        foreach ($child_menues as $child_menu) {
                         
                            $child[] = $child_menu;
                        }

                        $footer_menu[$parent_key]['sub_parent'][$sub_parent_key]->child_menu = $child;       
                      }
                      
                  } 
            }
        }
        return $footer_menu;
}

function bread_crumbs() {
  $url = url()->current(); 
  $base_url = config('app.url');
  $url = str_replace($base_url, '', $url);
  $child_menu = MenuItem::where('menu_id', 3)->where('url', '/'.$url)->orderBy('order','ASC')->get()->toArray();
  if(count($child_menu) > 0){
    $parent_id = $child_menu[0]['parent_id'];
    $i = 5;
    $crumbs[$i]['active'] = $child_menu;
    dd($crumbs);
    while ($parent_id != NULL) {
        $i--;
        $child_menu = MenuItem::where('parent_id', $parent_id)->orderBy('order','ASC')->get()->toArray();
        $parent_menu = MenuItem::where('id', $child_menu[0]['parent_id'])->orderBy('order','ASC')->get()->toArray();
        $crumbs[$i]['parent'] = $parent_menu;
        $crumbs[$i]['child'] = $child_menu;
        $parent_id = $parent_menu[0]['parent_id'];
    }
    $i--;
    ksort($crumbs);
    return $crumbs;
  }
}

function singaporeHeaderMenu() {
  $header_menu = [];
  $header_main_menu = MenuItem::join('menus','menus.id','=','menu_items.menu_id')->select('menu_items.id','menu_items.title','menu_items.url')->where('menu_id',4)->orderBy('order','ASC')->where('parent_id',null)->get();
  foreach ($header_main_menu as $parentKey => $parentMenu) {
    $header_menu[$parentKey]['title'] = $parentMenu->title;
    $header_menu[$parentKey]['url'] = $parentMenu->url;
    $header_menu[$parentKey]['sub_parent'] = [];
    $sub_parent_menu =  DB::table('menu_items')->select('menu_items.id','menu_items.title','menu_items.url','menu_items.order')->where('parent_id',$parentMenu->id)->orderBy('order','ASC')->get();
    $sub_parent_menu_count =  $sub_parent_menu->count();
    if($sub_parent_menu_count > 0){
      foreach ($sub_parent_menu as $subParentKey => $subParentMenu) {
        $header_menu[$parentKey]['sub_parent'][$subParentKey]['title'] = $subParentMenu->title;
        $header_menu[$parentKey]['sub_parent'][$subParentKey]['url'] = $subParentMenu->url;
        $header_menu[$parentKey]['sub_parent'][$subParentKey]['sub_parent'] = [];
        $child_menu =  DB::table('menu_items')->select('menu_items.id','menu_items.title','menu_items.url','menu_items.order')->where('parent_id',$subParentMenu->id)->orderBy('order','ASC')->get();
        $child_menu_count = $child_menu->count();
        if($child_menu_count > 0){
          foreach ($child_menu as $childKey => $childValue) {
            $header_menu[$parentKey]['sub_parent'][$subParentKey]['sub_parent'][$childKey]['title'] = $childValue->title;
            $header_menu[$parentKey]['sub_parent'][$subParentKey]['sub_parent'][$childKey]['url'] = $childValue->url;
            $header_menu[$parentKey]['sub_parent'][$subParentKey]['sub_parent'][$childKey]['sub_parent'] = [];
            $sub_child_menu =  DB::table('menu_items')->select('menu_items.id','menu_items.title','menu_items.url','menu_items.order')->where('parent_id',$childValue->id)->orderBy('order','ASC')->get();
            $sub_child_menu_count = $sub_child_menu->count();
            if($sub_child_menu_count > 0){
              foreach ($sub_child_menu as $subChildKey => $subChildValue) {
                $header_menu[$parentKey]['sub_parent'][$subParentKey]['sub_parent'][$childKey]['sub_parent'][$subChildKey]['title'] = $subChildValue->title;
                $header_menu[$parentKey]['sub_parent'][$subParentKey]['sub_parent'][$childKey]['sub_parent'][$subChildKey]['url'] = $subChildValue->url;
                /*array_push($header_menu[$parentKey]['sub_parent'][$subParentKey][$childKey]['sub_parent'][$subChildKey]['title'], $subChildValue->title);
                array_push($header_menu[$parentKey]['sub_parent'][$subParentKey][$childKey]['sub_parent'][$subChildKey]['url'], $subChildValue->title);*/
              }
            }
          }
        }
      }
    }
  }
  return $header_menu;
  
}

if (!function_exists('getWebpVersion')) {
  function getWebpVersion($imgUrl)
  {
      $imgUrlArr = explode('.', $imgUrl);
      array_pop($imgUrlArr); // remove last element of array i.e. extension (jpg, png, etc.)
      array_push($imgUrlArr, 'webp');
      $webpUrl = implode('.', $imgUrlArr);
      return $webpUrl;
  }
}