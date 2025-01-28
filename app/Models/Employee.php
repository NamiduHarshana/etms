<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use Notifiable, HasApiTokens; // Added traits for notifications and API tokens

    protected $guard = 'employee';
    protected $fillable = ['name', 'email', 'phone', 'password'];
    protected $hidden = ['password', 'remember_token'];

    /**
     * Define a one-to-many relationship with the Task model.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
