<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tent;

class Category extends Model
{
    //имя таблицы
    protected $table = 'category';

    //первичный ключ
    protected $primaryKey = "PK_Category";

    //отключение полей updated_at, created_at
    public $timestamps = false;


    public function tent()
    {
    	return $this->hasMany(Tent::class, 'PK_Category', 'PK_Category');
    }
}
