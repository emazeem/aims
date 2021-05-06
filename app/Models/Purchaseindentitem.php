<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Purchaseindentitem extends Model
{
    use HasFactory;
    use LogsActivity;
    protected static $logAttributes = ["indent_id","item_code","item_description","ref_code","unit","last_six_months_consumption","current_stock","qty","purpose", "title", "status"];
    protected static $logOnlyDirty = true;
    public function receiving(){
        return $this->belongsTo('App\Models\Materialreceiving','id','purchase_indent_item_id')->withDefault();
    }
}
