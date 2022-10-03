<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $fillable = [
        'user_login_id',
        'status',
        'sub_total',
        'shipping',
        'total',
    ];

    public function userLogin()
    {
        return $this->belongsTo(UserLogin::class,'user_login_id','id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
