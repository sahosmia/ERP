<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FabricStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'fabric_id',
        'transaction_type',
        'qty',
        'barcode',
    ];

    public function fabric()
    {
        return $this->belongsTo(Fabric::class);
    }
}