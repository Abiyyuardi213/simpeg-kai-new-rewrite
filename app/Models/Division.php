<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Division extends Model
{
    use HasFactory;

    protected $table = 'divisions';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'division_name',
        'division_code',
        'division_description',
        'office_id',
        'division_head',
        'division_status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }

    public static function createDivision(array $data)
    {
        return self::create([
            'division_name' => $data['division_name'],
            'division_code' => $data['division_code'],
            'division_description' => $data['division_description'] ?? null,
            'office_id' => $data['office_id'],
            'division_head' => $data['division_head'] ?? null,
            'division_status' => $data['division_status'] ?? true,
        ]);
    }

    public function updateDivision(array $data)
    {
        return $this->update([
            'division_name' => $data['division_name'],
            'division_code' => $data['division_code'],
            'division_description' => $data['division_description'] ?? null,
            'office_id' => $data['office_id'],
            'division_head' => $data['division_head'] ?? null,
            'division_status' => $data['division_status'],
        ]);
    }

    public function deleteDivision()
    {
        return $this->delete();
    }

    public function toggleStatus()
    {
        $this->division_status = !$this->division_status;
        return $this->save();
    }
}
