<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['city_id','name'];

    public function employee()
    {
       return $this->hasMany(Employee::class);
    }
    public function country()
    {
        return $this->belongsTo(country::class);

    }
    public function state()
    {
        return $this->belongsTo(state::class);

    }
    public function city()
    {
        return $this->belongsTo(city::class);
    }
    

}

