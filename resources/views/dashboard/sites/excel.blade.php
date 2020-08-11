@extends('dashboard.layouts.default')

@section('breadcrumb')
    @include('dashboard.layouts.partials.breadcrumb', ['links' => [
        'Список запросов' => route('dashboard.requests')
    ]])
@stop

@section('title', 'Импорт товаров из Excel')

@section('content')
    <div class="row">
        <div class="col-md-6">
            @component('dashboard.layouts.partials.card')
                @component('dashboard.layouts.partials.form', ['action' => route('dashboard.sites.items.excel.import', $site->id)])
                    @include('dashboard.layouts.partials.forms.file', [
                        'label' => 'Excel файл',
                        'required' => true,
                        'link' => isset($file) ? $file->url : null,
                        'filename' => isset($file) ? $file->filename : null,
                        'name' => 'file',
                    ])

                    <input type="submit" class="btn btn-sm btn-success inline m-t-8" value="Отправить" />
                @endcomponent
            @endcomponent
        </div>
    </div>
@stop