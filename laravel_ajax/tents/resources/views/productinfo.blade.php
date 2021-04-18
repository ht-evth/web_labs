
@extends('layouts.layout')

@section('title', 'Информация о продукте')


@section('content')

  <main id="content">
    <div class="container">
      <h1>Палатка {{ $currentTent->name }}</h1>
      <div class="feature">
        <h5>Категория: {{ $currentTent->Category->name }}</h5>

        <div class="row">
            @if ($currentTent->image_path)
              <img src="img/{{ $currentTent->image_path}}" class="col-lg-6" alt="{{$currentTent->name}}">
            @else
              <img src="img/emptyimage.png" class="col-lg-6" alt="Отсутствует">
            @endif
        </div>

        <div class="model-info">
          <p>Производитель: {{ $currentTent->Brand->name }}</p>
          <h5>Цена: {{ $currentTent->price }}</h5>
          <p>
            Описание: {{ $currentTent->description }}
          </p>

          <h5>Основные характеристики</h5>

  				<table class="table">

  					<tbody>
  						<tr>
  							<td>Вес</td>
  							<td>{{ $currentTent->weight }} кг</td>
  						</tr>

  						<tr>
  							<td>Количество мест</td>
  							<td>{{ $currentTent->places }}</td>
  						</tr>

  						<tr>
  							<td>Количество входов</td>
  							<td>{{ $currentTent->doors }}</td>
  						</tr>


  						<tr>
  							<td>Кол-во окон, шт</td>
  							<td>{{ $currentTent->windows }}</td>
  						</tr>

  					</tbody>
  				</table>

        </div>
      </div>
    </div>
  </main>


@endsection
