<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['name', 'email'];
    protected $casts = ['user_role_id' => 'integer'];

    public function role() {
        return $this->belongsTo(UserRole::class, 'user_role_id');
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
