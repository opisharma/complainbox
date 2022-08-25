<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $fillable = [
        'user_id', 'employee_id', 'department_id', 'subject', 'message','status','document'
    ];
    protected $table = 'mails';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function employees()
    {
        return $this->belongsToMany('App\SubCategory','mail_subcategory','mail_id','subcategory_id')->withTimestamps();
    }
}
