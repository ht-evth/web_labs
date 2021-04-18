@extends('layouts.layout')
@section('title', 'Каталог')
@section('content')

  <main id="content">
      <div class="container">
        <h1> Каталог</h1>
        <div class="row">

          @foreach ($tents as $tent)
            <div class="col-lg-3 col-md-6 my-2" id="tent_{{ $tent->PK_Tent }}">
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
                <button type="button" class="btn btn-primary btn-preview" data-bs-toggle="modal" data-bs-target="#previewCar" data-pkcar="{{ $tent->PK_Tent }}">
                  🛈
                </button>
              </div>
              </div>
            </div>

          @endforeach

        </div>
      </div>



      <div class="modal fade" id="previewCar" tabindex="-1" role="dialog" aria-labelledby="previewCarLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="previewCarLabel">Предпросмотр авто</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
              <div class="form-group">
                <label for="modelInfo">Модель: </label>
                <p class="form-control" id="modelInfo"></p>
              </div>

              <div class="form-group">
                <label for="superstructureInfo">Надстройка: </label>
                <p class="form-control" id="superstructureInfo"></p>
              </div>
              <div class="form-group">
                <label for="categoryInfo">Категория: </label>
                <p class="form-control" id="categoryInfo"></p>
              </div>
              <div class="form-group">
                <label for="priceInfo">Цена: </label>
                <p class="form-control" id="priceInfo"></p>
              </div>
              <div class="form-group">
                <label for="yearInfo">Год выпуска: </label>
                <p class="form-control" id="yearInfo"></p>
              </div>

              <div class="form-group">
                <label for="descriptionInfo">Описание: </label>
                <p class="form-control" id="descriptionInfo"></p>
              </div>
            </div>

          </div>
        </div>
      </div>




  </main>
@endsection
