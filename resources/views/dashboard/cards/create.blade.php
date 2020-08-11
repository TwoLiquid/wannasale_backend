@extends('dashboard.layouts.default')

@section('title', 'Привязка карты')

@section('content')

    <div class="row">
        <div class="col-md-5">
            @component('dashboard.layouts.partials.card')

                @slot('cardTitle')
                    Данные карты
                @endslot

                @component('dashboard.layouts.partials.form', ['action' => '', 'id' => 'paymentForm'])
                    @include('dashboard.layouts.partials.forms.text-cloudpayments', [
                        'title' => 'Номер карты',
                        'id' => 'cardNumber',
                        'cp' => 'cardNumber',
                        'required' => true,
                        'value' => old('cardNumber', isset($item) ? $item->cvc : ''),
                        'placeholder' => 'Номер карты'
                    ])
                    <span class="error-msg" data-bind="css: { 'msg-show': messages.cardNumber }, text: messages.cardNumber"></span>

                    @include('dashboard.layouts.partials.forms.text-cloudpayments', [
                        'title' => 'Имя держателя карты',
                        'id' => 'cardHolderName',
                        'cp' => 'name',
                        'required' => true,
                        'value' => old('cardHolderName', isset($item) ? $item->cvc : ''),
                        'placeholder' => 'Введите имя держателя карты'
                    ])
                    <span class="error-msg" data-bind="css: { 'msg-show': messages.name }, text: messages.name"></span>

                    @include('dashboard.layouts.partials.forms.text-cloudpayments', [
                        'title' => 'Дата окончания действия карты',
                        'id' => 'cardExpDateMonthYear',
                        'cp' => 'expDateMonthYear',
                        'required' => true,
                        'value' => old('cardExpDateMonthYear', isset($item) ? $item->cvc : ''),
                        'placeholder' => 'Введите дату'
                    ])
                    <span class="error-msg" data-bind="css: { 'msg-show': messages.expDateMonthYear }, text: messages.expDateMonthYear"></span>

                    @include('dashboard.layouts.partials.forms.text-cloudpayments', [
                        'title' => 'CVV код',
                        'id' => 'cardCvv',
                        'cp' => 'cvv',
                        'required' => true,
                        'value' => old('cardCvv', isset($item) ? $item->cvc : ''),
                        'placeholder' => 'Введите имя'
                    ])
                    <span class="error-msg" data-bind="css: { 'msg-show': messages.cvv }, text: messages.cvv"></span>
                    <p id="error-msg" style="color: red;"></p>

                    <input type="hidden" id="cardName">
                    <button type="submit" data-bind="click: createCryptogram" class="btn btn-success inline m-b-5">Привязать карту</button>
                @endcomponent

            @endcomponent
        </div>
    </div>

    <script src="https://widget.cloudpayments.ru/bundles/checkout"></script>

    @push('scripts')
        <script>
            var checkout;

            function CartViewModel() {
                var viewModel = this;

                this.messages = {
                    cardNumber: ko.observable(),
                    name: ko.observable(),
                    expDateMonthYear: ko.observable(),
                    cvv: ko.observable()
                };

                this.createCryptogram = function () {
                    var result = checkout.createCryptogramPacket();

                    var cardHolderName = $('#cardName').val();

                    if (result.success) {
                        var cryptogram = result.packet;

                        $.post(
                            '{{ route('dashboard.cards.attach') }}',
                            {
                                cryptogram: cryptogram,
                                name: cardHolderName
                            },
                            function (data) {

                                var response = data;

                                if (response['3DSecure'] === false) {
                                    if (response['success']) {
                                        window.location = '{{ route('dashboard.cards') }}';
                                    }
                                }

                                var require3DSecureForm = document.createElement('form');
                                require3DSecureForm.action = response['transactionData']['Url'];
                                require3DSecureForm.method = 'POST';

                                var transactionId = document.createElement('input');
                                transactionId.type = 'hidden';
                                transactionId.name = 'MD';
                                transactionId.value = response['transactionData']['TransactionId'];
                                require3DSecureForm.appendChild(transactionId);

                                var token = document.createElement('input');
                                token.type = 'hidden';
                                token.name = 'PaReq';
                                token.value = response['transactionData']['Token'];
                                require3DSecureForm.appendChild(token);

                                var termUrl = document.createElement('input');
                                termUrl.type = 'hidden';
                                termUrl.name = 'TermUrl';
                                termUrl.value = '{{ route('dashboard.cards.attach.confirm3DS') }}';
                                require3DSecureForm.appendChild(termUrl);

                                document.body.appendChild(require3DSecureForm);
                                require3DSecureForm.submit();
                            }
                        );

                        $('#error-msg').text('');
                    }
                    else {
                        // найдены ошибки в ведённых данных, объект `result.messages` формата:
                        // { name: "В имени держателя карты слишком много символов", cardNumber: "Неправильный номер карты" }
                        // где `name`, `cardNumber` соответствуют значениям атрибутов `<input ... data-cp="cardNumber">`
                        $('#error-msg').text(result.messages['cardNumber']);
                    }
                };
            };

            var model = new CartViewModel();
            $(function () {

                $("#cardNumber").mask("9999 9999 9999 9999 999");
                $("#cardCvv").mask("999");
                $("#cardExpDateMonthYear").mask("99/99");

                $('#cardHolderName').change(function () {
                    $('#cardName').val($(this).val());
                });

                /* Создание checkout */
                checkout = new cp.Checkout(
                    // ключ API
                    '{{ config('services.cloudpayments.public') }}',
                    // тег, содержащий теги с данными карты (<form id="paymentForm">)
                    document.getElementById("paymentForm"));

                ko.applyBindings(model, document.getElementById("mainContent")); // onready - чтобы вызов фрейма не произошёл до загрузки DOM.
            });
        </script>
    @endpush

@stop