<?php

namespace App\Models;

use App\Models\EmployeeDept;
use App\Models\EmployeePosition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function departments()
    {
        return $this->belongsTo(EmployeeDept::class, 'employee_dept_id');
    }
    public function positions()
    {
        return $this->belongsTo(EmployeePosition::class, 'employee_position_id');
    }
}
