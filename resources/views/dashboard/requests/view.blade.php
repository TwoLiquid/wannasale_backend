@extends('dashboard.layouts.default')

@php
    /** @var \App\Models\Request $request */
@endphp

@section('breadcrumb')
    @include('dashboard.layouts.partials.breadcrumb', ['links' => [
        'Список запросов' => route('dashboard.requests')
    ]])
@stop

@section('title', 'Просмотр запроса')

@section('content')
    <div class="row">
        <div class="col-md-8">

            @component('dashboard.layouts.partials.card')

                @slot('cardTitle')
                    Переписка с клиентом
                @endslot

                @if(count($messages) > 0)

                    @component('dashboard.layouts.partials.form', ['action' => route('dashboard.requests.messages.get', $request->id)])
                        <button id="updateMessagesButton" type="submit"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                    @endcomponent

                    <div class="view chat-view bg-white clearfix">

                        <div class="chat-inner" id="my-conversation">

                            @foreach($messages as $message)
                                @if($message->author == 1)
                                    <div class="message clearfix">
                                        <div class="profile-img-wrapper m-t-5 inline">
                                            <img class="col-top" width="28" height="28" src="{{ asset('assets/dashboard/img/user_avatar.png') }}" alt="" data-src="{{ asset('assets/dashboard/img/user_avatar.png') }}" data-src-retina="{{ asset('assets/dashboard/img/user_avatar.png') }}">
                                        </div>
                                        <div class="chat-bubble from-them">
                                            <p><strong>{{ $message->title }}</strong></p>
                                            {!! $message->text !!}
                                            @if($message->offered_price === null)
                                                <p>Предлагаемая цена: <span><a href="#" class="requestMessagePrice" data-toggle="modal" data-target="#modalRequestPrice" data-message-id="{{ $message->id }}"><strong>не указана</strong></a></span></p>
                                            @else
                                                <p class="text-right">Предлагаемая цена: <strong>{{ $message->offered_price }} {{ config('currency.default') }}</strong></p>
                                            @endif
                                            {{--<p>Предлагаемая цена: {{ $message->offered_price === null ? 'не указана' : $message->offered_price }}</strong> {{ config('currency.default') }}</p>--}}
                                        </div>
                                    </div>
                                @else
                                    <div class="message clearfix">
                                        <div class="chat-bubble from-me">
                                            <p><strong>{{ $message->title }}</strong></p>
                                            {!! $message->text !!}
                                            <p class="text-right">Предлагаемая цена: <strong>{{ $message->offered_price === null ? 'не указана' : $message->offered_price }} {{ config('currency.default.code') }}</strong></p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                    </div>
                @else
                    <span class="hint-text m-l-5">Пока нет сообщений</span>
                @endif

            @endcomponent

            @component('dashboard.layouts.partials.form', ['action' => route('dashboard.requests.messages.send', $request->id)])
                @component('dashboard.layouts.partials.card')
                    @slot('cardTitle')
                        Отправить сообщение
                    @endslot

                    @include('dashboard.layouts.partials.forms.select-mail-template', [
                        'title' => 'Шаблоны писем',
                        'name' => 'rate',
                        'required' => true,
                        'options' => $messageTemplates,
                        'selected' => 0
                    ])

                    <div class="row">
                        <div class="col-md-9" style="float: left;">
                            @include('dashboard.layouts.partials.forms.text', [
                                'title' => 'Заголовок',
                                'id' => 'mailTitle',
                                'name' => 'title',
                                'required' => true,
                                'value' => '',
                                'placeholder' => 'Введите заголовок письма'
                            ])
                        </div>
                        <div class="col-md-3" style="float: left;">
                            @include('dashboard.layouts.partials.forms.number', [
                                'title' => 'Предлагаемая цена',
                                'id' => 'mailPrice',
                                'name' => 'offered_price',
                                'required' => true,
                                'value' => '',
                                'placeholder' => 'Введите свою цену'
                            ])
                        </div>
                    </div>

                    @include('dashboard.layouts.partials.forms.textarea', [
                        'title' => 'Текст',
                        'id' => 'mailText',
                        'name' => 'text',
                        'required' => true,
                        'values' => '',
                        'placeholder' => 'Ввeдите текст письма'
                    ])

                    <input type="submit" class="btn btn-sm btn-success inline m-t-8" value="Отправить" />
                @endcomponent
            @endcomponent

            <div class="btn-edit-form-group">
                <a href="{{ route('dashboard.requests') }}" class="btn btn-white inline m-b-5">Назад</a>
            </div>
        </div>

        <div class="col-md-4">
            @component('dashboard.layouts.partials.form', ['action' => route('dashboard.requests.update', $request->id)])

                @component('dashboard.layouts.partials.card')
                    @slot('cardTitle')
                        Предложение
                    @endslot

                    @if($request->site !== null)
                        <div>Сайт : <a href="{{ route('dashboard.sites.view', $request->site->id) }}" target="_blank" class="m-l-5 bold">{{ $request->site->name }}</a></div>
                    @endif
                    @if($request->item !== null)
                        <div>Товар : <a href="{{ route('dashboard.items.edit', $request->item->id) }}" target="_blank" class="m-l-5 bold">{{ $request->item->name }}</a></div>
                    @endif
                    @if($request->offered_price !== null)
                        <div>Предложенная цена :
                            <span class="m-l-5 bold">{{ $request->offered_price }}</span>
                            @if($request->item !== null)
                                @if($request->offered_price < $request->item->min_unacceptable_price)
                                    <span class="priceError">(Скидка маловероятна)</span>
                                @elseif($request->offered_price > $request->item->min_unacceptable_price && $request->offered_price < $request->item->min_acceptable_price)
                                    <span class="priceAlert">(Скидка вероятна)</span>
                                @endif
                            @endif
                        </div>
                    @endif
                    @if($request->currency !== null)
                        <div>Валюта : <span class="m-l-5 bold">{{ $request->currency }}</span></div>
                    @endif
                @endcomponent

                @component('dashboard.layouts.partials.card')
                    @slot('cardTitle')
                        Клиент
                    @endslot

                    @if($request->name !== null)
                        <div>Имя : <span class="m-l-5 bold">{{ $request->name }}</span></div>
                    @endif
                    @if($request->email !== null)
                        <div>E-mail : <a href="mailto:{{ $request->email }}" class="m-l-5 bold">{{ $request->email }}</a></div>
                    @endif
                    @if($request->phone !== null)
                        <div>Телефон : <a href="tel:{{ $request->phone }}" class="m-l-5 bold">{{ $request->phone }}</a></div>
                    @endif
                @endcomponent

                @if($request->custom_fields !== null)
                    @component('dashboard.layouts.partials.card')
                        @slot('cardTitle')
                            Дополнительные данные
                        @endslot

                        @foreach($request->custom_fields as $customField)
                            <div>{{ $customField['title'] }} : <span class="m-l-5 bold">{{ $customField['value'] }}</span></div>
                        @endforeach
                    @endcomponent
                @endif

                @component('dashboard.layouts.partials.card')
                    @slot('cardTitle')
                        Источник
                    @endslot

                    @if($request->url !== null)
                        <div>URL страницы : <span class="m-l-5 bold">{{ $request->url }}</span></div>
                    @endif
                    @if($request->ip !== null)
                        <div>IP-адрес : <span class="m-l-5 bold">{{ $request->ip }}</span></div>
                    @endif
                    @if($request->country !== null && $request->city !== null)
                        <div>Местоположение : <span class="m-l-5 bold">{{ $request->city }}, {{ $request->country }}</span></div>
                    @endif
                @endcomponent

                @component('dashboard.layouts.partials.card')
                    @slot('cardTitle')
                        Статус
                    @endslot

                    @include('dashboard.layouts.partials.forms.select-simple', [
                        'id' => 'status',
                        'title' => 'Статус',
                        'name' => 'status',
                        'required' => true,
                        'options' => trans('models/request.status'),
                        'selected' => old('status', isset($request) ? $request->status : 0)
                    ])
                    @include('dashboard.layouts.partials.forms.number', [
                        'id' => 'total_price',
                        'title' => 'Итоговая цена закрытия сделки',
                        'name'  => 'total_price',
                        'required' => false,
                        'value' => old('total_price', isset($request) ? $request->total_price : ''),
                        'placeholder' => 'Введите цену',
                        'min'  => 0,
                        'step' => 1
                    ])
                    <input type="submit" class="btn btn-sm btn-success inline m-t-8" value="Применить" />
                @endcomponent
            @endcomponent
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#total_price').parent().hide();

                var status = $('#status').val();

                if (status == '3') {
                    $('#total_price').parent().show();
                } else {
                    $('#total_price').parent().hide();
                }

                $('#status').on('change', function () {
                    if ($(this).val() == '3') {
                        $('#total_price').parent().show();
                    } else {
                        $('#total_price').parent().hide();
                    }
                })

                $('.requestMessagePrice').click(function () {
                    var messageId = $(this).data('message-id');
                    $('#modal_message_id').val(messageId);
                });
            });
        </script>
    @endpush

    <style>
        .chat-view {
            position: relative;
        }
        #updateMessagesButton {
            position: absolute;
            top: 15px;
            right: 15px;

            font-size: 18px;
            color: #3395ed;
            border: 0;
            background-color: #fff;
            cursor: pointer;
            z-index: 50;
            outline: none;
        }
        .priceError {
            color: red;
            font-weight: bolder;
        }
        .priceAlert {
            color: green;
            font-weight: bolder;
        }
    </style>

    <div class="modal fade slide-up disable-scroll show" id="modalRequestPrice" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-header clearfix text-left">
                        <h5 class="semi-bold m-t-0">Указать корректную цену</h5>
                        <p class="p-b-10" id="modalSimilarInfo">Введите предлагаемую цену для сообщения от клиента</p>
                    </div>
                    <div class="modal-body">
                        @component('dashboard.layouts.partials.form', ['action' => route('dashboard.requests.messages.price.set', $request->id)])
                            @include('dashboard.layouts.partials.forms.number', [
                                'title' => 'Предлагаемая цена',
                                'name'  => 'offered_price',
                                'required' => true,
                                'value' => '',
                                'placeholder' => 'Введите цену',
                            ])

                            <input type="submit" class="btn btn-sm btn-success inline m-t-8" value="Изменить" />

                            <input type="hidden" id="modal_message_id" name="message_id" value="">
                        @endcomponent
                    </div>
                </div>
            </div>

        </div>
    </div>


@stop
