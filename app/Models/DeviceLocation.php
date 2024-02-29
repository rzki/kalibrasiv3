<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceLocation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function devices()
    {
        return $this->hasMany(Device::class, 'device_id');
    }
}
