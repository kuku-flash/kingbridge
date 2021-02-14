<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Subcategory;
use App\Appartment_ad;
use App\House_ad;
use App\Car_ad;
use App\Car_make;
use App\Car_model;
use App\Land_ad;
use App\County;
use App\City;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostAdController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function my_ads()
    {
     $data = DB::table('users')
       ->join('car_ads', 'user.id', '=', 'car_ads.user_id')
       ->join('land_ads', 'user.id', '=', 'land_ads.user_id')
       ->join('appartment_ads', 'user.id', '=', 'appartment_ads.user_id')
       ->join('house_ads', 'user.id', '=', 'house_ads.user_id')
       ->select('car_ads.title', 'land_ads.title', 'house_ads.title')
       ->where('user_id',Auth::id())->take(10)
       ->get();
     return view('join_table', compact('data'));
    }
    public function user_dashboard(){
     
        $arr['apartment_ads'] = Appartment_ad::where('user_id',Auth::id())->take(10)->get();
        $arr['house_ads'] = House_ad::where('user_id',Auth::id())->take(10)->get();
        $arr['car_ads'] = Car_ad::where('user_id',Auth::id())->take(10)->get();
        $arr['land_ads'] = Land_ad::where('user_id',Auth::id())->take(10)->get();
        

        $arr['all_ads'] = DB::table('users')
        ->where('users.id','=', Auth::id())
        ->select()
       ->join('car_ads', 'users.id', '=', 'car_ads.user_id')
       ->join('appartment_ads', 'users.id', '=', 'appartment_ads.user_id')  
       ->get();

        return view('user.user_dashboard')->with($arr);
    }
    public function category(){
        $arr['categories'] = Category::all();
        $arr['counties'] = County::all();
        return view('user.postad.category')->with($arr);
    }
  
    public function city(Request $request)
    {
       $data = City::select('city','id')->where('county_id',$request->id)->take(10)->get();
        return response()->json($data);//then sent this data to ajax success
    }
    public function model(Request $request)
    {
       $data = Car_model::select('model','id')->where('make_id',$request->id)->take(10)->get();
        return response()->json($data);//then sent this data to ajax success
    }
   

    /**
     * The Functionality of Apartment Ads.
     */

    public function create_apartment_ad_post( Category $category_id, Subcategory $subcategory_id){
        $arr['subcategory'] =$subcategory_id;
        $arr['category'] = $category_id;
        $arr['counties'] = County::all();
        $arr['cities'] = City::all();
        return view('user.postad.apartment_ad_post')->with($arr);
    }

    public function store_apartment_ad_post(Request $request, Appartment_ad $appartment_ad){

        $this->validate($request,[
            'title' => 'required',
            'ads_type' => 'required',
            'address' => 'required',
            'real_state_type' => 'required',
            'condition' => 'required',
            'price' => 'required',
            'period' => 'required',
            'bedroom' => 'required',
            'bathroom' => 'required',
            'square_meters' => 'required',
            'amenities' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'county_id' => 'required',
            'city_id' => 'required',
            'user_id' => 'required',
            'package_id' => 'required',
            'photos' => 'required',
            'parking' => 'required',
            
            ]);

            $images = $request->File('photos');
            $count = 0;
            if($request->File('photos')){
                foreach($images as $item){
                    if($count < 4){
                        $var = date_create();
                        $date = date_format($var, 'Ymd');
                        $imageName = $date.'-'.$item->getClientOriginalName();
                        $item->storeAs('public/photos/', $imageName);
                        $url = $imageName;
                        $arr[] = $url;
                        $count++;

                    }
                }
                $images = implode(",", $arr);
  
            $appartment_ad->title = $request->title;
            $appartment_ad->ads_type = $request->ads_type;
            $appartment_ad->address = $request->address;
            $appartment_ad->real_state_type = $request->real_state_type;
            $appartment_ad->condition = $request->condition;
            $appartment_ad->price = $request->price;
            $appartment_ad->period = $request->period;
            $appartment_ad->parking = $request->parking;
            $appartment_ad->bedroom = $request->bedroom;
            $appartment_ad->bathroom = $request->bathroom;
            $appartment_ad->square_meters = $request->square_meters;
            $appartment_ad->amenities = $request->amenities;
            $appartment_ad->description = $request->description;
            $appartment_ad->category_id = $request->category_id;
            $appartment_ad->subcategory_id = $request->subcategory_id;
            $appartment_ad->county_id = $request->county_id;
            $appartment_ad->city_id = $request->city_id;
            $appartment_ad->user_id = $request->user_id;
            $appartment_ad->package_id = $request->package_id;
            $appartment_ad->photos = $images;
            $appartment_ad->save();
                }
                return redirect() -> route('user.user_cart')->with('success','New Appartment Ad Added');
        }

    public function show_apartment_ad_post(Appartment_ad $apartment_ad) {
        $arr['apartment_ad'] = $apartment_ad;
        $arr['categories'] = Category::select('category_name','id')->where('id',1)->get();
        $arr['subcategories'] = Subcategory::select('subcategory_name','id')->where('category_id',1)->get();
        $arr['counties'] = County::all();
        $arr['cities'] = City::all();
        return view('user.postad.apartment_ad_show')->with($arr);
    }
    public function edit_apartment_ad(Appartment_ad $apartment_ad) {
        $arr['apartment_ad'] = $apartment_ad;
        $arr['categories'] = Category::select('category_name','id')->where('id',1)->get();
        $arr['subcategories'] = Subcategory::select('subcategory_name','id')->where('category_id',1)->get();
        $arr['counties'] = County::all();
        $arr['cities'] = City::all();
        return view('user.postad.apartment_ad_edit')->with($arr);
    }
    public function update_apartment_ad(Request $request, Appartment_ad $apartment_ad){

        $this->validate($request,[
            'title' => 'required',
            'real_state_type' => 'required',
            'condition' => 'required',
            'price' => 'required',
            'bedroom' => 'required',
            'bathroom' => 'required',
            'square_meters' => 'required',
            'amenities' => 'required',
            'description' => 'required',
            'county_id' => 'required',
            'city_id' => 'required',
            'package_id' => 'required',
            'address' => 'required',
            'period' => 'required',
            'parking' => 'required',
            ]);

        
            $apartment_ad->title = $request->title;
            $apartment_ad->real_state_type = $request->real_state_type;
            $apartment_ad->condition = $request->condition;
            $apartment_ad->price = $request->price;
            $apartment_ad->bedroom = $request->bedroom;
            $apartment_ad->bathroom = $request->bathroom;
            $apartment_ad->square_meters = $request->square_meters;
            $apartment_ad->amenities = $request->amenities;
            $apartment_ad->description = $request->description;
            $apartment_ad->county_id = $request->county_id;
            $apartment_ad->city_id = $request->city_id;
            $apartment_ad->package_id = $request->package_id;
            $apartment_ad->address = $request->address;
            $apartment_ad->period = $request->period;
            $apartment_ad->parking = $request->parking;
            $apartment_ad->save();
              
                return redirect() -> route('user.user_cart')->with('success','Appartment Ad Updated Successfuly');
        }

    public function apartment_ad_destroy($id) {
        $apartment_ad = Appartment_ad::find($id);
        
        $apartment_ad->delete(public_path().'/photos/'.$apartment_ad->photos);
        return redirect() -> route('user.user_cart')->with('success','Removed Succesfully');;
    }

    public function pay_apartment_ad (Appartment_ad $apartment_ad) {
        $arr['apartment_ad'] = $apartment_ad;
        return view('user.postad.apartment_ad_pay')->with($arr);
    }

    /**
     * The Functionality of House Ads.
     */
    public function create_house_ad_post( Category $category_id, Subcategory $subcategory_id){
        $arr['subcategory'] =$subcategory_id;
        $arr['category'] = $category_id;
        $arr['counties'] = County::all();
        $arr['cities'] = City::all();
        return view('user.postad.house_ad_post')->with($arr);
    }
    
    public function store_house_ad_post(Request $request, House_ad $house_ad){

            $this->validate($request,[
                'title' => 'required',
                'ads_type' => 'required',
                'real_state_type' => 'required',
                'condition' => 'required',
                'price' => 'required',
                'bedroom' => 'required',
                'bathroom' => 'required',
                'parking' => 'required',
                'square_meters' => 'required',
                'amenities' => 'required',
                'description' => 'required',
                'category_id' => 'required',
                'subcategory_id' => 'required',
                'county_id' => 'required',
                'city_id' => 'required',
                'user_id' => 'required',
                'package_id' => 'required',
                'photos' => 'required',
    
                ]);
    
                $images = $request->File('photos');
                $count = 0;
                if($request->File('photos')){
                    foreach($images as $item){
                        if($count < 4){
                            $var = date_create();
                            $date = date_format($var, 'Ymd');
                            $imageName = $date.'-'.$item->getClientOriginalName();
                            $item->storeAs('public/photos/', $imageName);
                            $url = $imageName;
                            $arr[] = $url;
                            $count++;
    
                        }
                    }
                    $images = implode(",", $arr);
                
                $house_ad->title = $request->title;
                $house_ad->ads_type = $request->ads_type;
                $house_ad->real_state_type = $request->real_state_type;
                $house_ad->condition = $request->condition;
                $house_ad->price = $request->price;
                $house_ad->bedroom = $request->bedroom;
                $house_ad->bathroom = $request->bathroom;
                $house_ad->parking = $request->parking;
                $house_ad->square_meters = $request->square_meters;
                $house_ad->amenities = $request->amenities;
                $house_ad->description = $request->description;
                $house_ad->category_id = $request->category_id;
                $house_ad->subcategory_id = $request->subcategory_id;
                $house_ad->county_id = $request->county_id;
                $house_ad->city_id = $request->city_id;
                $house_ad->user_id = $request->user_id;
                $house_ad->package_id = $request->package_id;
                $house_ad->photos = $images;
                $house_ad->save();
                    }
                    return redirect() -> route('user.dashboard')->with('success','New House Ad Added');
    }

    public function show_house_ad_post(House_ad $house_ad) {
                $arr['house_ad'] = $house_ad;
                $arr['categories'] = Category::select('category_name','id')->where('id',1)->get();
                $arr['subcategories'] = Subcategory::select('subcategory_name','id')->where('category_id',1)->get();
                $arr['counties'] = County::all();
                $arr['cities'] = City::all();
                return view('user.postad.house_ad_show')->with($arr);
    }
    public function edit_house_ad(House_ad $house_ad) {
        $arr['house_ad'] = $house_ad;
        $arr['categories'] = Category::select('category_name','id')->where('id',1)->get();
        $arr['subcategories'] = Subcategory::select('subcategory_name','id')->where('category_id',1)->get();
        $arr['counties'] = County::all();
        $arr['cities'] = City::all();
        return view('user.postad.house_ad_edit')->with($arr);
    }
    public function update_house_ad(Request $request, House_ad $house_ad){

        $this->validate($request,[
            'title' => 'required',
            'ads_type' => 'required',
            'real_state_type' => 'required',
            'condition' => 'required',
            'price' => 'required',
            'bedroom' => 'required',
            'bathroom' => 'required',
            'parking' => 'required',
            'square_meters' => 'required',
            'amenities' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'county_id' => 'required',
            'city_id' => 'required',
            'package_id' => 'required',
            ]);
            $house_ad->title = $request->title;
            $house_ad->ads_type = $request->ads_type;
            $house_ad->real_state_type = $request->real_state_type;
            $house_ad->condition = $request->condition;
            $house_ad->price = $request->price;
            $house_ad->bedroom = $request->bedroom;
            $house_ad->bathroom = $request->bathroom;
            $house_ad->parking = $request->parking;
            $house_ad->square_meters = $request->square_meters;
            $house_ad->amenities = $request->amenities;
            $house_ad->description = $request->description;
            $house_ad->category_id = $request->category_id;
            $house_ad->subcategory_id = $request->subcategory_id;
            $house_ad->county_id = $request->county_id;
            $house_ad->city_id = $request->city_id;
            $house_ad->package_id = $request->package_id;
         
            $house_ad->save();
            return redirect() -> route('user.user_cart')->with('success','House Ad Updated');
    }

    public function house_ad_destroy($id) {
        $house_ad = House_ad::find($id);
        
        $house_ad->delete(public_path().'/photos/'.$house_ad->photos);
        return redirect() -> route('user.user_cart')->with('success','Removed Succesfully');;
    }
    public function pay_house_ad (House_ad $house_ad) {
        $arr['house_ad'] = $house_ad;
        return view('user.postad.house_ad_pay')->with($arr);
    }

    /**
     * The Functionality of Cars Ads.
    */

    public function create_car_ad_post( Category $category_id, Subcategory $subcategory_id){
        $arr['subcategory'] =$subcategory_id;
        $arr['category'] = $category_id;
        $arr['counties'] = County::all();
        $arr['cities'] = City::all();
        $arr['makes'] = Car_make::all();
        $arr['model'] = Car_model::all();
        return view('user.postad.car_ad_post')->with($arr);
    }

    public function store_car_ad_post(Request $request, Car_ad $car_ad){

                $this->validate($request,[
                    'title' => 'required',
                    'ads_type' => 'required',
                    'make' => 'required',
                    'model' => 'required',
                    'year_of_build' => 'required',
                    'condition' => 'required',
                    'mileage' => 'required',
                    'transmission' => 'required',
                    'fuel_type' => 'required',
                    'price' => 'required',
                    'description' => 'required',
                    'category_id' => 'required',
                    'subcategory_id' => 'required',
                    'county_id' => 'required',
                    'city_id' => 'required',
                    'user_id' => 'required',
                    'package_id' => 'required',
                    'photos' => 'required',
                    'color' => 'required',
                    'body_type' => 'required',
                    'interior_type' => 'required',
                    'engine_size' => 'required',
                    'duty_type' => 'required',
                    
                    
                    ]);
        
                    $images = $request->File('photos');
                    $count = 0;
                    if($request->File('photos')){
                        foreach($images as $item){
                            if($count < 4){
                                $var = date_create();
                                $date = date_format($var, 'Ymd');
                                $imageName = $date.'-'.$item->getClientOriginalName();
                                $item->storeAs('public/photos/', $imageName);
                                $url = $imageName;
                                $arr[] = $url;
                                $count++;
        
                            }
                        }
                        $images = implode(",", $arr);
                    
                    $car_ad->title = $request->title;
                    $car_ad->ads_type = $request->ads_type;
                    $car_ad->make = $request->make;
                    $car_ad->model = $request->model;
                    $car_ad->year_of_build = $request->year_of_build;
                    $car_ad->condition = $request->condition;
                    $car_ad->mileage = $request->mileage;
                    $car_ad->transmission = $request->transmission;
                    $car_ad->fuel_type = $request->fuel_type;
                    $car_ad->price = $request->price;
                    $car_ad->description = $request->description;
                    $car_ad->category_id = $request->category_id;
                    $car_ad->subcategory_id = $request->subcategory_id;
                    $car_ad->county_id = $request->county_id;
                    $car_ad->city_id = $request->city_id;
                    $car_ad->user_id = $request->user_id;
                    $car_ad->package_id = $request->package_id;
                    $car_ad->photos = $images;
                    $car_ad->color = $request->color;
                    $car_ad->body_type = $request->body_type;
                    $car_ad->interior_type = $request->interior_type;
                    $car_ad->engine_size = $request->engine_size;
                    $car_ad->duty_type = $request->duty_type;
 




                    $car_ad->save();
                        }
                        return redirect() -> route('user.dashboard')->with('success','New Car Ad Added');
    }

    public function show_car_ad_post(Car_ad $car_ad) {
                    $arr['car_ad'] = $car_ad;
                    $arr['categories'] = Category::select('category_name','id')->where('id',1)->get();
                    $arr['subcategories'] = Subcategory::select('subcategory_name','id')->where('category_id',1)->get();
                    $arr['counties'] = County::all();
                    $arr['cities'] = City::all();
                    return view('user.postad.car_ad_show')->with($arr);
    }

    public function edit_car_ad(Car_ad $car_ad) {
        $arr['car_ad'] = $car_ad;
        $arr['categories'] = Category::select('category_name','id')->where('id',2)->get();
        $arr['subcategories'] = Subcategory::select('subcategory_name','id')->where('category_id',2)->get();
        $arr['counties'] = County::all();
        $arr['cities'] = City::all();
        return view('user.postad.car_ad_edit')->with($arr);
    }
    public function update_car_ad(Request $request, Car_ad $car_ad){

        $this->validate($request,[
            'title' => 'required',
            'ads_type' => 'required',
            'make' => 'required',
            'model' => 'required',
            'year_of_build' => 'required',
            'condition' => 'required',
            'mileage' => 'required',
            'transmission' => 'required',
            'fuel_type' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'county_id' => 'required',
            'city_id' => 'required',
            'package_id' => 'required',
            ]);  
            $car_ad->title = $request->title;
            $car_ad->ads_type = $request->ads_type;
            $car_ad->make = $request->make;
            $car_ad->model = $request->model;
            $car_ad->year_of_build = $request->year_of_build;
            $car_ad->condition = $request->condition;
            $car_ad->mileage = $request->mileage;
            $car_ad->transmission = $request->transmission;
            $car_ad->fuel_type = $request->fuel_type;
            $car_ad->price = $request->price;
            $car_ad->description = $request->description;
            $car_ad->category_id = $request->category_id;
            $car_ad->subcategory_id = $request->subcategory_id;
            $car_ad->county_id = $request->county_id;
            $car_ad->city_id = $request->city_id;
            $car_ad->package_id = $request->package_id;
            $car_ad->save();
                
                return redirect() -> route('user.user_cart')->with('success','your Car Ad has been updated');
    }
    public function car_ad_destroy($id) {
        $car_ad = Car_ad::find($id);
        
        $car_ad->delete(public_path().'/photos/'.$car_ad->photos);
        return redirect() -> route('user.user_cart')->with('success','Removed Succesfully');;
    }
    public function pay_car_ad (Car_ad $car_ad) {
        $arr['car_ad'] = $car_ad;
        return view('user.postad.car_ad_pay')->with($arr);
    }
    
     /**
     * The Functionality of Land Ads.
     */
    public function create_land_ad_post( Category $category_id, Subcategory $subcategory_id){
        $arr['subcategory'] =$subcategory_id;
        $arr['category'] = $category_id;
        $arr['counties'] = County::all();
        $arr['cities'] = City::all();
        return view('user.postad.land_ad_post')->with($arr);
    }

    public function store_land_ad_post(Request $request, Land_ad $land_ad){

                    $this->validate($request,[
                        'title' => 'required',
                        'ads_type' => 'required',
                        'land_type' => 'required',
                        'square_meters' => 'required',
                        'price' => 'required',
                        'description' => 'required',
                        'category_id' => 'required',
                        'subcategory_id' => 'required',
                        'county_id' => 'required',
                        'city_id' => 'required',
                        'user_id' => 'required',
                        'package_id' => 'required',
                        'photos' => 'required',
            
                        ]);
            
                        $images = $request->File('photos');
                        $count = 0;
                        if($request->File('photos')){
                            foreach($images as $item){
                                if($count < 4){
                                    $var = date_create();
                                    $date = date_format($var, 'Ymd');
                                    $imageName = $date.'-'.$item->getClientOriginalName();
                                    $item->storeAs('public/photos/', $imageName);
                                    $url = $imageName;
                                    $arr[] = $url;
                                    $count++;
            
                                }
                            }
                            $images = implode(",", $arr);
                        
                        $land_ad->title = $request->title;
                        $land_ad->ads_type = $request->ads_type;
                        $land_ad->land_type = $request->land_type;
                        $land_ad->square_meters = $request->square_meters;
                        $land_ad->price = $request->price;
                        $land_ad->description = $request->description;
                        $land_ad->category_id = $request->category_id;
                        $land_ad->subcategory_id = $request->subcategory_id;
                        $land_ad->county_id = $request->county_id;
                        $land_ad->city_id = $request->city_id;
                        $land_ad->user_id = $request->user_id;
                        $land_ad->package_id = $request->package_id;
                        $land_ad->photos = $images;
                        $land_ad->save();
                            }
                            return redirect() -> route('user.dashboard')->with('success','New Land Ad Added');
    }

    public function show_land_ad_post(Land_ad $land_ad) {
        $arr['land_ad'] = $land_ad;
      
        return view('user.postad.land_ad_show')->with($arr);
    }

    public function edit_land_ad(Land_ad $land_ad) {
        $arr['land_ad'] = $land_ad;
        $arr['categories'] = Category::select('category_name','id')->where('id',1)->get();
        $arr['subcategories'] = Subcategory::select('subcategory_name','id')->where('category_id',1)->get();
        $arr['counties'] = County::all();
        $arr['cities'] = City::all();
        return view('user.postad.land_ad_edit')->with($arr);
    }
    public function update_land_ad(Request $request, Land_ad $land_ad){

        $this->validate($request,[
            'title' => 'required',
            'ads_type' => 'required',
            'land_type' => 'required',
            'square_meters' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'county_id' => 'required',
            'city_id' => 'required',
            'package_id' => 'required',

            ]);
            $land_ad->title = $request->title;
            $land_ad->ads_type = $request->ads_type;
            $land_ad->land_type = $request->land_type;
            $land_ad->square_meters = $request->square_meters;
            $land_ad->price = $request->price;
            $land_ad->description = $request->description;
            $land_ad->category_id = $request->category_id;
            $land_ad->subcategory_id = $request->subcategory_id;
            $land_ad->county_id = $request->county_id;
            $land_ad->city_id = $request->city_id;
            $land_ad->package_id = $request->package_id;
            $land_ad->save();
        
                return redirect() -> route('user.user_cart')->with('success','Land Ad has been updated');
    }
    public function land_ad_destroy($id) {
        $land_ad = Land_ad::find($id);
        
        $land_ad->delete(public_path().'/photos/'.$land_ad->photos);
        return redirect() -> route('user.user_cart')->with('success','Removed Succesfully');;
    }
    public function pay_land_ad (Land_ad $land_ad) {
        $arr['land_ad'] = $land_ad;
        return view('user.postad.land_ad_pay')->with($arr);
    }
        

}