<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvanceSalary extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the employee that owns the AdvanceSalary
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    
     public function employee()
     {
         return $this->belongsTo(Employee::class, 'employee_id', 'id');
     }
}     
