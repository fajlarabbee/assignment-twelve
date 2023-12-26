<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'status', 'type', 'seat_capacity'];

    protected $hidden = ['created_at', 'updated_at'];
}
