<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    use HasFactory;

    protected $fillable = [

        'dept_name',
        'dept_description',
    ];

      public function admins() {
        return $this->hasMany(Admin::class);
    }
}