<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculatorentries extends Model
{
    use HasFactory;
    public function childs(){
        return $this->belongsTo( 'App\Models\Generaldataentries', 'id', 'parent_id' );
    }
    public function child(){

        return $this->hasMany( 'App\Models\Generaldataentries', 'parent_id','id'  );
    }

    public function units(){
        return $this->belongsTo('App\Models\Unit','unit');
    }
    public function parent(){
        return $this->belongsTo('App\Models\Jobitem','job_type_id');
    }

    public function mappings()
    {
        return $this->hasMany('App\Models\Incubatormapping', 'parent_id','id');
    }

    public function incubatorentries()
    {
        return $this->hasMany('App\Models\IncubatorCalculator', 'parent_id','id');
    }
    public function incubatorentry()
    {
        return $this->belongsTo('App\Models\IncubatorCalculator', 'id','parent_id');
    }

}
