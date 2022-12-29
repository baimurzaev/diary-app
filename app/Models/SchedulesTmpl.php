<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchedulesTmpl extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'user_id', 'time_start'];
}
