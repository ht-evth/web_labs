<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\Category;


class Tent extends Model
{
    //имя таблицы
    protected $table = 'tent';

    //первичный ключ
    protected $primaryKey = "PK_Tent";

    //отключение полей updated_at, created_at
    public $timestamps = false;

    protected $fillable = [
        'PK_Brand',
        'PK_Category',
        'name',
        'price',
        'weight',
        'places',
        'doors',
        'windows',
        'description',
        'imagePath',
    ];


    public function brand()
    {
    	return $this->belongsTo(Brand::class, 'PK_Brand', 'PK_Brand');
    }

    public function Category()
    {
    	return $this->belongsTo(Category::class, 'PK_Category', 'PK_Category');
    }

}
