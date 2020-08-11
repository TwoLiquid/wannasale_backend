@extends('dashboard.layouts.pages.createdit')

@php /** @var \App\Models\Request $request */ @endphp

@section('breadcrumb')
    @include('dashboard.layouts.partials.breadcrumb', ['links' => [
        'Список запросов' => route('dashboard.requests')
    ]])
@stop

@section('title', 'Новый запрос')

@section('fields')
    @include('dashboard.requests.fields')
@stop

@section('back-link')
    {{ route('dashboard.requests') }}
@stop
