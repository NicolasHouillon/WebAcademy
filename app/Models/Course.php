<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function user() {
        return $this->hasOne(User::class);
    }

    public function material() {
        return $this->hasOne(Subject::class);
    }

    public function groups() {
        return $this->hasMany(Group::class);
    }

    public function attachments() {
        return $this->belongsToMany(Attachment::class);
    }

}
