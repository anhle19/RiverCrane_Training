<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    public $sortable = ['name', 'email', 'group_role', 'is_active'];

    public function scopeAllUser()
    {
        return User::sortable()->where('is_active', 1);
    }

    public function scopeActive($query, $isActive)
    {
        if (!is_null($isActive)) {
            return $query->where('is_active', $isActive);
        }
        return $query;
    }

    public function scopeGroupRole($query, $groupRole)
    {
        if (!is_null($groupRole)) {
            return $query->where('group_role', $groupRole);
        }
        return $query;
    }

    public function scopeEmail($query, $email)
    {
        if (!is_null($email)) {
            return $query->where('email', $email);
        }
        return $query;
    }

    public function scopeName($query, $name)
    {
        if (!is_null($name)) {
            return $query->where('name', 'LIKE', '%' . $name . '%');
        }
        return $query;
    }
}
