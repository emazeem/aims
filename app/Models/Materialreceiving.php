<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Materialreceiving extends Model
{
    use HasFactory;



    use LogsActivity;
    protected static $logAttributes = ["purchase_indent_item_id","received_from","purchase_type","physical_check","meet_specifications","unit","qty","specifications","status"];
    protected static $logOnlyDirty = true;

}
