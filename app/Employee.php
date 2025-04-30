<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [''];

    
    protected $appends = ['name'];
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
}
