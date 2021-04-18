<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tent;

class Brand extends Model
{
    //имя таблицы
    protected $table = 'brand';

    //первичный ключ
    protected $primaryKey = "PK_Brand";

    //отключение полей updated_at, created_at
    public $timestamps = false;


    public function tent()
    {
    	return $this->belongsTo(Tent::class, 'PK_Tent', 'PK_Tent');
    }

}
