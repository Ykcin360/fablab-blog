<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\State;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'address',
        'profile_description',
        'phone_number',
        'avatar',
        'birthdate',
        'password',
        'is_admin',
        'gender_id',
        'state'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
    
    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function gender(){
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function reaction()
    {
        return $this->hasOne(Reaction::class);
    }

    public function state()
    {
        return $this->hasOne(State::class);
    }

    public function messages()
    {
        return $this->hasMany(ChMessage::class, 'from_id');
    }
}
