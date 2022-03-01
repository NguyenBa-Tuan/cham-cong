<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'user_id',
        'basic_salary',
        'daily_salary',
        'standard_date',
        'paid_leave',
        'overtime_date',
        'overtime_salary',
        'number_working_day',
        'punish',
        'bonus',
        'overtime',
        'hourly_overtime',
        'salary',
        'note',
        'bhxh',
    ];
}
