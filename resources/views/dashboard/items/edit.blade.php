@extends('dashboard.layouts.pages.createdit')

@php /** @var \App\Models\Item $item */ @endphp

@section('breadcrumb')
    @include('dashboard.layouts.partials.breadcrumb', ['links' => [
        $item->site->name => route('dashboard.sites.view', $item->site->id)
    ]])
@stop

@section('title', 'Изменение товара сайта ' . $item->site->name)

@section('fields')
    @include('dashboard.items.fields')
@stop

@section('back-link')
    {{ route('dashboard.sites.view', $item->site->id) }}
@stop
