<?php

namespace App;

use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Model;

class Dependent extends BaseModel
{
    //
    protected $fillable = ['title','name','surname', 'email','contact_number','gender','national_id_number','date_of_birth','relationship','policy_id'];

    public function policy(){
        return $this->belongsTo(Policy::class,'policy_id','id');
    }

}
