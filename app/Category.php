<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_name', 'category_active', 'category_delete', 'category_slug', 'category_menu', 'category_location','category_meta_title','category_meta_descrption','category_keywords'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public static function cat_name($id)
    {
        $cat = Category::where('id',$id)->first();
        return $cat->category_name;
    }
    
}
