<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customizations extends Model
{
    protected $table_name = 'customizations';
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customization_name', 'customization_price'
    ];
}
