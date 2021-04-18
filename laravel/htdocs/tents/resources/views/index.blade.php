
@extends('layouts.layout')

@section('title', 'Главная')


@section('content')

  <main id="content">
    <div class="container">
      <h1>Главная</h1>
    </div>
    <div id="mainpagecontent">
      <div class="container">
        <div class="row">
          <div class="company-info col-lg-5">
            <p class="h1">Палатки для кемпинга и экспедиций</p>
          </div>

          <div class="company-info col-lg-7">
            <a href="catalog"> <p class="h1">Перейти к каталогу</p> </a>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-11">
            <img src="img/indeximage.jpg" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
  </main>

@endsection
