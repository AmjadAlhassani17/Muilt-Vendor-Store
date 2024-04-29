<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Profile extends Model
{
    use HasFactory;

    public $primaryKey = 'user_id';

    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'birthday', 'gender',
        'city', 'state', 'street_address', 'postal_code', 'local',
        'country',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function rule()
    {
        return [
            'first_name' => [
                'required', 'string', 'max:255', 'min:3'
            ],
            'last_name' => [
                'required', 'string','max:255', 'min:3'
            ],
            'birthday' => [
                'required', 'date', 'before:today'
            ],
            'gender' => [
                'required', 'string', 'in:male,female',
            ],
            'city' => [
                'required', 'string', 'max:255', 'min:3',
            ],
            'state' => [
                'required', 'string', 'max:255', 'min:2',
            ],
            'street_address' => [
                'nullable', 'string', 'max:255', 'min:3',
            ],
            'postal_code' => [
                'nullable', 'string', 'max:255', 'min:3',
            ],
            'local' => [
                'required', 'string',
            ],
            'country' => [
                'required', 'string',
            ],
        ];
    }
}