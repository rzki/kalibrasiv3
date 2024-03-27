<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function getRouteKeyName()
    {
        return 'deviceId';
    }
    public function brands()
    {
        return $this->belongsTo(DeviceBrand::class, 'brand_id');
    }
    public function types()
    {
        return $this->belongsTo(DeviceType::class,'type_id');
    }

    public function hospitals()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }
}
