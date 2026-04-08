<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\Blog;
use App\News;
use App\HomeBlock;
use App\HomeImage;
use App\Product;
use App\Mail\NewsletterSubscription;
use Storage;
use File;

class HomeController extends Controller
{
    public function index(){
    	//return view('pages.home');
    	$blogs = Blog::select('blog_image','blog_title','blog_footer','description','cta_name','cta_url','img_title','img_alt')->where('status',1)->get();
    	//dd($blogs);
    	$front_news = News::select('news_image','news_title','news_date','news_source','img_title','img_alt','news_url')->where('on_front',1)->where('status',1)->get();
    	$slider_news = News::select('news_image','news_title','news_date','news_source','news_url')->where('on_front',0)->where('status',1)->get();
    	$products = Product::select('product_name','product_description','image','cta_name','cta_url','img_alt','img_title')->where('business','Marketing')->where('status',1)->get();
    	//dd($products);
    	$home_blocks = HomeBlock::select('type','title','sub_title','cta_name','cta_url')->where('status',1)->get();
    	$home_images = HomeImage::select('type','desktop_image','mobile_image','img_alt','img_title')->where('status',1)->get();
    	//dd($home_images);
    	return view('pages.home')->with(compact(['blogs','front_news','slider_news','products','home_blocks','home_images']));
    }


    public function check(){
        // dd(storage_path());
        $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        var_dump(json_encode(File::get($storagePath."/check.csv")));
        exit();
        $csv = array_map('str_getcsv', File::get($storagePath."/check.csv"));
        dd($csv);
    }

    public function newsletterSubscription(Request $request){

        $validation = $this->newsletter_email_validator($request->all())->validate();

        $email = $request->email;
        $date = date('Y-m-d H:i:s');
        $newsletter_update = DB::table('newsletter_subscriptions')
        ->insert([
            'email' => $email,
            'created_at' => $date,
            'updated_at' => $date,
        ]);
        if($newsletter_update){
            $mail = Mail::to($email)->send(new NewsletterSubscription());
            if( count(Mail::failures()) > 0 ){
                echo 1;
            }else{
                echo 0;
            }
        }

    }

    protected function newsletter_email_validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255', 
        ]);
    }
    public function currentFuelPrice(Request $request) {
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        try{
            $db_ext = \DB::connection('sqlsrv1');
        }
        catch(\Exception $e){
            die(1);
        }
        $pump = $db_ext->table('essar_outlet')->get();
        $pumps = array();
        foreach ($pump as $key => $value) {
            $model_latitude = (float)$value->latitude;
            $model_longitude = (float)$value->longitude;
            if(is_numeric($model_latitude) && is_numeric($model_longitude)){
                $theta = $longitude - $model_longitude; 
                $dist = sin(deg2rad($latitude)) * sin(deg2rad($model_latitude)) +  cos(deg2rad($latitude)) * cos(deg2rad($model_latitude)) * cos(deg2rad($theta)); 
                $dist = acos($dist); 
                $dist = rad2deg($dist); 
                $miles = $dist * 60 * 1.1515 * 1.609344;
                //dd($miles);
                if($miles < 25) {
                    $pumps[0]['ro_name'] = $value->outlet_name;
                    $pumps[0]['cms_code'] = $value->outlet_cmscode;
                    $pumps[0]['address'] = $value->address_line2;
                    $pumps[0]['address1'] = $value->address_line1;
                    $pumps[0]['latitude'] = $value->latitude;
                    $pumps[0]['longitude'] = $value->longitude;
                }
                if(count($pumps) > 0){
                    break;
                }
            }
        }
        //dd($pumps);
        /*foreach ($pump as $key => $value) {
            $model_latitude = (float)$value->latitude;
            $model_longitude = (float)$value->longitude;
            if(is_numeric($model_latitude) && is_numeric($model_longitude)){
                $theta = $longitude - $model_longitude; 
                $dist = sin(deg2rad($latitude)) * sin(deg2rad($model_latitude)) +  cos(deg2rad($model_latitude)) * cos(deg2rad($model_latitude)) * cos(deg2rad($theta)); 
                $dist = acos($dist); 
                $dist = rad2deg($dist); 
                $miles = $dist * 60 * 1.1515 * 1.609344;
                if($miles < $radius) {
                    $pumps[$key]['ro_name'] = $value->outlet_name;
                    $pumps[$key]['cms_code'] = $value->outlet_cmscode;
                    $pumps[$key]['address'] = $value->address_line2;
                    $pumps[$key]['address1'] = $value->address_line1;
                    $pumps[$key]['latitude'] = $value->latitude;
                    $pumps[$key]['longitude'] = $value->longitude;
                }
            }
        }*/
        foreach ($pumps as $key1 => $value1) {
            $petrol_price = $db_ext->table('essar_outlet_product_price')->where('fuel_type', 'PETROL')->where('outlet_cmscode', $value1['cms_code'])->get();
            $diesel_price = $db_ext->table('essar_outlet_product_price')->where('fuel_type', 'DIESEL')->where('outlet_cmscode', $value1['cms_code'])->get();
            //dd($price);
            if(count($petrol_price) > 0){
                $pumps[$key1]['PETROL'] = $petrol_price[0]->price;
            }
            else{
                $pumps[$key1]['PETROL'] = '';
            }
            if(count($diesel_price) > 0){
                $pumps[$key1]['DIESEL'] = $diesel_price[0]->price;
            }
            else{
                $pumps[$key1]['DIESEL'] = '';    
            }
        }
        //dd($pumps);   
        return $pumps;
    }
}
