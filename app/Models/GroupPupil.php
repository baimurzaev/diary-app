<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupPupil extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'pupils_count'];



}
