<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;

    public $incrementing = false;
     
    protected $fillable = ['cookie_id' , 'user_id' , 'quantity' , 'product_id' , 'options'];


    public static function booted()
    {
        static::creating(function(Cart $cart){
            $cart->id = Str::uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id')->withDefault([
            'name' => 'Anonymous'
        ]);
    }

    public function product()
    {
        return $this->belongsTo(Product::class , 'product_id' , 'id');
    }

    public static function rule()
    {
        return [
            'quantity' => ['nullable' , 'int' , 'min:1']
        ];
    }
}