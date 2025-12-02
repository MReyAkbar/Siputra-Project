<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
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
     * Convenience helpers for role checks.
     */
    public function isAdmin(): bool
    {
        return ($this->role ?? 'customer') === 'admin';
    }

    public function isManager(): bool
    {
        return ($this->role ?? 'customer') === 'manager';
    }

    public function isCustomer(): bool
    {
        return ($this->role ?? 'customer') === 'customer';
    }

    /**
     * Relationships for transaction tracking
     */
    public function pembelian()
    {
        return $this->hasMany(\App\Models\TransaksiPembelian::class, 'admin_id');
    }

    public function penjualan()
    {
        return $this->hasMany(\App\Models\TransaksiPenjualan::class, 'admin_id');
    }
}