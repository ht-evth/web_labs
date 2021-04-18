
@extends('layouts.layout')

@section('title', 'Каталог')



@section('content')

  <main id="content">
      <div class="container">
        <h1> Каталог</h1>
        <div class="row">

          @foreach ($tents as $tent)

            <div class="col-lg-3 col-md-6 my-2">
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
              </div>
            </div>

          @endforeach

        </div>
      </div>
  </main>

@endsection
