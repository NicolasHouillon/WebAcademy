<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;

    /**
     * Retourne la liste des utilisateurs qui appartiennent à ce groupe
     * @return HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

}
