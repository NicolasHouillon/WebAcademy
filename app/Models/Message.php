<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    /**
     * Retourne l'utilisateur qui a envoyé le message
     * @return HasOne
     */
    public function senderUser()
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }

    /**
     * Retourne l'utilisateur qui a reçu le message
     * @return HasOne
     */
    public function receiverUser()
    {
        return $this->hasOne(User::class, 'id', 'receiver_id');
    }


}
