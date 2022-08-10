<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function comments(){
        return $this->hasMany(Comment:: class, 'people_id','id');
    }

}
