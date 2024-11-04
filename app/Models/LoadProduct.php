<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoadProduct extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'loads_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'load_id',
        'product_id',
        'tacho_id'
    ];

    ////////////////////////////////////
    // Relaciones
    public function product(){
        return $this->belongsTo('App\Models\Product');
    }

    public function tacho(){
        return $this->belongsTo('App\Models\Tacho');
    }



}
