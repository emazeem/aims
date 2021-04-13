<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
class AccLevelOne extends Model
{
    use SoftDeletes;
    public function leveltwo(){
        return $this->hasMany('App\Models\AccLevelTwo', 'code1');
    }
    use HasFactory,LogsActivity;
    protected static $logAttributes = ['title'];
    protected static $logOnlyDirty = true;
}