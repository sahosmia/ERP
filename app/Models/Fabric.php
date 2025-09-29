<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fabric extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'fabric_no',
        'composition',
        'gsm',
        'qty',
        'cuttable_width',
        'production_type',
        'construction',
        'color_pantone_code',
        'weave_type',
        'finish_type',
        'dyeing_method',
        'printing_method',
        'lead_time',
        'moq',
        'shrinkage',
        'remarks',
        'fabric_selected_by',
        'image_path',
        'barcode',
        'supplier_id',
        'added_by',
        'updated_by',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function stocks()
    {
        return $this->hasMany(FabricStock::class);
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'notable');
    }
}