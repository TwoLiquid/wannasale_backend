@extends('dashboard.layouts.pages.createdit')

@section('breadcrumb')
    @include('dashboard.layouts.partials.breadcrumb', ['links' => [
        'Список клиентов' => route('dashboard.clients')
    ]])
@stop

@section('title', 'Новый клиент')

@section('fields')
    @include('dashboard.clients.fields')
@stop

@section('back-link')
    {{ route('dashboard.clients') }}
@stop
