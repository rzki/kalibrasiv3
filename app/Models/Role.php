<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = ['roleId', 'name', 'code'];
    protected $primaryKey = 'roleId';
    public function getRouteKeyName()
    {
        return 'roleId';
    }
    public function users()
    {
        return $this->hasOne(User::class,'user_id');
    }

}
