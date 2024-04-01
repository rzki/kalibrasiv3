<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceName extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}
