<?php

namespace App;

use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Model;

class FuneralPlan extends BaseModel
{
    //

    protected $fillable = ['plan_name','plan_description','premium','number_of_dependents','number_of_children','policy_holder_covered','spouse_covered'];

    public function policies(){
        return $this->hasMany(Policy::class,'funeral_plan_id');
    }

    public function getSpouseCoveredAttribute($value){
        return $value?"Yes":"No";
    }

    public function getPolicyHolderCoveredAttribute($value){
        return $value?"Yes":"No";
    }
}
