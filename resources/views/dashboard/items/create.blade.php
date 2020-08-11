@extends('dashboard.layouts.pages.createdit')

@php /** @var \App\Models\Site $site */ @endphp

@section('breadcrumb')
    @include('dashboard.layouts.partials.breadcrumb', ['links' => [
        $site->name => route('dashboard.sites.view', $site->id)
    ]])
@stop

@section('title', 'Новый товар сайта ' . $site->name)

@section('fields')
    @include('dashboard.items.fields')
@stop

@section('back-link')
    {{ route('dashboard.sites.view', $site->id) }}
@stop
