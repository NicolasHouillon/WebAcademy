<?php

namespace App\Models;

use App\Models\Pivot\UsersCourses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Course extends Model
{
    use HasFactory;

    /**
     * Retourne l'utilisateur qui a crée ce cours
     * @return HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Retourne la liste des utilisateurs qui suivent ce cours
     * @return BelongsToMany
     */
    public function followed()
    {
        return $this
            ->belongsToMany(User::class)
            ->using(UsersCourses::class)
            ->withPivot('user_id');
    }

    /**
     * Retourne la matière de ce cours
     * @return HasOne
     */
    public function subject()
    {
        return $this->hasOne(Subject::class);
    }

    /**
     * Retourne le niveau scolaire de ce cours
     * @return HasMany
     */
    public function level()
    {
        return $this->hasMany(Level::class);
    }

    /**
     * Retourne les pièces jointes de ce cours
     * @return BelongsToMany
     */
    public function attachments()
    {
        return $this->belongsToMany(Attachment::class);
    }

}
