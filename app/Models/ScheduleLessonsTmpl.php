<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleLessonsTmpl extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'schedule_id', 'day_num', 'num_minutes', 'position'];
}
