@extends('dashboard.layouts.default')

@section('title', 'Список клиентов')

@section('content')

    @component('dashboard.layouts.partials.card')

        <script type="text/javascript" src="http://test.wanna.test/assets/widget/js/init.js" id="wannaSaleWidget"></script><script type='text/javascript'>document.addEventListener("DOMContentLoaded", function () {WannaSale.Dialog.show({key: '4DtfrQkq3N',currency: 'RUB',lang: 'ru'});});</script>

        @php /** @var \App\Models\Client[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator $clients */ @endphp

        @slot('cardHeader')
            @include('dashboard.layouts.partials.forms.create-download-button', [
                'name' => 'Скачать Excel',
                'icon' => 'pg-download',
                'link' => route('dashboard.clients.excel')
            ])

            @include('dashboard.layouts.partials.create-new-button', [
                'link' => route('dashboard.clients.create')
            ])
        @endslot

        @if(count($clients) > 0)
            <table class="table table-condensed no-footer" role="grid">
                <thead>
                    <tr role="row">
                        <th style="width: 40%" rowspan="1" colspan="1">Имя</th>
                        <th style="width: 30%;" rowspan="1" colspan="1">Email</th>
                        <th style="width: 30%;" rowspan="1" colspan="1">Телефон</th>
                        <th style="width: 30%;" class="text-right" rowspan="1" colspan="1">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $item)
                        <tr role="row">
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>
                                @include('dashboard.layouts.partials.button-list-delete-big', [
                                    'link' => route('dashboard.clients.delete', $item->id)
                                ])

                                @if(in_array($item->id, $similar))
                                    <div class="pull-right m-r-10 m-l-15 m-t-3 hint-text">|</div>
                                    <a href="" data-client-id="{{ $item->id }}" data-client-name="{{ $item->name }}" data-client-phone="{{ $item->phone }}" data-action="" data-toggle="modal" data-target="#modalClientsMerge" class="btn btn-complete btn-xs inline m-b-5 btn-animated from-top fa fa-list pull-right m-l-5 clientsMergeButton">
                                        <span>Связать</span>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $clients->links() !!}
        @else
            <span class="hint-text m-l-5">Пока нет клиентов</span>
        @endif

        @include('dashboard.clients.modals.template')

        @push('scripts')
            @include('dashboard.clients.modals.scripts')
        @endpush

        <style>
            .hiddenMergeCheckbox {
                margin: 0px 0px 4px 3px;
            }
            #modalMergeTable {
                display: none;
            }
            .errorText {
                color: red;
                font-size: 14px;
                margin: 5px 0px 12px 0px !important;
            }
        </style>

    @endcomponent

@stop