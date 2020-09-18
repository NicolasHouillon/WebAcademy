<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    public function materials() {
        return $this->hasMany(Subject::class);
    }

    public function courses() {
        return $this->hasMany(Course::class);
    }

}
