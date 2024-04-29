<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'store_id' , 'category_id' , 'name' , 'slug' , 'description' , 'image' ,
        'price' , 'compare_price' , 'options' , 'rating' , 'featured' , 'status'
    ];
    
    protected static function booted()
    {
        static::addGlobalScope('store', new StoreScope());
    }

    public function scopeActive(Builder $builder) // Product::active();
    {
        $builder->where('status' , '=' , 'active');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id', 'id', 'id');
    }

    public function orders(){
        return $this->belongsToMany(Order::class , 'order_products' , 'product_id' , 'order_id' , 'id' , 'id');
    }

    public function getImageUrlAttribute()
    {
        if(!$this->image){
            return 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSR1HL8Feq6I9wLx_kQeh1VbJeaykBdacw-s2vxdoHx0w&s';
        }
        if(Str::startsWith($this->image, ['http://' , 'https://'])){
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }

    public function getPriceDiscoundAttribute()
    {
        return round(100 - (100 * $this->price / $this->compare_price) , 1);
    }
    
}