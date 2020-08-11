@extends('dashboard.layouts.default')

@section('title', 'Список карт')

@section('content')

    @component('dashboard.layouts.partials.card')

        @php /** @var \App\Models\Client[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator $cards */ @endphp

        @slot('cardHeader')
            @include('dashboard.layouts.partials.create-new-button', [
                'link' => route('dashboard.cards.create')
            ])
        @endslot

        @if(count($cards) > 0)
            <table class="table table-condensed no-footer" role="grid">
                <thead>
                    <tr role="row">
                        <th style="width: 20%" rowspan="1" colspan="1">Добавлена</th>
                        <th style="width: 15%;" rowspan="1" colspan="1">Статус</th>
                        <th style="width: 20%" rowspan="1" colspan="1">Номер</th>
                        <th style="width: 16%;" rowspan="1" colspan="1">Месяц</th>
                        <th style="width: 15%;" rowspan="1" colspan="1">Год</th>
                        <th style="width: 14%;" class="text-right" rowspan="1" colspan="1">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cards as $item)
                        <tr role="row">
                            <td><span class="label">{{ $item->created_at->format('d-m-Y H:i:s') }}</span></td>
                            <td>
                                @if($item->default === true)
                                    <span class="label label-success">Активна</span>
                                @else
                                    <span class="label">Неактивна</span>
                                @endif
                            </td>
                            <td>**** **** **** {{ $item->number }}</td>
                            <td>{{ $item->month }}</td>
                            <td>{{ $item->year }}</td>
                            <td>
                                @include('dashboard.layouts.partials.button-list-delete-big', [
                                    'link' => route('dashboard.cards.delete', $item->id)
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <span class="hint-text m-l-5">Пока нет карт.</span>
        @endif
    @endcomponent
@stop