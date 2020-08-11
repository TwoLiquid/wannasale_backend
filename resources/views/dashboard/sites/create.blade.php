@extends('dashboard.layouts.pages.createdit')

@section('title', 'Новый сайт')

@section('fields')
    <div class="row">
        <div class="col-md-7">
            @component('dashboard.layouts.partials.card')
                @slot('cardTitle')
                    Основные данные
                @endslot

                @include('dashboard.sites.fields')

            @endcomponent
        </div>
    </div>
@stop
