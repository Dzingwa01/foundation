<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends BaseModel
{
    //
    protected $fillable = ['name','guard_name'];
}
