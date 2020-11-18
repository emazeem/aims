<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    public function categories(){
        return $this->belongsTo('App\Models\Expensecategory','category');
    }
    public function subcategories(){
        return $this->belongsTo('App\Models\Expensecategory','subcategory');
    }

}
