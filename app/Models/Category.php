<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'parent_id', 'slug', 'description', 'image', 'status'];

    public function products()
    {
        return $this->hasMany(Product::class , 'category_id' , 'id');    
    }
    
    public function scopeFilter(Builder $builder, $filter)
    {
        $builder->when($filter['name'] ?? false, function ($builder, $value) {
            $builder->where('categories.name', 'LIKE', "%{$value}%");
        });
        $builder->when($filter['status'] ?? false, function ($builder, $value) {
            $builder->where('categories.status', '=', $value);
        });
    }

    public static function rule($id = 0)
    {
        return [
            'name' => [
                'required', 'string', 'max:255', 'min:3', Rule::unique('categories', 'name')->ignore($id),
            ],
            'parent_id' => [
                'nullable', 'int', 'exists:categories,id',
            ],
            'description' => [
                'nullable', 'string',
            ],
            'image' => [
                'nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048', 'dimensions:min_width=100,min_height=100',
            ],
            'status' => [
                'required', 'in:active,archive',
            ],
        ];
    }
}