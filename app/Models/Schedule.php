<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /** @use HasFactory<\Database\Factories\ScheduleFactory> */
    use HasFactory;

    protected $fillable = ['account_id', 'hospital_id', 'date'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
