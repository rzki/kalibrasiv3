<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceType extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function brands()
    {
        return $this->belongsTo(DeviceBrand::class, 'brand_id');
    }
}
