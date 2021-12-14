<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    use HasFactory;

    protected $fillable = [
        'month',
    ];

    public function monthTimesheet()
    {
        return $this->hasOne('App\Models\Timesheet');
    }
}
