@extends('dashboard.layouts.default')

@section('title', 'Блокировка аккаунта')

@section('content')

    @component('dashboard.layouts.partials.card')
        @slot('cardTitle')
            Ваш аккаунт временно заблокирован
        @endslot

    @endcomponent
@stop