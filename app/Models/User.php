<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'surname',
    'patronymic',
    'login',
    'password',
    'photo_file',
    'role_id',
  ];
  protected $hidden = [
    'api_token',
    'created_at',
    'updated_at',
    'role_id',
  ];

  public function role(): BelongsTo
  {
    return $this->belongsTo(Role::class);
  }

  /** Метод для генерации токена **/
  public function generateToken(): string
  {
    $this->api_token = Hash::make(Str::random());
    $this->save();

    return $this->api_token;
  }

  /** Метод для проверки роли из списка ролей **/
  public function hasRole($roles): bool
  {
    return in_array($this->role->code, $roles);
  }

  /** Метод для выхода из системы **/
  public function logout(): void
  {
    $this->api_token = '';
    $this->save();
  }
}
