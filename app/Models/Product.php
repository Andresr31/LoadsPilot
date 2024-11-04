<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'material',
        'reference',
        'lote',
        'date_of_manufacture',
        'expiration_date',
        'amount',
        'user_id',
        'lote_provider',
        'responsible'
    ];

    ////////////////////////////////////
    // Relaciones
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
