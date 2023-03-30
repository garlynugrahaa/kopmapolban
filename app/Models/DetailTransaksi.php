<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailTransaksi extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    public $table = 'detail_transaksi'; // dilakukan seperti ini agar tidak menjadi plural

    protected $fillable = [
        'id_transaksi',
        'id_product',
        'id_category',
        'price_buy',
        'qty',
        'subtotal',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('Detail_transaksi')
        ->logFillable();
    }
}
