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
        return 'inventoryId';
    }
    public function logbooks()
    {
        return $this->belongsTo(LogBook::class);
    }
    public function devnames()
    {
        return $this->belongsTo(DeviceName::class, 'device_name');
    }
}
