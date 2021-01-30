<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class AccLevelOne extends Model
{
    public function leveltwo(){
        return $this->hasMany('App\Models\AccLevelTwo', 'code1');
    }
    use HasFactory,LogsActivity;
    protected static $logAttributes = ['title'];
    protected static $logOnlyDirty = true;
}