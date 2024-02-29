<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function categories()
    {
        return $this->belongsTo(DeviceCategory::class, 'device_category_id');
    }
    public function locations()
    {
        return $this->belongsTo(DeviceLocation::class,'device_location_id');
    }
}
