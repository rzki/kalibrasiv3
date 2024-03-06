<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function brands()
    {
        return $this->belongsTo(DeviceBrand::class, 'device_brand_id');
    }
    public function types()
    {
        return $this->belongsTo(DeviceType::class,'device_type_id');
    }
}
