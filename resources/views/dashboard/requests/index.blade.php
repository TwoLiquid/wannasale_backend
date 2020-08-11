@extends('dashboard.layouts.default')

@section('title', 'Список запросов')

@section('content')

    @component('dashboard.layouts.partials.card')

        @php /** @var \App\Models\Request[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator $requests */ @endphp

        @slot('cardHeader')
            @include('dashboard.layouts.partials.create-new-button', [
                'link' => route('dashboard.requests.create')
            ])
        @endslot

        @if(count($requests) > 0)
            <table class="table table-condensed no-footer" role="grid">
                <thead>
                    <tr role="row">
                        <th style="width: 20%" rowspan="1" colspan="1">Статус</th>
                        <th style="width: 30%" rowspan="1" colspan="1">Предложение</th>
                        <th style="width: 30%" rowspan="1" colspan="1">Клиент</th>
                        <th style="width: 20%;" class="text-right" rowspan="1" colspan="1">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $item)
                        <tr role="row">
                            <td>
                                <span class="label label-success">{{ $item->pretty_status }}</span>
                            </td>
                            <td>
                                {!! $item->item !== null ? $item->item->name . '<br />' : ($item->item_name !== null ? $item->item_name . '<br />' : '—') !!}
                                {!! $item->offered_price !== null ? $item->offered_price . ( $item->currency !== null ? ' (' . $item->currency . ')' : '') : '—' !!}
                            </td>
                            <td>
                                {!! $item->name !== null ? $item->name . '<br />' : '' !!}
                                {!! $item->email !== null ? $item->email . '<br />' : '' !!}
                                {!! $item->phone !== null ? $item->phone : '' !!}
                            </td>
                            <td>
                                @include('dashboard.layouts.partials.button-list-delete-big', [
                                    'link' => route('dashboard.requests.delete', $item->id)
                                ])
                                <div class="pull-right m-r-10 m-l-15 m-t-3 hint-text">|</div>
                                <a href="{{ route('dashboard.requests.view', $item->id) }}" class="btn btn-complete btn-xs inline m-b-5 btn-animated from-top fa fa-eye pull-right m-l-5">
                                    <span>Просмотр</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $requests->links() !!}
        @else
            <span class="hint-text m-l-5">Пока нет запросов</span>
        @endif

    @endcomponent

@stop
