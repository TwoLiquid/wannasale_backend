@extends('dashboard.layouts.default')

@section('title', 'Список транзакций')

@section('content')

    @if(count($subscriptions) > 0)
        @foreach($subscriptions as $subscription)
            @component('dashboard.layouts.partials.card')

                @slot('cardTitle')
                    Тариф <strong>{{ $subscription->rate->name }}</strong>
                @endslot

                @php /** @var \App\Models\Request[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator $transactions */ @endphp

                @if(count($subscription->transactions) > 0)
                    <table class="table table-condensed no-footer" role="grid">
                        <thead>
                        <tr role="row">
                            <th style="width: 18%" rowspan="1" colspan="1">Дата</th>
                            <th style="width: 18%" rowspan="1" colspan="1">Тип</th>
                            <th style="width: 26%" rowspan="1" colspan="1">Информация</th>
                            <th style="width: 16%" rowspan="1" colspan="1">Номер карты</th>
                            <th style="width: 12%" rowspan="1" colspan="1">Тип карты</th>
                            <th style="width: 12%" rowspan="1" colspan="1">Сумма</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subscription->transactions as $item)
                            <tr role="row">
                                <td><span class="label">{{ $item->created_at->format('d-m-y H:i:s') }}</span></td>
                                <td>
                                    {{ trans('models/transaction.type')[$item->type] }}
                                </td>
                                <td>{{ $item->message }}</td>
                                <td>************{{ $item->card_last_digits }}</td>
                                <td>{{ $item->card_type }}</td>
                                <td><code>{{ $item->amount }} {!! config('currency.default.icon') !!}</code></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <span class="hint-text m-l-5">Пока нет транзакций</span>
                @endif

            @endcomponent
        @endforeach
    @endif

@stop
