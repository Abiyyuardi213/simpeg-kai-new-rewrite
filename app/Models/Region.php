<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Region extends Model
{
    protected $table = 'regions';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'region_name',
        'region_description',
        'region_status',
    ];

    protected $casts = [
        'region_status' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($region) {
            if (empty($region->id)) {
                $region->id = (string) Str::uuid();
            }
        });
    }

    public static function createRegion(array $data)
    {
        return self::create([
            'region_name' => $data['region_name'],
            'region_description' => $data['region_description'] ?? null,
            'region_status' => $data['region_status'] ?? true,
        ]);
    }

    public function updateRegion(array $data)
    {
        $this->update([
            'region_name' => $data['region_name'],
            'region_description' => $data['region_description'] ?? $this->region_description,
            'region_status' => $data['region_status'] ?? $this->region_status,
        ]);
    }

    public function deleteRegion()
    {
        return $this->delete();
    }

    public function toggleStatus()
    {
        $this->region_status = !$this->region_status;
        $this->save();
    }

    public function users()
    {
        return $this->hasMany(User::class, 'region_id');
    }
}
