<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    /** @use HasFactory<\Database\Factories\HospitalFactory> */
    use HasFactory;

    protected $fillable = ['name', 'address'];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
