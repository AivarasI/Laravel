<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;

     use SoftDeletes; // Naudojame SoftDeletes trait
    protected $fillable = ['name', 'surname', 'address', 'phone', 'city_id',"birthday", "grupe_id", "gim_data"];
    protected $dates = ['deleted_at']; // Nurodome, kad tai data

    // Susiejimas su miestu
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function group()
{
    return $this->belongsTo(Group::class, 'grupe_id');
}
}

