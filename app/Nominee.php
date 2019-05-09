<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nominee extends BaseModel
{
    //
    protected $fillable = [ 'title','name','surname', 'email','contact_number','gender','national_id_number','date_of_birth','relationship','is_covered','policy_id'
    ];

    public function policy(){
        return $this->belongsTo(Policy::class,'policy_id','id');
    }
}
