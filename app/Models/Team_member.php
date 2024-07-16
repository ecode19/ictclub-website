<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team_member extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'title',
        'professionalism',
        'email',
        'x',
        'whatsApp',
        'facebook',
        'profile_image',
    ];
}
