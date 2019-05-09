<?php

namespace App;

use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Model;

class Policy extends BaseModel
{
    //
//    protected $dates = ['start_date'];

    protected $fillable = ['policy_number','pay_slip_seen','start_date','client_id','agent_id','funeral_plan_id'];

    public function agent(){
        return $this->belongsTo(User::class,'agent_id','id');
    }

    public function client(){
        return $this->belongsTo(Client::class,'client_id','id');
    }

    public function nominee(){
        return $this->hasOne(Nominee::class,'policy_id','id');
    }

    public function dependents(){
        return $this->hasMany(Dependent::class,'policy_id','id');
    }

    public function children(){
        return $this->hasMany(Children::class,'policy_id','id');
    }

    public function funeral_plan(){
        return $this->belongsTo(FuneralPlan::class,'funeral_plan_id');
    }

}
