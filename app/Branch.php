<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends BaseModel
{
    //
    protected $fillable = ['branch_code','branch_name','branch_city','branch_address','branch_contact_number','branch_contact_number_two'];
}
