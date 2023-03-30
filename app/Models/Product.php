<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\Cartable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected static $logName = 'Product';

    protected $guarded = [];

    public function getUnitPriceAttribute($value)
    {
        return number_format($value, 2);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName('Product')->logFillable();
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}
