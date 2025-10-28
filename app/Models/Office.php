<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Office extends Model
{
    protected $table = 'office';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'office_name',
        'office_address',
        'office_code',
        'region_id',
        'office_type_id',
        'office_phone',
        'office_email',
        'office_head',
        'office_status',
    ];

    protected $casts = [
        'office_status' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($office) {
            if (empty($office->id)) {
                $office->id = (string) Str::uuid();
            }
        });
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function officeType()
    {
        return $this->belongsTo(OfficeType::class, 'office_type_id');
    }

    public static function createOffice($data)
    {
        return self::create([
            'office_name' => $data['office_name'],
            'office_address' => $data['office_address'] ?? null,
            'office_code' => $data['office_code'],
            'region_id' => $data['region_id'],
            'office_type_id' => $data['office_type_id'],
            'office_phone' => $data['office_phone'] ?? null,
            'office_email' => $data['office_email'] ?? null,
            'office_head' => $data['office_head'] ?? null,
            'office_status' => $data['office_status'] ?? true,
        ]);
    }

    public function updateOffice($data)
    {
        $this->update([
            'office_name' => $data['office_name'],
            'office_address' => $data['office_address'] ?? $this->office_address,
            'office_code' => $data['office_code'] ?? $this->office_code,
            'region_id' => $data['region_id'] ?? $this->region_id,
            'office_type_id' => $data['office_type_id'] ?? $this->office_type_id,
            'office_phone' => $data['office_phone'] ?? $this->office_phone,
            'office_email' => $data['office_email'] ?? $this->office_email,
            'office_head' => $data['office_head'] ?? $this->office_head,
            'office_status' => $data['office_status'] ?? $this->office_status,
        ]);
    }

    public function deleteOffice()
    {
        return $this->delete();
    }

    public function toggleStatus()
    {
        $this->office_status = !$this->office_status;
        $this->save();
    }
}
