<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Attachment extends Model
{
    use HasFactory;

    /**
     * Retourne le cours qui possède ce fichier
     * @return HasOne
     */
    public function course()
    {
        return $this->hasOne(Course::class);
    }

}
