<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    //
    protected $fillable = ['policy_id', 'title','name','surname', 'email','contact_number','gender','national_id_number','date_of_birth','relationship'];
}
