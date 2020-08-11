@extends('dashboard.layouts.default')

@section('title', 'Настройки компании')

@section('content')
    <div class="row">
        <div class="col-md-6">
            @component('dashboard.layouts.partials.card')
                @slot('cardTitle')
                    Данные компании
                @endslot

                @component('dashboard.layouts.partials.form', ['action' => route('dashboard.settings.info.update')])
                    @include('dashboard.layouts.partials.forms.text', [
                        'title' => 'Название компании',
                        'name' => 'name',
                        'required' => true,
                        'value' => old('name', isset($item->name) ? $item->name : ''),
                        'placeholder' => 'Введите название компании'
                    ])
                    <hr>
                    @include('dashboard.layouts.partials.forms.password', [
                        'title' => 'Старый пароль',
                        'name' => 'old_password',
                        'required' => true,
                        'value' => '',
                        'placeholder' => 'Введите старый пароль'
                    ])
                    @include('dashboard.layouts.partials.forms.password', [
                        'title' => 'Новый пароль',
                        'name' => 'password',
                        'required' => true,
                        'value' => '',
                        'placeholder' => 'Введите новый пароль'
                    ])
                    @include('dashboard.layouts.partials.forms.password', [
                        'title' => 'Повторить новый пароль',
                        'name' => 'confirm_password',
                        'required' => true,
                        'value' => '',
                        'placeholder' => 'Повторите новый пароль'
                    ])
                    <input type="submit" class="btn btn-sm btn-success inline m-t-8" value="Применить" />
                @endcomponent
            @endcomponent
        </div>

        <div class="col-md-12">
            @component('dashboard.layouts.partials.card')
                @slot('cardTitle')
                    Пользователи с доступом к управлению
                @endslot

                @slot('cardHeader')
                    @include('dashboard.layouts.partials.create-new-button', [
                        'link' => route('dashboard.settings.users.create', $item->id)
                    ])
                @endslot

                @if(count($users) > 0)
                        <table class="table table-hover table-condensed no-footer" role="grid">
                            <thead>
                            <tr>
                                <th style="width: 20%;" rowspan="1" colspan="1">Создан</th>
                                <th style="width: 25%;" rowspan="1" colspan="1">Статус</th>
                                <th style="width: 25%" rowspan="1" colspan="1">Имя</th>
                                <th style="width: 30%;" rowspan="1" colspan="1">E-mail</th>
                                <!-- <th style="width: 20%;" class="text-right" rowspan="1" colspan="1">Действия</th> -->
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td><span class="label">{{ $user->created_at->format('d-m-Y') }}</span></td>
                                    <td>
                                        @if($user->approved === true)
                                            <span class="label label-success">Подтверждён</span>
                                        @else
                                            <span class="label label-danger">Не подтверждён</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    {{--<td>
                                        @include('dashboard.layouts.partials.button-list-delete-big', [
                                            'link' => route('dashboard.settings.users.delete', $user->id)
                                        ])
                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                @else
                    <span class="hint-text m-l-5">Нет неприглашенных пользователей</span>
                @endif
            @endcomponent

            {{--@component('dashboard.layouts.partials.card')
                @slot('cardTitle')
                    Пригласить пользователей в компанию
                @endslot

                @component('dashboard.layouts.partials.form', ['action' => route('dashboard.settings.user.invite')])
                    @include('dashboard.layouts.partials.forms.text', [
                        'title' => 'E-mail приглашаемого пользователя',
                        'name' => 'email',
                        'required' => true,
                        'value' => '',
                        'placeholder' => 'Введите E-mail пользователя'
                    ])
                    <input type="submit" class="btn btn-sm btn-success inline m-t-8" value="Пригласить" />
                @endcomponent
            @endcomponent --}}
        </div>
    </div>
@stop