<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'jabatan_name',
        'jabatan_code',
        'jabatan_description',
        'jabatan_sallary',
        'jabatan_status',
    ];

    protected $casts = [
        'jabatan_status' => 'boolean',
        'jabatan_sallary' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('jabatan_status', true);
    }

    public static function createJabatan(array $data)
    {
        return self::create($data);
    }

    public function updateJabatan(array $data)
    {
        $this->update($data);
        return $this;
    }

    public function deleteJabatan()
    {
        return $this->delete();
    }

    public function toggleStatus()
    {
        $this->jabatan_status = !$this->jabatan_status;
        $this->save();
        return $this;
    }
}
