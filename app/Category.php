<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table_name = 'categories';
	public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_name', 'category_active', 'category_delete', 'category_slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
