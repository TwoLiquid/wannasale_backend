@extends('dashboard.layouts.default')

@section('title', 'Подписка')

@section('content')

    @php /** @var \App\Models\Subscription $subscription */ @endphp
    <div class="row">

        <div class="col-md-8">

            @if($subscription === null)
                @component('dashboard.layouts.partials.card')
                    @slot('cardTitle')
                        Нет подписки
                    @endslot

                    <p class="m-b-20">У нас все так просто, что даже тариф всего один, который вы можете попробовать в течение <code><strong>{{ config('subscription.trial.days') }} дней</strong></code> совершенно бесплатно.</p>

                    @component('dashboard.layouts.partials.form', ['action' => route('dashboard.subscription.subscribe')])
                        @include('dashboard.layouts.partials.forms.select-simple', [
                            'title' => 'Тарифы',
                            'name' => 'rate',
                            'required' => true,
                            'options' => $rates->pluck('name', 'id')->toArray(),
                            'selected' => 0
                        ])

                        <input type="submit" class="btn btn-sm btn-success inline m-t-8" value="Подписаться" />
                    @endcomponent
                @endcomponent
            @else
                @component('dashboard.layouts.partials.card')
                    @slot('cardTitle')
                        Данные подписки
                    @endslot

                    <table class="table table-hover table-condensed no-footer" role="grid">
                        <thead>
                        <tr>
                            <th style="width: 22%;" rowspan="1" colspan="1">Статус</th>
                            <th style="width: 27%;" rowspan="1" colspan="1">Пробный период</th>
                            <th style="width: 28%;" rowspan="1" colspan="1">Следующая оплата</th>
                            <th style="width: 23%;" rowspan="1" colspan="1">Цена (в месяц)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="noBottomBorder">
                                @if($subscription->active === true)
                                    <span class="label label-success">Активная</span>
                                @else
                                    <span class="label label-danger">Не активная</span>
                                @endif
                            </td>
                            <td class="noBottomBorder">
                                @if($subscription->trial === true)
                                    <span class="label">До {{ $subscription->finish_at->format('d-m-Y') }}</span>
                                @else
                                    <span class="label label-success">Окончен</span>
                                @endif
                            </td>
                            <td class="noBottomBorder">
                                    <span class="label">
                                        {{ $subscription->next_transaction_at->format('d-m-Y') }}
                                    </span>
                            </td>
                            <td class="noBottomBorder">
                                <code>{{ $subscription->price }} {!! config('currency.default.icon') !!}</code>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                @endcomponent

                @if($subscription->ext_id === null)
                    @component('dashboard.layouts.partials.card')
                        @slot('cardTitle')
                            Подписка на оплату
                        @endslot

                        @component('dashboard.layouts.partials.form', ['action' => route('dashboard.subscription.store')])
                            @include('dashboard.layouts.partials.forms.select-simple', [
                                'title' => 'Подписка',
                                'name' => 'months',
                                'required' => true,
                                'options' => trans('models/subscription.months'),
                                'selected' => 0
                            ])
                            <input type="submit" class="btn btn-sm btn-success inline m-t-8" value="Подписаться" />
                        @endcomponent
                    @endcomponent
                @endif
            @endif
        </div>
        <div class="col-md-4">
            @component('dashboard.layouts.partials.card')
                @slot('cardTitle')
                    Информация по тарифу
                @endslot

                <table class="table table-condensed no-footer" role="grid">
                    <tbody>
                    <tr role="row">
                        <td>Название</td>
                        <td>Тариф <strong>"Базовый"</strong></td>
                    </tr>

                    <tr role="row">
                        <td>Стоимость</td>
                        <td>1500 {!! config('currency.default.icon') !!}</td>
                    </tr>
                    </tbody>
                </table>

                <p class="m-t-20">При оплате от <code><stron>6 месяцев</stron></code> стоимость подписки на тариф <strong>"Базовый"</strong> будет составлять <code><strong>1249 {!! config('currency.default.icon') !!}</strong></code></p>

            @endcomponent
        </div>
    </div>

    <style>
        table td.noBottomBorder
        {
            border: 0px !important;
        }
    </style>

@stop