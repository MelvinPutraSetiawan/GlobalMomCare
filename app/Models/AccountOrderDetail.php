<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountOrderDetail extends Model
{
    /** @use HasFactory<\Database\Factories\AccountOrderDetailFactory> */
    use HasFactory;

    protected $fillable = ['status', 'deliver', 'arrive', 'payment', 'processing', 'account_id'];

    // Dipake supaya automatically diaggep jadi Carbon sama Laravel dan bukan string
    protected $casts = [
        'payment' => 'datetime',
        'deliver' => 'datetime',
        'arrive' => 'datetime',
        'processing' => 'datetime',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'accountorderdetail_id');
    }
}
