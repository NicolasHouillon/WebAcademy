<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'group_id',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Le groupe de l'utilisateur
     * @return HasOne
     */
    public function group()
    {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }

    /**
     * La liste des cours que l'utilisateur a créer
     * @return HasMany
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    /**
     * Retourne la liste des cours que l'utilisateur suit
     * @return BelongsToMany
     */
    public function followed()
    {
        return $this
            ->belongsToMany(Course::class, "users_courses");
    }

    /**
     * Retourne la liste des messages que l'utilisateur a envoyé
     * @return BelongsToMany
     */
    public function sendedMessages()
    {
        return $this->belongsToMany(Message::class, 'messages', 'sender_id', 'id');
    }

    /**
     * Retourne la liste des messages que l'utilisateur a reçuu
     * @return BelongsToMany
     */
    public function reveivedMessages()
    {
        return $this->belongsToMany(Message::class, 'messages', 'receiver_id', 'id');
    }

    /**
     * Retourne la liste des paiments que l'utilisateur a réalisé
     * @return HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function children() {
        return $this->belongsToMany(User::class, 'children', 'parent_id', 'child_id');
    }

    public function hasGroup(string $group): bool
    {
        return $this->group->name == $group;
    }

    public function isAdmin()
    {
        return $this->hasGroup("Administrateur");
    }

    /**
     * Retourne le nom complet de l'utilisateur
     * @return string
     */
    public function fullName(): string
    {
        return $this->firstname . " " . $this->lastname;
    }

    /**
     * Retourne le nom complet de l'utilisateur sous forme de slug
     * @return string
     */
    public function slugFullName(): string
    {
        return str_replace(" ", "_", strtolower($this->firstname . " " . $this->lastname));
    }


    public function payCourse($id) : bool {
        return $this->orders->where('course_id', $id)->count() >0;
    }

    /**
     * @param string $slug
     * @return array
     */
    public static function getTeachersForSubject(string $slug)
    {
        $results = DB::select("
            SELECT DISTINCT u.*
            FROM users u INNER JOIN courses c on u.id = c.user_id INNER JOIN subjects s on c.subject_id = s.id
            WHERE s.slug like :slug AND u.group_id = (
                select id from `groups` g where g.name like 'Professeur'
            )
        ", [$slug]);
        return User::hydrate($results);
    }

    public static function getStudents() {
        return User::where('group_id', 4)->orderBy('lastName')->get();
    }

}
