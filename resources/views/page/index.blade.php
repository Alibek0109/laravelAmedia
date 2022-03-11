@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">Тестовое задание для компании Amedia Online Group</h2>
        <p>Если вы зарегистрированы, то <a href="{{route('login')}}">войдите</a> в ваше учетную запись</p>
        <p>Если вы не зарегистрированы, то <a href="{{route('login')}}">зарегистрируйтесь</a>.</p>
    </div>
@endsection
