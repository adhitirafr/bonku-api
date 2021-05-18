<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dept extends Model
{
    use HasFactory, softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deptor_id',
        'original_dept',
        'interest',
        'dept_until',
        'note',
        'total_dept',
        'status'
    ];

    public function scopeActive($query) {
        return $query->where('status', 1)->get();
    }

    public function deptor() {
        return $this->belongsTo(Deptor::class);
    }
}
