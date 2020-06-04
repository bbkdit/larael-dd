<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $tabel = 'categories';

    public function childs() {
        return $this->hasMany('App\Category','sub_id','id') ;
    }
}
