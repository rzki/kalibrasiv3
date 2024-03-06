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
        return 'serial_number';
    }
    public function brands()
    {
        return $this->belongsTo(DeviceBrand::class, 'brand_id');
    }
    public function types()
    {
        return $this->belongsTo(DeviceType::class,'type_id');
    }
}
