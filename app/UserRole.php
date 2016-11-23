<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $casts = ['user_role_id' => 'integer'];

    public function orders()
    {
        return $this->hasManyThrough(Order::class, User::class);
    }
}
