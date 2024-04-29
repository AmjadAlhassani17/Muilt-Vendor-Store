<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Intl\Countries;

class OrderAddress extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'type', 'first_name', 'last_name', 'email_address'
        , 'phone_number', 'mailing_address', 'city', 'state', 'postal_code', 'country'];

    public $timestamps = false;

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getCountryNameAttribute()
    {
        return Countries::getName($this->country);
    }

    public static function rule()
    {
        return [
            'addr.billing.first_name' => 'required|string|max:255|min:2',
            'addr.billing.last_name' => 'required|string|max:255|min:2',
            'addr.billing.email_address' => 'required|string|max:255|min:6',
            'addr.billing.phone_number' => 'required|string|max:255|min:10',
            'addr.billing.mailing_address' => 'required|string|max:255|min:6',
            'addr.billing.city' => 'required|string|max:255|min:2',
            'addr.billing.postal_code' => 'nullable|string|max:255|min:2',
            'addr.billing.country' => 'required|string',
            'addr.billing.state' => 'required|string|max:255|min:2',
            'addr.shipping.first_name' => 'required|string|max:255|min:2',
            'addr.shipping.last_name' => 'required|string|max:255|min:2',
            'addr.shipping.email_address' => 'required|string|max:255|min:6',
            'addr.shipping.phone_number' => 'required|string|max:255|min:10',
            'addr.shipping.mailing_address' => 'required|string|max:255|min:6',
            'addr.shipping.city' => 'required|string|max:255|min:2',
            'addr.shipping.postal_code' => 'nullable|string|max:255|min:2',
            'addr.shipping.country' => 'required|string',
            'addr.shipping.state' => 'required|string|max:255|min:2',
        ];
    }
}