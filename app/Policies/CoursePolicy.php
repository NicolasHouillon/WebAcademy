<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    use HandlesAuthorization;

    public function before(User $user, string $ability)
    {
        if ($user->hasGroup("Administrateur")) return true;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Course $model
     * @return mixed
     */
    public function view(User $user, Course $model)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasGroup("Professeur")
            ? Response::allow()
            : Response::deny("Vous devez être professeur pour créer un cours.");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Course $course
     * @return mixed
     */
    public function update(User $user, Course $course)
    {
        return $user->hasGroup("Professeur") && $user->id == $course->user->id
            ? Response::allow()
            : Response::deny("Vous devez être professeur pour modifier un cours.");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Course $course
     * @return mixed
     */
    public function delete(User $user, Course $course)
    {
        return $user->hasGroup("Professeur") && $user->id == $course->user->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Course $course
     * @return mixed
     */
    public function restore(User $user, Course $course)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Course $course
     * @return mixed
     */
    public function forceDelete(User $user, Course $course)
    {
        return false;
    }

}
