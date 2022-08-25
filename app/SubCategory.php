<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'subcategories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'role_id','category_id','sub_category_name','sub_category_designation','sub_category_slug','sub_category_email','avatar','password'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function mails()
    {
        return $this->belongsToMany('App\Mail','mail_subcategory','subcategory_id','mail_id')->withTimestamps();
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

}
