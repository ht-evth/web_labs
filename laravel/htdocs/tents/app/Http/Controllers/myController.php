<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

use App\Models\Tent;
use App\Models\Category;
use App\Models\Brand;

class MyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    //каталог всех продуктов
    public function catalog()
    {
        return view('catalog',
            [
                'tents' => Tent::all()
            ]);
    }

    //просмотр продуктов администратором
    public function pageadmin()
    {
        return view('pageadmin',
            [
                'tents' => Tent::all()
            ]);
    }


    //подробности конкретного продукта
    public function productinfo($id)
    {
        return view('productinfo',
            [
                'currentTent' => Tent::find($id)
            ]);
    }


    //метод рендеринга формы для добавления
    public function createtent()
    {
        $newTent = new Tent();

        //получаем опции для селектов
        $categories = Category::all();
        $brands = Brand::all();

        return view('productedit',
        [
            'currentTent' => $newTent,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    //метод добавления (create)
    public function storetent(Request $req)
    {
        //заполнение данными
        $data = $req->all();
        $newTent = new Tent($data);

        //получить имя файла
        if($req->file('image'))
        {
            $path = $req->file('image')->getClientOriginalName();
            $newTent->image_path = $path;
        }


        $newTent->save();

        if ($newTent)
            return redirect()->route('tents.list');
        else
            return back()->withErrors(['msg' => "Ошибка создания объекта"])->withInput();
    }


    //метод рендеринга формы для редактирования
    public function edittent($id)
    {
        $currentTent = Tent::find($id);

        //получаем опции для селектов
        $categories = Category::all();
        $brands = Brand::all();

        return view('productedit',
        [
            'currentTent' => $currentTent,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    //метод редактирования (update)
    public function updatetent(Request $req, $id)
    {
        $editTent = Tent::find($id);

        if(empty($editTent))
        {
            return back()->withErrors(['msg' => "Ошибка, запись не найдена"])->withInput();
        }

        $data = $req->all();
        $result = $editTent->fill($data);

        // получить имя файла
        if($req->file('image'))
        {
          $path = $req->file('image')->getClientOriginalName();
        }


        $result->save();

        if($result)
            return redirect()->route('tents.list');
        else
            return back()->withErrors(['msg' => "Ошибка, запись не была изменена"])->withInput();
    }


    //метод удаления (delete)
    public function deletetent($id)
    {
        $deletingTent = Tent::find($id);

        if($deletingTent)
        {
            $deletingTent->delete();
        }

        return redirect()->route('tents.list');
    }

}
