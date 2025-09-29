<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'country',
        'company_name',
        'code',
        'added_by',
        'email',
        'phone',
        'address',
        'representative_name',
        'representative_email',
        'representative_phone',
        'updated_by',
    ];

    public function fabrics()
    {
        return $this->hasMany(Fabric::class);
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