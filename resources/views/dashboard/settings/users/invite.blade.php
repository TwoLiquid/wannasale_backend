@extends('dashboard.layouts.default')

@section('breadcrumb')
    @include('dashboard.layouts.partials.breadcrumb', ['links' => [
        'Настройки' => route('dashboard.settings')
    ]])
@stop

@section('title', 'Пригласить нового пользователя')

@section('content')

    @php /** @var \App\Models\Vendor $item */ @endphp
    <div class="row">

        <div class="col-md-7">
            @component('dashboard.layouts.partials.card')
                @slot('cardTitle')
                    Основные данные
                @endslot

                @component('dashboard.layouts.partials.form', ['action' => route('dashboard.settings.users.invite', $item->id)])
                    @include('dashboard.layouts.partials.forms.text', [
                            'title' => 'E-mail приглашаемого пользователя',
                            'name' => 'email',
                            'required' => true,
                            'value' => '',
                            'placeholder' => 'Введите E-mail пользователя'
                        ])
                    <input type="hidden" name="vendor_id" value="{{ $item->id }}">

                    <input type="submit" class="btn btn-sm btn-success inline m-t-8" value="Пригласить" />
                @endcomponent
            @endcomponent
        </div>
    </div>
@stop