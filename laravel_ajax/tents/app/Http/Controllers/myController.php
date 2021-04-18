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

     // главная страница
    public function index()
    {
        return view('index');
    }

    // каталог
    public function catalog()
    {
        return view('catalog',
            [
                'tents' => Tent::all()
            ]);
    }

    // администрирование каталога
    public function pageadmin()
    {
        return view('pageadmin',
            [
                'tents' => Tent::all()
            ]);
    }


    // информация об эоементе каталога
    public function productinfo($id)
    {
        return view('productinfo',
            [
                'currentTent' => Tent::find($id)
            ]);
    }

    // удаление элемента каталога
    public function deletetent($id)
    {
        $deletingTent = Tent::find($id);

        if($deletingTent)
        {
            $deletingTent->delete();
        }

        return redirect()->route('tents.list');
    }

    // удаление элемента каталога ajax, ответ возвращаем в json
    public function deletetent_ajax(Request $req)
    {
      $deletingTent = Tent::find($req->get("PK_Tent"));

      if($deletingTent == null)
          return response()->json(['name' => 'Как удалить то, чего нет?! Ошибка!', 'status' => '0']);
      else
      {
          $deletingTent->delete();
          return response()->json(['name' => 'Теперь это Вас не побеспокоит! Удалено!', 'status' => '1']);
      }
    }

  /*  // показать информацию о палатке ajax
    public function showtent_ajax($id)
    {
       $currentTent = Tent::find($id);
       print($currentTent);
       console.log($currentTent);
       if($currentTent)
       {
           return response()->json([
               'status' => '1',
               'pk_tent' => $currentTent->PK_Tent,
               'brand' => $currentTent->brand,
               'name' => $currentTent->name,
               'category' => $currentTent->category,
               'price' => $currentTent->price,
               'places' => $currentTent->places,
               'weight' => $currentTent->weight,
           ]);
       }
       else
           return response()->json([
               'status' => '0',
               'info' => 'Не удалось загрузить информацию о палатке',
           ]);


      }

*/

public function previewcar($id)
    {
        $searchingCar = Tent::find($id);

      //  if($searchingCar)
        //{
            return response()->json([
              'status' => '1',
              'pk_tent' => $currentTent->PK_Tent,
              'brand' => $currentTent->brand,
              'name' => $currentTent->name,
              'category' => $currentTent->category,
              'price' => $currentTent->price,
              'places' => $currentTent->places,
              'weight' => $currentTent->weight
            ]);
      //  }
        //else
          //  return response()->json([
            //    'status' => '0',
              //  'info' => 'Failed to load model',
          //  ]);
    }

    // функция для создания формы при добавлении элемента в каталог
    public function createtent()
    {
        $newTent = new Tent();

        $categories = Category::all();
        $brands = Brand::all();

        return view('productedit',
        [
            'currentTent' => $newTent,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    // добавляем в бд новый элемент каталога
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
        {
            return redirect()->route('tents.list');
            return response()->json([
                "status" => '1',
                "PK_Tent" => $newTent->PK_Tent,
            ]);
        }
        else
        {
          return back()->withErrors(['msg' => "Ошибка"])->withInput();
          return response()->json([
              "status" => '0',
              "message" => 'Не удалось добавить объект!'
          ]);
        }
    }


    // функция создания формы для редактирования элемента каталога
    public function edittent($id)
    {
        $currentTent = Tent::find($id);

        $categories = Category::all();
        $brands = Brand::all();

        return view('productedit',
        [
            'currentTent' => $currentTent,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    // функция редактирования данных об элементе каталога
    public function updatetent(Request $req, $id)
    {
        $editTent = Tent::find($id);

        if(empty($editTent))
        {
            return back()->withErrors(['msg' => "Запись не найдена"])->withInput();
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

}
