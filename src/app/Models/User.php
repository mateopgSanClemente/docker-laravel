<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Determina si el usuario tiene el rol 'cliente'.
     * 
     * @return bool
     */
    public function isCliente(): bool
    {
        return $this->role === 'cliente';
    }

    /**
     * Determina si el usuario tiene el rol 'taller'.
     * 
     * @return bool
     */
    public function isTaller(): bool
    {
        return $this->role === 'taller';
    }

    /**
     * Define las reglas de validación
     */
    public static function rules($userId = null)
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:user, email,' . $userId,
            'password' => 'required|min:8',
            'role' => 'required'
        ];
    }
    /**
     * Devuelve un array asociativo con los roles validos
     */
    public static function roles(): array
    {
        return [
            'cliente' => 'Cliente',
            'taller' => 'Taller'
        ];
    }

    /**
     * Devuelve el número de citas que tiene el cliente.
     */
    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}
