<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $guarded = [''];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
