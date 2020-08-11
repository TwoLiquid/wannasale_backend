@php /** @var \App\Models\Request $request */ @endphp
<div class="row">

    <div class="col-md-7">
        @component('dashboard.layouts.partials.card')
            @slot('cardTitle')
                Основные данные
            @endslot

            <input type="hidden" name="widget_id" id="widget_id" value="">

            @include('dashboard.layouts.partials.forms.select-simple', [
                'id' => 'site',
                'title' => 'Сайт',
                'name' => 'site_id',
                'required' => true,
                'options' => $sites->pluck('name', 'id')->toArray(),
                'selected' => ''
            ])
            @include('dashboard.layouts.partials.forms.select-simple', [
                'id' => 'items',
                'title' => 'Товар',
                'name' => 'item_id',
                'required' => true,
                'options' => [],
                'selected' => ''
            ])
            @include('dashboard.layouts.partials.forms.select-simple', [
                'id' => 'clients',
                'title' => 'Клиент',
                'name' => 'client_id',
                'required' => true,
                'options' => [],
                'selected' => ''
            ])
            @include('dashboard.layouts.partials.forms.text', [
                'title' => 'Название товара',
                'name' => 'name',
                'required' => true,
                'value' => old('name', isset($item) ? $item->name : ''),
                'placeholder' => 'Введите название товара'
            ])
            @include('dashboard.layouts.partials.forms.text', [
                'title' => 'Название товара (свободное поле ввода)',
                'name' => 'item_name',
                'required' => false,
                'value' => old('name', isset($item) ? $item->item_name : ''),
                'placeholder' => 'Введите свободное название товара'
            ])
            @include('dashboard.layouts.partials.forms.email', [
                'title' => 'E-mail',
                'name' => 'email',
                'required' => true,
                'value' => old('name', isset($item) ? $item->email : ''),
                'placeholder' => 'Введите email'
            ])
            @include('dashboard.layouts.partials.forms.text', [
                'title' => 'Телефон',
                'name' => 'phone',
                'required' => true,
                'value' => old('name', isset($item) ? $item->phone : ''),
                'placeholder' => 'Введите номер телефона'
            ])
            @include('dashboard.layouts.partials.forms.text', [
                'title' => 'Страна',
                'name' => 'country',
                'required' => false,
                'value' => old('name', isset($item) ? $item->country : ''),
                'placeholder' => 'Введите страну'
            ])
            @include('dashboard.layouts.partials.forms.text', [
                'title' => 'Город',
                'name' => 'city',
                'required' => false,
                'value' => old('name', isset($item) ? $item->city : ''),
                'placeholder' => 'Введите город'
            ])
            @include('dashboard.layouts.partials.forms.text', [
                'title' => 'Предлагаемая цена',
                'name' => 'offered_price',
                'required' => true,
                'value' => old('name', isset($item) ? $item->offered_price : ''),
                'placeholder' => 'Введите предлагаемую цену'
            ])
        @endcomponent
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {

            setDataForSite($('#site').val());

            $('#site').change(function () {
                setDataForSite($(this).val());
            });
        });

        function setDataForSite(siteId)
        {
            $.post(
                "{{ route('dashboard.requests.site.data.get') }}",
                {
                    site_id: siteId
                },
                function (data) {

                    $('#clients').html('');
                    var clientsOptions = '';
                    for (key in data['clients']) {
                        $('#clients').append($("<option></option>").attr("value", key).text(data['clients'][key]));
                    }

                    $('#items').html('');
                    var itemsOptions = '';
                    for (key in data['items']) {
                        $('#items').append($("<option></option>").attr("value", key).text(data['items'][key]));
                    }

                    $('#widget_id').val(data['widget']);
                }
            );
        }
    </script>
@endpush
