<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Attendance extends Model
{
    use HasFactory;
    protected $guarded = [];

          
     public function employee()
     {
         return $this->belongsTo(Employee::class, 'employee_id', 'id');
     }

     public static function uniqueTogetherRules($id = null)
     {
         return [
             'date' => [
                 'required',
                 Rule::unique('attendances')->where(function ($query) {
                     return $query->where('employee_id', request('employee_id'));
                 })->ignore($id),
             ],
             'employee_id' => 'required',
         ];
     }
}
