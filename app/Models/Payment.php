<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'transaction_id',
        'amount_paid',
        'change_amount',
        'payment_method',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}