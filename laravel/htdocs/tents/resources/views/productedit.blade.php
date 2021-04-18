
@extends('layouts.layout')

@section('title')
  @if ($currentTent->exists)
    Изменить палатку
  @else
    Добавить палатку
  @endif
@endsection



@section('content')

    <main id="content">
      <div class="container">

        @if ($currentTent->exists)
          <form method="POST" action="{{ route('tents.update', $currentTent->PK_Tent) }}" enctype="multipart/form-data">
        @else
          <form method="POST" action="{{ route('tents.store') }}" enctype="multipart/form-data">
        @endif
        @csrf

          @if ($errors->any())
          <div class="row justify-content-center">
            <div class="col-md-11">
              <div class="alert alert-danger" role="alert">
                {{ $errors->first() }}
              </div>
            </div>
          </div>
          @endif

          <div class="form-group edit-fields">
            <label for="PK_Brand">Бренд</label>
            <select required name="PK_Brand" type="text" class="form-control" placeholder="Укажите бренд">
              @foreach ($brands as $brand)
              <option @if ($brand->PK_Brand == $currentTent->PK_Brand) selected @endif
                        id = "BrandPK" name="BrandPK" value="{{ $brand->PK_Brand }}">
                {{ $brand->name }}
              </option>
              @endforeach
            </select>
          </div>

          <div class="form-group edit-fields">
            <label for="name">Название</label>
            <input required name="name" type="text" class="form-control" placeholder="Название" value= "{{ old( 'price', $currentTent->name) }}">
          </div>

          <div class="form-group edit-fields">
            <label for="PK_Category">Категория</label>
            <select required name="PK_Category" type="text" class="form-control" placeholder="Укажите категорию">
              @foreach ($categories as $category)
              <option @if ( $category->PK_Category == $currentTent->PK_Category ) selected @endif
                        id = "CategoryPK" name="CategoryPK" value=" {{ $category->PK_Category }} ">
                {{ $category->name }}
              </option>
              @endforeach
            </select>
          </div>

          <div class="form-group edit-fields">
            <label for="price">Цена</label>
            <input required name="price" type="number" class="form-control" placeholder="Введите цену" value= "{{ old( 'price', $currentTent->price) }}">
          </div>

          <div class="form-group edit-fields">
            <label for="places">Кол-во мест</label>
            <input required name="places" type="number" class="form-control" placeholder="введите кол-во мест" value= "{{ old( 'places', $currentTent->places) }}">
          </div>

          <div class="form-group edit-fields">
            <label for="weight">Вес</label>
            <input required name="weight" type="number" class="form-control" placeholder="Введите вес" value= "{{ old( 'weight', $currentTent->weight) }}">
          </div>

          <div class="form-group edit-fields">
            <label for="doors">Кол-во входов</label>
            <input required name="doors" type="number" class="form-control" placeholder="введите кол-во входов" value= "{{ old( 'doors', $currentTent->doors) }}">
          </div>

          <div class="form-group edit-fields">
            <label for="windows">Кол-во окон</label>
            <input required name="windows" type="number" class="form-control" placeholder="введите кол-во окон" value= "{{ old( 'windows', $currentTent->windows) }}">
          </div>


          <div class="form-group edit-fields">
            <label for="description">Описание</label>
            <textarea class="description form-control" name="description">{{ old('description', $currentTent->description) }}</textarea></p>
          </div>

          <div class="form-group edit-fields">
            <label for="image">Изображение</label>
            <input name = "image" type="file" class="chooseFile form-control-file" placeholder="Выберите изображение" value= "{{ old( 'image', $currentTent->image_path) }}">
          </div>


          <div class="btn-group">
            <button type="submit" class="btn btn-success">Сохранить</button>
            <button type="button" class="btn btn-default" onclick="javascript:history.back()">Назад</button>
          </div>
        </form>

      </div>
    </main>

@endsection
