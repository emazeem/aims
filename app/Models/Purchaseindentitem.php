<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Purchaseindentitem extends Model
{
    use HasFactory;
    public function receivings(){
        return $this->hasMany('App\Models\Materialreceiving','purchase_indent_item_id','id');
    }
    use LogsActivity;
    protected static $logAttributes = ["indent_id","item_code","item_description","ref_code","unit","last_six_months_consumption","current_stock","qty","purpose", "title", "status"];
    protected static $logOnlyDirty = true;
}
