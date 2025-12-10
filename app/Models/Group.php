<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name'];

    // Studentų sąsaja
    public function students()
    {
        return $this->hasMany(Student::class, 'grupe_id');
    }
}