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
     * @return BelongsTo
     */
    public function senderUser()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    /**
     * Retourne l'utilisateur qui a reçu le message
     * @return BelongsTo
     */
    public function receiverUser()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }


}
