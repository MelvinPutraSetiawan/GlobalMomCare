<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /** @use HasFactory<\Database\Factories\ScheduleFactory> */
    use HasFactory;

    protected $fillable = ['account_id', 'professional_id', 'reason', 'status', 'date'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function professional()
    {
        return $this->belongsTo(Account::class, 'professional_id', 'id');
    }
}
