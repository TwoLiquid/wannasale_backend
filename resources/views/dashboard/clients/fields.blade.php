@php /** @var \App\Models\Client $item */ @endphp
<div class="row">

    <div class="col-md-7">
        @component('dashboard.layouts.partials.card')
            @slot('cardTitle')
                Основные данные
            @endslot

            @include('dashboard.layouts.partials.forms.text', [
                'title' => 'Имя',
                'name' => 'name',
                'required' => true,
                'value' => old('name', isset($item) ? $item->name : ''),
                'placeholder' => 'Введите имя клиента'
            ])
            @include('dashboard.layouts.partials.forms.text', [
                'title' => 'E-mail',
                'name' => 'email',
                'required' => true,
                'value' => old('email', isset($item) ? $item->email : ''),
                'placeholder' => 'Введите e-mail клиента'
            ])
            @include('dashboard.layouts.partials.forms.text', [
                'title' => 'Телефон',
                'name' => 'phone',
                'required' => true,
                'value' => old('email', isset($item) ? $item->phone : ''),
                'placeholder' => 'Введите телефон клиента'
            ])
        @endcomponent
    </div>
</div>
