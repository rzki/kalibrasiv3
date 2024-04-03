<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function getRouteKeyName()
    {
        return 'inv_id';
    }
    public function devnames()
    {
        return $this->belongsTo(DeviceName::class, 'device_name');
    }
}
