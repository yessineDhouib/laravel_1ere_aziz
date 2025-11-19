<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
      'country_id',
      'state_id',
      'city_id',
      'department_id',
        'first_name',
        'last_name',
        'adress',
        'zip_code',
        'birth_date',
    'date_hired'
];
public function department()
{
   return $this->BelongsTo(department::class);
}
public function country()
{
   return $this->BelongsTo(country::class);
}
public function state()
{
   return $this->belongsTo(state::class);
}
public function city()
{
   return $this->BelongsTo(city::class);
}

}
