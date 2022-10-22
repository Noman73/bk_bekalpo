<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
class Post extends Model
{
    use HasFactory;


    protected $fillable = ['title','ad_type','category_id','subcategory_id','price_type','price','condition','brand_id','model_id','feature_id','authenticity','item_type','division_id','district_id','phone','description','status','published_at'];

    public function images()
    {
        return $this->hasMany(Image::class,'post_id','id');
    }

    public function permission()
    {
        return $this->hasMany(FieldPermission::class,'subcategory_id','subcategory_id');
    }
    
    public function division()
    {
        return $this->belongsTo(Division::class,'division_id','id');
    }
    public function district()
    {
        return $this->belongsTo(District::class,'district_id','id');
    }
    // public function feature()
    // {
    //     return $this->hasMany(Feature::class,'post_id','id');
    // }
    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id','id');
    }
    public function model()
    {
        return $this->belongsTo(BrandModel::class,'model_id','id');
    }
    public function bodytype()
    {
        return $this->belongsTo(BodyType::class, 'body_type','id');
    }
    public function unittype()
    {
        return $this->belongsTo(Unit::class, 'unit_id','id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class,'subcategory_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->diffForHumans();
    }
    public function fueltypemark(){
        return $this->hasMany(FuelTypeMark::class,'post_id','id');
    }
    public function featuremark(){
        return $this->hasMany(FeatureMark::class,'post_id','id');
    }
    public function phones()
    {
        return $this->belongsTo(Phone::class,'phone','id');
    }
    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function scopeFilter($query,$params)
    {
        if(isset($params['search']) && trim($params['search']) != null ){
            $query->where('title', 'like', '%'.trim($params['search']).'%');
        }
        if(isset($params['ad_type']) && trim($params['ad_type']) != null ){
            $query->where('ad_type',  trim($params['ad_type']));
        }
        if(isset($params['condition']) && trim($params['condition']) != null ){
            $query->where('condition',  trim($params['condition']));
        }
        if(isset($params['city']) && trim($params['city']) != null ){
            $query->where('division_id',  trim($params['city']));
        }
        if(isset($params['location']) && trim($params['location']) != null ){
            $query->where('district_id',  trim($params['location']));
        }
        if(isset($params['category']) && trim($params['category']) != null ){
            $query->where('category_id',trim($params['category']) );
        }
        if(isset($params['subcat']) && trim($params['subcat']) != null ){
            $query->where('subcategory_id',trim($params['subcat']) );
        }
        if(isset($params['brand']) && trim($params['brand']) != null ){
            $query->where('brand_id',trim($params['brand']) );
        }
        if(isset($params['brand']) && trim($params['brand']) != null ){
            $query->where('brand_id',trim($params['brand']) );
        }
        if(isset($params['model']) && trim($params['model']) != null ){
            $query->where('model_id',trim($params['model']) );
        }
        if(isset($params['manufacture_min']) && trim($params['manufacture_min']) != null ){
            $query->where('manufacture_year', '>=', trim($params['manufacture_min']) );
        }
        if(isset($params['manufacture_max']) && trim($params['manufacture_max']) != null ){
            $query->where('manufacture_year', '<=', trim($params['manufacture_max']) );
        }
        if(isset($params['kilometer_run_min']) && trim($params['kilometer_run_min']) != null ){
            $query->where('run_kilo', '<=', trim($params['kilometer_run_min']) );
        }
        if(isset($params['kilometer_run_max']) && trim($params['kilometer_run_max']) != null ){
            $query->where('run_kilo', '<=', trim($params['kilometer_run_max']) );
        }
        if(isset($params['item_type']) && trim($params['item_type']) != null ){
            $query->where('item_type', trim($params['item_type']) );
        }
        if(isset($params['body_type']) && trim($params['body_type']) != null ){
            $query->where('body_type', trim($params['body_type']) );
        }
        if(isset($params['authenticity']) && trim($params['authenticity']) != null ){
            $query->where('authenticity', trim($params['authenticity']) );
        }
        if(isset($params['transmission']) && trim($params['transmission']) != null ){
            $query->where('transmission',trim($params['transmission']));
        }
        if(isset($params['min_price']) && trim($params['min_price']) != null ){
            $query->where('price', '>=', trim($params['min_price']) );
        }
        if(isset($params['high_price']) && trim($params['high_price']) != null ){
            $query->where('price', '<=', trim($params['high_price']));
        }
        if(isset($params['sort']['aToZ']) && trim($params['sort']['aToZ']) == 1 ){
            $query->orderBy('title','asc');
        }
        if(isset($params['sort']['zToA']) && trim($params['sort']['zToA']) == 1 ){
            $query->orderBy('title','desc');
        }
        if(isset($params['sort']['lowToHigh']) && trim($params['sort']['lowToHigh']) == 1 ){
            $query->orderBy('price','asc');
        }
        if(isset($params['sort']['highToLow']) && trim($params['sort']['highToLow']) == 1 ){
            $query->orderBy('price','desc');
        }
        return $query;
    }
}
