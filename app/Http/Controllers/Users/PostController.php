<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\FieldPermission;
use App\Models\Division;
use App\Models\District;
use App\Models\Brand;
use App\Models\BrandModel;
use App\Models\Feature;
use App\Models\FeatureMark;
use App\Models\ItemType;
use App\Models\Post;
use App\Models\Image;
use App\Models\BodyType;
use App\Models\FuelType;
use App\Models\Unit;
use App\Models\FuelTypeMark;
use App\Models\Phone;
use Validator;
use Str;
use App\Rules\OtpValidate;
use App\Rules\phoneValidateRule;
use Log;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=Category::all();
        $division=Division::all();
        $phones=Phone::where('user_id',auth()->user()->id)->get();
        return view('frontend.post.post_form',compact('category','division','phones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return explode(',',$request->feature);
        // return response()->json($request->all());
        Log::info('sdjkflkjlskdjf');
        ($request->has('price_type') ? $price_type='required' : $price_type='nullable');
        ($request->has('price') ? $price='required' : $price='nullable');
        ($request->has('condition') ? $condition='required' : $condition='nullable');
        ($request->has('brand') ? $brand='required' : $brand='nullable');
        ($request->has('model') ? $model='required' : $model='nullable');
        ($request->has('feature') ? $feature='required' : $feature='nullable');
        ($request->has('authenticity') ? $authenticity='required' : $authenticity='nullable');
        ($request->has('item_type') ? $item_type='required' : $item_type='nullable');
        // ($request->has('image') ? $image='required' : $image='nullable');
        // new item
        ($request->has('size') ? $size='required' : $size='nullable');
        ($request->has('run_kilometre') ? $run_kilo='required' : $run_kilo='nullable');
        ($request->has('capacity') ? $capacity='required' : $capacity='nullable');
        ($request->has('body_type') ? $body_type='required' : $body_type='nullable');
        ($request->has('fuel_type') ? $fuel_type='required' : $fuel_type='nullable');
        ($request->has('unit_type') ? $unit_type='required' : $unit_type='nullable');
        ($request->has('manufacture_year') ? $manufacture_year='required' : $manufacture_year='nullable');
        ($request->has('registration_year') ? $registration_year='required' : $registration_year='nullable');
        ($request->has('trim')? $trim='required' : $trim='nullable');
        ($request->has('adress') ? $adress='required' : $adress='nullable');
        ($request->has('transmission') ? $transmission='required' : $transmission='nullable');
        // end new item
        //   return response()->json(['price_type'=>$price_type,'price'=>$price,'condition'=>$condition,'brand'=>$brand,'model'=>$model,'feature'=>$feature,'authenticity'=>$authenticity,'item_type'=>$item_type,'image'=>$image,'trim'=>$trim]);
        $validator=Validator::make($request->all(),[
            'title'=>"required|max:200|min:1",
            'description'=>"required|max:5000|min:1",
            'ad_type'=>"required|max:200|min:1",
            'category'=>"required|max:200|min:1",
            'sub_category'=>"required|max:200|min:1",
            'price_type'=>$price_type."|max:200|min:1",
            'price'=>$price."|max:200|min:1",
            'condition'=>$condition."|max:200|min:1",
            'brand'=>$brand."|max:200|min:1",
            'model'=>$model."|max:200|min:1",
            'feature'=>$feature."|max:200|min:1",
            'authenticity'=>$authenticity."|max:200|min:1",
            'item_type'=>$item_type."|max:200|min:1",
            'size'=>$size."|max:200|min:1",
            'run_kilometre'=>$run_kilo."|max:200|min:1",
            'capacity'=>$capacity."|max:200|min:1",
            'body_type'=>$body_type."|max:200|min:1",
            'fuel_type'=>$fuel_type."|max:200|min:1",
            'unit_type'=>$unit_type."|max:200|min:1",
            'manufacture_year'=>$manufacture_year."|max:4|min:4",
            'registration_year'=>$registration_year."|max:4|min:4",
            'trim'=>$trim."|max:200|min:1",
            'adress'=>$adress."|max:200|min:1",
            'transmission'=>$transmission."|max:200|min:1",
            'cities'=>"required|max:200|min:1",
            'areas'=>"required|max:200|min:1",
            'phones'=>["required","max:11","min:1",new phoneValidateRule],
            'images'=>'required|array',
            'images.*'=>'required|image|mimes:jpeg,png,jpg,svg|max:5120',
        ]);
        if($validator->passes()){
            $post=new Post;
            $post->title=$request->title;
            $post->ad_type=$request->ad_type;
            $post->category_id=$request->category;
            $post->subcategory_id=$request->sub_category;
            if ($request->price_type){
                $post->price_type=$request->price_type;
            }
            if ($request->price){
                $post->price=$request->price;
            }
            if ($request->condition){

                $post->condition=$request->condition;
            }
            if ($request->brand){
                $post->brand_id=$request->brand;
            }
            if ($request->model){
                $post->model_id=$request->model;
            }
            if ($request->authenticity){
                $post->authenticity=$request->authenticity;
            }
            if ($request->item_type){
                $post->item_type=$request->item_type;
            }
            if ($request->item_type){
                $post->item_type=$request->item_type;
            }
            // new item
            if ($request->size){
                $post->size=$request->size;
            }
            if ($request->run_kilometre){
                $post->run_kilo=$request->run_kilometre;
            }
            if ($request->capacity){
                $post->capacity=$request->capacity;
            }
            if ($request->body_type){
                $post->body_type=$request->body_type;
            }
            // if ($request->fuel_type){
            //     $post->fuel_type=$request->fuel_type;
            // }
            if ($request->unit_type){
                $post->unit_id=$request->unit_type;
            }
            if ($request->manufacture_year){
                $post->manufacture_year=$request->manufacture_year;
            }
            if ($request->registration_year){
                $post->registration_year=$request->registration_year;
            }
            if ($request->trim){
                $post->trim=$request->trim;
            }
            if ($request->adress){
                $post->adress=$request->adress;
            }
            if ($request->transmission){
                $post->transmission=$request->transmission;
            }
            // end new item
            $post->division_id=$request->cities;
            $post->district_id=$request->areas;
            $post->description=$request->description;
            $post->phone=$request->phones;
            $post->user_id=auth()->user()->id;
            $post->status=1;
            $post->save();
            if($post && count(explode(',',$request->feature))>0 && isset($request->feature)){
                foreach(explode(',',$request->feature) as $feature){
                    $f=new FeatureMark();
                    $f->post_id=$post->id;
                    $f->feature_id=$feature;
                    $f->status=1;
                    $f->author_id=auth()->user()->id;
                    $f->save();
                }
            }
            if($post && count(explode(',',$request->fuel_type))>0 && isset($request->fuel_type)){
                foreach(explode(',',$request->fuel_type) as $fuel){
                    $f=new FuelTypeMark();
                    $f->post_id=$post->id;
                    $f->fueltype_id=$fuel;
                    $f->status=1;
                    $f->author_id=auth()->user()->id;
                    $f->save();
                }
            }
            if(request()->hasFile('images')){
                foreach($request->images as $img){
                    $image=new Image;
                    $ext=$img->getClientOriginalExtension();
                    $name=Str::uuid().'_'.$request->phone.'_'.time().'.'.$ext;
                    $img->storeAs('public/post_image',$name);
                    $image->image=$name;
                    $image->post_id=$post->id;
                    $image->save();
                }
            }
            if($post){
                return response()->json(['message'=>'Post Added Success','id'=>$post->id]);
            }
        }
        return response()->json(['error'=>$validator->getMessageBag()]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale,$id)
    {
        $brands=Brand::all();
        $models=BrandModel::all();
        $phones=Phone::where('user_id',auth()->user()->id)->get();
        $count=$posts=Post::where('user_id',auth()->user()->id)->whereIn('status',[1,2,7])->where('id',$id)->count();
        if ($count>0) {
            $post=$post=Post::with('category','subcategory','permission','division','district','brand','model','images','user','bodytype','unittype','fueltypemark','featuremark','phones')->where('id',$id)->first();
            // dd($post);
            return view('frontend.post.post_edit',compact('post','brands','models','phones'));
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$locale='en', $id)
    {
        // return count($request->images);
        // return array_filter(explode(',',$request->delete_index));
        // return response()->json($request->all());
        ($request->has('price_type') ? $price_type='required' : $price_type='nullable');
        ($request->has('price') ? $price='required' : $price='nullable');
        ($request->has('condition') ? $condition='required' : $condition='nullable');
        ($request->has('brand') ? $brand='required' : $brand='nullable');
        ($request->has('model') ? $model='required' : $model='nullable');
        ($request->has('feature') ? $feature='required' : $feature='nullable');
        ($request->has('authenticity') ? $authenticity='required' : $authenticity='nullable');
        ($request->has('item_type') ? $item_type='required' : $item_type='nullable');
        // ($request->has('image') ? $image='required' : $image='nullable');
        // new item
        ($request->has('size') ? $size='required' : $size='nullable');
        ($request->has('run_kilometre') ? $run_kilo='required' : $run_kilo='nullable');
        ($request->has('capacity') ? $capacity='required' : $capacity='nullable');
        ($request->has('body_type') ? $body_type='required' : $body_type='nullable');
        ($request->has('fuel_type') ? $fuel_type='required' : $fuel_type='nullable');
        ($request->has('unit_type') ? $unit_type='required' : $unit_type='nullable');
        ($request->has('manufacture_year') ? $manufacture_year='required' : $manufacture_year='nullable');
        ($request->has('registration_year') ? $registration_year='required' : $registration_year='nullable');
        ($request->has('trim')? $trim='required' : $trim='nullable');
        ($request->has('adress') ? $adress='required' : $adress='nullable');
        ($request->has('transmission') ? $transmission='required' : $transmission='nullable');
        // end new item
        //   return response()->json(['price_type'=>$price_type,'price'=>$price,'condition'=>$condition,'brand'=>$brand,'model'=>$model,'feature'=>$feature,'authenticity'=>$authenticity,'item_type'=>$item_type,'image'=>$image,'trim'=>$trim]);
        $validator=Validator::make($request->all(),[
            'title'=>"required|max:200|min:1",
            'description'=>"required|max:5000|min:1",
            'ad_type'=>"required|max:200|min:1",
            'category'=>"required|max:200|min:1",
            'sub_category'=>"required|max:200|min:1",
            'price_type'=>$price_type."|max:200|min:1",
            'price'=>$price."|max:200|min:1",
            'condition'=>$condition."|max:200|min:1",
            'brand'=>$brand."|max:200|min:1",
            'model'=>$model."|max:200|min:1",
            'feature'=>$feature."|max:200|min:1",
            'authenticity'=>$authenticity."|max:200|min:1",
            'item_type'=>$item_type."|max:200|min:1",
            // new fields
            'size'=>$size."|max:200|min:1",
            'run_kilometre'=>$run_kilo."|max:200|min:1",
            'capacity'=>$capacity."|max:200|min:1",
            'body_type'=>$body_type."|max:200|min:1",
            'fuel_type'=>$fuel_type."|max:200|min:1",
            'unit_type'=>$unit_type."|max:200|min:1",
            'manufacture_year'=>$manufacture_year."|max:4|min:4",
            'registration_year'=>$registration_year."|max:4|min:4",
            'trim'=>$trim."|max:200|min:1",
            'adress'=>$adress."|max:200|min:1",
            'transmission'=>$transmission."|max:200|min:1",
            // end new fields
            'cities'=>"required|max:200|min:1",
            'areas'=>"required|max:200|min:1",
            'phones'=>["required","max:11","min:1",new phoneValidateRule()],
            // 'otp'=>['required','max:6','min:6'],
            'images'=>'required|array|min:1|max:5',
            'images.*'=>'required|image|mimes:jpeg,png,jpg,svg|max:2024',
        ]);
        if($validator->passes()){
            $post=Post::find($id);
            $post->title=$request->title;
            $post->ad_type=$request->ad_type;
            $post->category_id=$request->category;
            $post->subcategory_id=$request->sub_category;
            if ($request->price_type){
                $post->price_type=$request->price_type;
            }
            if ($request->price){
                $post->price=$request->price;
            }
            if ($request->condition){
                $post->condition=$request->condition;
            }
            if ($request->brand){
                $post->brand_id=$request->brand;
            }
            if ($request->model){
                $post->model_id=$request->model;
            }
            if ($request->authenticity){
                $post->authenticity=$request->authenticity;
            }
            if ($request->item_type){
                $post->item_type=$request->item_type;
            }
            if ($request->item_type){
                $post->item_type=$request->item_type;
            }
            // new item
            if ($request->size){
                $post->size=$request->size;
            }
            if ($request->run_kilometre){
                $post->run_kilo=$request->run_kilometre;
            }
            if ($request->capacity){
                $post->capacity=$request->capacity;
            }
            if ($request->body_type){
                $post->body_type=$request->body_type;
            }
            // if ($request->fuel_type){
            //     $post->fuel_type=$request->fuel_type;
            // }
            if ($request->unit_type){
                $post->unit_id=$request->unit_type;
            }
            if ($request->manufacture_year){
                $post->manufacture_year=$request->manufacture_year;
            }
            if ($request->registration_year){
                $post->registration_year=$request->registration_year;
            }
            if ($request->trim){
                $post->trim=$request->trim;
            }
            if ($request->adress){
                $post->adress=$request->adress;
            }
            if ($request->transmission){
                $post->transmission=$request->transmission;
            }
            // end new item
            $post->division_id=$request->cities;
            $post->district_id=$request->areas;
            $post->description=$request->description;
            $post->phone=$request->phones;
            $post->user_id=auth()->user()->id;
            $post->status=1;
            $post->save();
           $del_index=array_filter(explode(',',$request->delete_index),'is_numeric');
            $image=Image::where('post_id',$post->id)->get();
            if(request()->hasFile('images') && count($request->images) <=5){
                foreach($image as $img){
                    unlink(storage_path('app/public/post_image/'.$img->image));
                    Image::where('id',$img->id)->delete();
                }
            }
            if($post && count(explode(',',$request->feature))>0 && isset($request->feature)){
                FeatureMark::where('post_id',$post->id)->delete();
                foreach(explode(',',$request->feature) as $feature){
                    $f=new FeatureMark();
                    $f->post_id=$post->id;
                    $f->feature_id=$feature;
                    $f->status=1;
                    $f->author_id=auth()->user()->id;
                    $f->save();
                }
            }
            if($post && count(explode(',',$request->fuel_type))>0 && isset($request->fuel_type)){
                FuelTypeMark::where('post_id',$post->id)->delete();
                foreach(explode(',',$request->fuel_type) as $fuel){
                    $f=new FuelTypeMark();
                    $f->post_id=$post->id;
                    $f->fueltype_id=$fuel;
                    $f->status=1;
                    $f->author_id=auth()->user()->id;
                    $f->save();
                }
            }
            if(request()->hasFile('images')){
                foreach($request->images as $img){
                    $image=new Image;
                    $ext=$img->getClientOriginalExtension();
                    $name=Str::uuid().'_'.$request->phone.'_'.time().'.'.$ext;
                    $img->storeAs('public/post_image',$name);
                    $image->image=$name;
                    $image->post_id=$post->id;
                    $image->save();
                }
            }
            if($post){
                return response()->json(['message'=>'Post Update Success','id'=>$post->id]);
            }
        }
        return response()->json(['error'=>$validator->getMessageBag()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
    public function postAction(Request $request,$id){
        $post=Post::where('user_id',auth()->user()->id)->where('id',$id)->count();
            if(($request->action==6 or $request->action==7) and $post==1){
                Post::find($id)->update(['status'=>$request->action]);
                return response()->json(['message'=>"Your Action Submitted Success"]);
            }else{
                return response()->json(['error'=>"Something Going Wrong! try again"]);
            }
    }

    public function getSubCategory($locale='en',$id)
    {
        return response()->json(SubCategory::where('category_id',$id)->withCount('posts')->orderBy('posts_count','desc')->get());
    }
    public function getFieldPermission($locale='en',$id)
    {
        return response()->json(FieldPermission::where('subcategory_id',$id)->where('status',1)->get());
    }
    public function getLocation($locale='en',$id)
    {
        return response()->json(District::where('division_id',$id)->get());
    }
    public function getCityLocation($locale='en',$id)
    {
        return response()->json(District::where('division_id',$id)->where('city',1)->get());
    }
    public function getAreaLocation($locale='en',$id)
    {
        return response()->json(District::where('division_id',$id)->where('city',null)->get());
    }
    public function getBrand($locale='en',$id)
    {
        
        // dd(Brand::where('category_id',$id)->withCount('posts')->orderBy('posts_count','desc')->get());
        return response()->json(Brand::where('subcategory_id',$id)->withCount('posts')->orderBy('posts_count','desc')->get());
    }
    public function getBodyType($locale='en',$id)
    {
        return response()->json(BodyType::where('subcategory_id',$id)->get());
    }
    public function getFuelType($locale='en',$id)
    {
        return response()->json(FuelType::where('subcategory_id',$id)->get());
    }
    public function getUnitType($locale='en',$id)
    {
        return response()->json(Unit::where('subcategory_id',$id)->get());
    }
    public function getModel($locale='en',$id){
        return response()->json(BrandModel::where('brand_id',$id)->withCount('posts')->orderBy('posts_count','desc')->get());
    }
    public function getFeature($locale='en',$id){
        return response()->json(Feature::where('subcategory_id',$id)->get());
    }
    public function getItemType($locale='en',$id){
        return response()->json(ItemType::where('subcategory_id',$id)->get());
    }
    public function getData($locale='en',$category_id=null,$subcategory_id=null){
        $brand=$this->getBrand('',$subcategory_id);
        $feature=$this->getFeature('',$subcategory_id);
        $item=$this->getItemType('',$subcategory_id);
        $fueltype=$this->getFuelType('',$subcategory_id);
        $bodytype=$this->getBodyType('',$subcategory_id);
        $unittype=$this->getUnitType('',$subcategory_id);
        return response()->json([
                'brand'=>$brand,
                'feature'=>$feature,
                'item'=>$item,
                'fueltype'=>$fueltype,
                'bodytype'=>$bodytype,
                'unittype'=>$unittype,
            ]);
    }
}
