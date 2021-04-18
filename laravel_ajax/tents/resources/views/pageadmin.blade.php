
@extends('layouts.layout')

@section('title', 'Администрирование каталога')


@section('content')
  <main id="content">
    <div class="container">
      <h1> Администрирование каталога</h1>

      <div class="add-button">
        <a class="btn btn-success" href="createtent" role="button">+ Добавить</a>
      </div>

      <div class="row">

        @foreach ($tents as $tent)
          <div class="col-lg-3 col-md-6 my-2" data-pktent="{{ $tent->PK_Tent }}" id="tent_{{ $tent->PK_Tent }}">
            <div class="card single-item h-100">
              <a href="productinfo_{{$tent->PK_Tent}}">

                @if ($tent->image_path)
                  <img src="img/{{ $tent->image_path}}" class="card-img-top" alt="{{$tent->name}}">
                @else
                  <img src="img/emptyimage.png" class="card-img-top" alt="Отсутствует">
                @endif

                <div class="card-body">
                  <h5>Палатка {{$tent->name}}</h5>
                  <h6>Категория: {{$tent->Category->name}}</h6>
                  <p>Цена: {{$tent->price}} руб.</p>
                  <p>Кол-во мест: {{$tent->places}}</p>
                  <p>Вес: {{$tent->weight}}</p>
                  <p>Кол-во входов: {{$tent->doors}} </p>
                  <p>Кол-во окон: {{$tent->windows}} </p>
                </div>
              </a>
              <div class="card-footer mt-auto">
                <!-- Админские кнопки редактирования и удаления -->
                  <a class="btn btn-warning edit" href="edittent_{{ $tent->PK_Tent }}" role="button">Изменить</a>

                <!--form method="POST" action="deletetent_{{ $tent->PK_Tent }}">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn btn-danger edit mx-3" onclick="return confirm('Вы действительно хотите удалить запись?');">Удалить</button>
                </form-->
                <a href="" class="btn btn-warning btn-danger mx-3" data-pktent="{{ $tent->PK_Tent }}">Удалить </a>
              </div>
            </div>
          </div>
        @endforeach

      </div>
    </div>
  </main>

@endsection
