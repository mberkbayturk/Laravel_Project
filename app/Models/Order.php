<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $fillable = [
        'user_id',
        'fName',
        'lName',
        'email',
        'phone',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'pincode',
        'total_price',
        'trackingNumber',
        'status',
        'message',
        'payment_mode',
        'payment_mode',
    ];

    public function orderitems() {
        return $this->hasMany(OrderItem::class);
    }
}
