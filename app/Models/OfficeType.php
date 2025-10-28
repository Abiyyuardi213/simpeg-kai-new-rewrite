<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OfficeType extends Model
{
    protected $table = 'office_types';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'type_name',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($type) {
            if (empty($type->id)) {
                $type->id = (string) Str::uuid();
            }
        });
    }

    public function offices()
    {
        return $this->hasMany(Office::class, 'office_type_id');
    }

    public function toggleStatus()
    {
        $this->status = !$this->status;
        $this->save();
    }
}
