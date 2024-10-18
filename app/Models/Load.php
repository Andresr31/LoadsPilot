<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Load extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'state',
        'date',
        'hour',
        'user_id',
    ];

    ////////////////////////////////////
    // Relaciones
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
