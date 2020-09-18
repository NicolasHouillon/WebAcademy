<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attachment extends Model
{
    use HasFactory;

    /**
     * Retourne le cours qui possède ce fichier
     * @return BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
