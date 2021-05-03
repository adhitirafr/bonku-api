<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deptor extends Model
{
    use HasFactory, softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone_number',
        'identity',
        'address',
        'note'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function dept() {
        return $this->hasMany(Dept::class);
    }

}
