<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string $nama
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string|null $google_id
 * @property string|null $google_token
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Pengajuan[] $pengajuans
 */
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users'; // [CHANGED]

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ // [CHANGED]
        'username',
        'nama',
        'email',
        'password',
        'role',
        'google_id',
        'google_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [ // [CHANGED]
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
            'password' => 'hashed',
        ];
    }

    /**
     * Get the requests submitted by the user.
     */
    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class, 'id_user');
    }
}
