<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'category_name','category_slug'
    ];

    public function subCategory()
    {
        return $this->hasMany('App\SubCategory');
    }

}
