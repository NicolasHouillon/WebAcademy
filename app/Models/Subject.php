<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    /**
     * Retourne la liste des cours qui appartiennent à cette matière
     * @return HasMany
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

}
