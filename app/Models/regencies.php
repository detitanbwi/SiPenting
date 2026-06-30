<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class regencies extends Model
{
    use HasFactory;

    protected $table = 'regencies';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'province_id',
        'name',
    ];

    public function districts()
    {
        return $this->hasMany(districts::class, 'regency_id');
    }
}
