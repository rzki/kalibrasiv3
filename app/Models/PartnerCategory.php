<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function partners()
    {
        return $this->hasMany(Partner::class);
    }
}
