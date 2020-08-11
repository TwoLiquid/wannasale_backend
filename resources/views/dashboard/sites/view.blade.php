@extends('dashboard.layouts.default')

@php
    /** @var \App\Models\Site $site */
    /** @var \App\Models\Item[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator $items */
@endphp

@section('title', $site->name)

@section('content')
    <div class="row">
        <div class="col-md-6">
            @component('dashboard.layouts.partials.card')
                @slot('cardTitle')
                    Основные данные
                @endslot

                @component('dashboard.layouts.partials.form', ['action' => route('dashboard.sites.update', $site->id)])

                    @include('dashboard.sites.fields')

                    <input type="submit" class="btn btn-sm btn-success inline m-t-8" value="Применить" />
                    <a href="#" data-link="{{ route('dashboard.sites.delete', $site->id) }}" class="btn btn-danger btn-xs inline m-t-15 pull-right" data-toggle="modal" data-target="#modalConfirm">Удалить сайт</a>

                @endcomponent
            @endcomponent
        </div>
        @if($site->widget !== null)
            <div class="col-md-6">
                @component('dashboard.layouts.partials.card')
                    @slot('cardTitle')
                        Подключение виджета
                    @endslot

                    @include('dashboard.layouts.partials.forms.text', [
                        'id' => 'clipboardWidgetTextarea',
                        'title' => 'Код виджета',
                        'name' => 'name',
                        'required' => false,
                        'value' => view('widget.template', ['widget' => $site->widget]),
                        'placeholder' => 'Отображается в панели'
                    ])

                    <p id="clipboardWidgetCopyAlert">Код скрипта виджета скопирован в буфер обмена</p>

                    <input id="clipboardWidgetCopyButton" type="button" class="btn btn-sm btn-success inline m-t-8" value="Скопировать" />

                    @include('dashboard.layouts.partials.forms.text', [
                        'id' => 'clipboardButtonTextarea',
                        'title' => 'Код кнопки (действительно только "по месту расположения блока")',
                        'name' => 'name',
                        'required' => false,
                        'value' => view('widget.button', ['widget' => $site->widget]),
                        'placeholder' => 'Отображается в панели'
                    ])

                    <p id="clipboardButtonCopyAlert">Код кнопки скопирован в буфер обмена</p>

                    <input id="clipboardButtonCopyButton" type="button" class="btn btn-sm btn-success inline m-t-8" value="Скопировать" />
                @endcomponent
            </div>
            <div class="col-md-6">
                @component('dashboard.layouts.partials.form', ['action' => route('dashboard.widgets.position', $site->id)])
                    @component('dashboard.layouts.partials.card')
                        @slot('cardTitle')
                            Расположение виджета
                        @endslot

                        @include('dashboard.layouts.partials.forms.select-simple', [
                            'title' => 'Положение',
                            'name' => 'display_settings[position]',
                            'required' => true,
                            'options' => config('widget.position'),
                            'selected' => old('status', isset($site->widget) ? $site->widget->display_settings->getPosition() : 0)
                        ])
                        @include('dashboard.layouts.partials.forms.number', [
                            'title' => 'Отступ снизу',
                            'id' => 'bottom',
                            'name' => 'display_settings[bottom]',
                            'required' => true,
                            'value' => old('bottom', isset($site->widget) ? $site->widget->display_settings->getBottom() : 0),
                            'placeholder' => 'Введите оступ снизу (пиксели)'
                        ])
                        @include('dashboard.layouts.partials.forms.number', [
                            'title' => 'Отступ сбоку',
                            'id' => 'side',
                            'name' => 'display_settings[side]',
                            'required' => true,
                            'value' => old('side', isset($site->widget) ? $site->widget->display_settings->getSide() : 0),
                            'placeholder' => 'Введите отступ сбоку (пиксели)'
                        ])
                        <input type="submit" class="btn btn-sm btn-success inline m-t-8" value="Применить" />
                    @endcomponent
                @endcomponent
            </div>
            <div class="col-md-6">
                @component('dashboard.layouts.partials.form', ['action' => route('dashboard.widgets.settings', $site->id)])
                    @component('dashboard.layouts.partials.card')
                        @slot('cardTitle')
                            Настройки виджета
                        @endslot

                        @include('dashboard.layouts.partials.forms.checkbox', [
                            'title'   => 'Активирован',
                            'name'    => 'enabled',
                            'checked' => $site->widget->enabled,
                            'color'   => 'complete',
                            'id'      => 'enabled'
                        ])
                        @include('dashboard.layouts.partials.forms.checkbox', [
                            'title'   => 'Показывать только на странице товара',
                            'name'    => 'on_item_page_only',
                            'checked' => $site->widget->on_item_page_only,
                            'color'   => 'complete',
                            'id'      => 'on_item_page_only'
                        ])
                        @include('dashboard.layouts.partials.forms.checkbox', [
                            'title'   => 'Отображать поле заполнения номера телефона',
                            'name'    => 'display_settings[show_phone]',
                            'checked' => $site->widget->display_settings->getShowPhone(),
                            'color'   => 'complete',
                            'id'      => 'display_settings[show_phone]'
                        ])
                        <input type="submit" class="btn btn-sm btn-success inline m-t-8" value="Применить" />
                    @endcomponent
                @endcomponent
            </div>
            <div class="col-md-6">
                @component('dashboard.layouts.partials.form', ['action' => route('dashboard.widgets.button.settings', $site->id)])
                    @component('dashboard.layouts.partials.card')
                        @slot('cardTitle')
                            Настройки кнопки виджета
                        @endslot

                        @include('dashboard.layouts.partials.forms.text', [
                            'title' => 'Текст кнопки',
                            'id' => 'button_text',
                            'name' => 'display_settings[button_text]',
                            'required' => true,
                            'value' => old('color', isset($site->widget) ? $site->widget->display_settings->getButtonText() : ''),
                            'placeholder' => 'Введите текст кнопки'
                        ])
                        @include('dashboard.layouts.partials.forms.color', [
                            'title' => 'Цвет кнопки',
                            'id' => 'button_color',
                            'name' => 'display_settings[button_color]',
                            'required' => true,
                            'value' => old('color', isset($site->widget) ? $site->widget->display_settings->getButtonColor() : ''),
                            'placeholder' => 'Выберите цвет кнопки'
                        ])
                        @include('dashboard.layouts.partials.forms.color', [
                            'title' => 'Цвет текста кнопки',
                            'id' => 'button_text_color',
                            'name' => 'display_settings[button_text_color]',
                            'required' => true,
                            'value' => old('color', isset($site->widget) ? $site->widget->display_settings->getButtonTextColor() : ''),
                            'placeholder' => 'Выберите цвет текста кнопки'
                        ])
                        <hr>
                        @include('dashboard.layouts.partials.forms.number', [
                            'title' => 'Ширина кнопки',
                            'id' => 'button_width',
                            'name' => 'display_settings[button_width]',
                            'required' => true,
                            'value' => old('button_width', isset($site->widget) ? $site->widget->display_settings->getButtonWidth() : 0),
                            'placeholder' => 'Введите ширину кнопки (пиксели)'
                        ])
                        @include('dashboard.layouts.partials.forms.number', [
                            'title' => 'Высота кнопки',
                            'id' => 'button_height',
                            'name' => 'display_settings[button_height]',
                            'required' => true,
                            'value' => old('button_height', isset($site->widget) ? $site->widget->display_settings->getButtonHeight() : 0),
                            'placeholder' => 'Введите высоту кнопки (пиксели)'
                        ])
                        @include('dashboard.layouts.partials.forms.number', [
                            'title' => 'Размер шрифта',
                            'id' => 'button_font_size',
                            'name' => 'display_settings[button_font_size]',
                            'required' => true,
                            'value' => old('button_font_size', isset($site->widget) ? $site->widget->display_settings->getButtonFontSize() : 0),
                            'placeholder' => 'Введите размер шрифта кнопки (пиксели)'
                        ])
                        @include('dashboard.layouts.partials.forms.checkbox', [
                            'title'   => 'Ширина в процентах',
                            'name'    => 'display_settings[button_width_percent]',
                            'checked' => old('button_width_percent', isset($site->widget) ? $site->widget->display_settings->getButtonWidthPercent() : 0),
                            'color'   => 'complete',
                            'id'      => 'button_width_percent'
                        ])
                        <input type="submit" class="btn btn-sm btn-success inline m-t-8" value="Применить" />
                    @endcomponent
                @endcomponent
            </div>
            <div class="col-md-6">
                @component('dashboard.layouts.partials.card')
                    @slot('cardTitle')
                        Отображение кнопки виджета
                    @endslot

                    <div class="padding-10">
                        <button id="previewButton"></button>
                    </div>

                @endcomponent
            </div>
            <div class="col-md-6">
                @component('dashboard.layouts.partials.form', ['action' => route('dashboard.widgets.window.settings', $site->id)])
                    @component('dashboard.layouts.partials.card')
                        @slot('cardTitle')
                            Окно виджета
                        @endslot

                        @include('dashboard.layouts.partials.forms.text', [
                            'title' => 'Текст заголовка',
                            'id' => 'title_text',
                            'name' => 'display_settings[title_text]',
                            'required' => true,
                            'value' => old('title_text', isset($site->widget) ? $site->widget->display_settings->getTitleText() : ''),
                            'placeholder' => 'Введите текст заголовка'
                        ])
                        @include('dashboard.layouts.partials.forms.color', [
                            'title' => 'Цвет заголовка',
                            'id' => 'title_color',
                            'name' => 'display_settings[title_color]',
                            'required' => true,
                            'value' => old('title_color', isset($site->widget) ? $site->widget->display_settings->getTitleColor() : ''),
                            'placeholder' => 'Выберите цвет заголовка'
                        ])
                        @include('dashboard.layouts.partials.forms.text', [
                            'title' => 'Текст',
                            'id' => 'text',
                            'name' => 'display_settings[text]',
                            'required' => false,
                            'value' => old('text', isset($site->widget) ? $site->widget->display_settings->getText() : ''),
                            'placeholder' => 'Введите текст'
                        ])
                        <hr>
                        @include('dashboard.layouts.partials.forms.text', [
                            'title' => 'Текст чекбокса',
                            'id' => 'checkbox_text',
                            'name' => 'display_settings[checkbox_text]',
                            'required' => false,
                            'value' => old('checkbox_text', isset($site->widget) ? $site->widget->display_settings->getCheckboxText() : ''),
                            'placeholder' => 'Введите текст'
                        ])
                        @include('dashboard.layouts.partials.forms.color', [
                            'title' => 'Цвет текста чекбокса',
                            'id' => 'checkbox_text_color',
                            'name' => 'display_settings[checkbox_text_color]',
                            'required' => true,
                            'value' => old('checkbox_text_color', isset($site->widget) ? $site->widget->display_settings->getCheckboxTextColor() : ''),
                            'placeholder' => 'Выберите цвет кнопки'
                        ])
                        <hr>
                        @include('dashboard.layouts.partials.forms.text', [
                            'title' => 'Текст кнопки',
                            'id' => 'window_button_text',
                            'name' => 'display_settings[window_button_text]',
                            'required' => false,
                            'value' => old('window_button_text', isset($site->widget) ? $site->widget->display_settings->getWindowButtonText() : ''),
                            'placeholder' => 'Введите текст кнопки'
                        ])
                        @include('dashboard.layouts.partials.forms.color', [
                            'title' => 'Цвет кнопки',
                            'id' => 'window_button_color',
                            'name' => 'display_settings[window_button_color]',
                            'required' => true,
                            'value' => old('title_color', isset($site->widget) ? $site->widget->display_settings->getWindowButtonColor() : ''),
                            'placeholder' => 'Выберите цвет кнопки'
                        ])
                        @include('dashboard.layouts.partials.forms.color', [
                            'title' => 'Цвет текста кнопки',
                            'id' => 'window_button_text_color',
                            'name' => 'display_settings[window_button_text_color]',
                            'required' => true,
                            'value' => old('title_color', isset($site->widget) ? $site->widget->display_settings->getWindowButtonTextColor() : ''),
                            'placeholder' => 'Выберите цвет кнопки'
                        ])
                        <hr>
                        @include('dashboard.layouts.partials.forms.color', [
                            'title' => 'Цвет фона',
                            'id' => 'background_color',
                            'name' => 'display_settings[background_color]',
                            'required' => true,
                            'value' => old('color', isset($site->widget) ? $site->widget->display_settings->getBackgroundColor() : ''),
                            'placeholder' => 'Выберите цвет виджета'
                        ])
                        <input type="submit" class="btn btn-sm btn-success inline m-t-8" value="Применить" />
                    @endcomponent
                @endcomponent
            </div>
            <div class="col-md-6">
                @component('dashboard.layouts.partials.card')
                    @slot('cardTitle')
                        Отображение окна виджета
                    @endslot

                    @slot('cardHeader')
                        <a href="#" class="btn btn-complete pull-right m-l-10" data-toggle="modal" data-target="#customFieldModal">
                            <i class="pg-plus"></i> Добавить поле
                        </a>
                    @endslot

                    <div id="wannaSaleForm" class="padding-10">
                        <div id="previewContainer" class="sign-up-agileinfo">
                            <h3 id="previewTitle">Заголовок</h3>
                            <p id="previewText"></p>

                            <textarea placeholder="{{ trans('messages.widget.form.item') }}"></textarea>

                            @if($site->widget->custom_fields !== null)
                                @foreach($site->widget->custom_fields as $field)

                                    @if ($field->getType() == 'word')
                                        <div class="customField">
                                            <input type="text" name="custom_field[{{ $field->getName() }}]" class="wannaSaleCustomField" placeholder="{{ $field->getPlaceholder() }}" required>
                                            <a href="#" data-name="{{ $field->getName() }}"><i class="fa fa-trash"></i></a>
                                        </div>
                                    @elseif($field->getType() == 'integer')
                                        <div class="customField">
                                            <input type="number" name="custom_field[{{ $field->getName() }}]" class="wannaSaleCustomField" placeholder="{{ $field->getPlaceholder() }}" required>
                                            <a href="#" data-name="{{ $field->getName() }}"><i class="fa fa-trash"></i></a>
                                        </div>
                                    @elseif($field->getType() == 'text')
                                        <div class="customField">
                                            <textarea class="wannaSaleCustomField" name="custom_field[{{ $field->getName() }}]" placeholder="{{ $field->getPlaceholder() }}"></textarea>
                                            <a href="#" data-name="{{ $field->getName() }}"><i class="fa fa-trash"></i></a>
                                        </div>
                                    @elseif($field->getType() == 'select')
                                        <div class="customField">
                                            <select class="wannaSaleCustomField" name="custom_field[{{ $field->getName() }}]">
                                            @foreach($field->getOptions() as $k => $option)
                                                <option value="{{ $k }}">{{ $option }}</option>
                                            @endforeach
                                            </select>
                                            <a href="#" data-name="{{ $field->getName() }}"><i class="fa fa-trash"></i></a>
                                        </div>
                                    @endif
                                @endforeach
                            @endif

                            <input type="text" id="wannaSaleName" placeholder="{{ trans('messages.widget.form.name') }}" required>
                            <input type="email" id="wannaSaleEmail" placeholder="{{ trans('messages.widget.form.email') }}" readonly onfocus="this.removeAttribute('readonly');" required>
                            <input type="tel" placeholder="{{ trans('messages.widget.form.phone') }}" required>
                            <input type="number" id="wannaSalePrice" placeholder="{{ trans('messages.widget.form.price') }}" required>
                            <div class="checkbox_area">
                                <label for="wannaCheck" id="wannaCheckLabel">Я согласен на обработку персональных данных </label>
                                <input type="checkbox" id="wannaCheck" style="">
                                <div style="clear: both;"></div>
                            </div>

                            <button id="wannaSaleSubmit" type="button">{{ trans('messages.widget.form.button') }}</button>
                        </div>
                    </div>

                    @include('widget.preview.styles')

                @endcomponent
            </div>

            <div class="col-md-6">
                @component('dashboard.layouts.partials.form', ['action' => route('dashboard.widgets.window.message', $site->id)])
                    @component('dashboard.layouts.partials.card')
                        @slot('cardTitle')
                            Настройки сообщения
                        @endslot

                        @include('dashboard.layouts.partials.forms.text', [
                            'title' => 'Текст сообщения',
                            'id' => 'message_text',
                            'name' => 'display_settings[message_text]',
                            'required' => true,
                            'value' => old('color', isset($site->widget) ? $site->widget->display_settings->getMessageText() : ''),
                            'placeholder' => 'Введите текст сообщения'
                        ])
                        @include('dashboard.layouts.partials.forms.color', [
                            'title' => 'Цвет текста сообщения',
                            'id' => 'message_text_color',
                            'name' => 'display_settings[message_text_color]',
                            'required' => true,
                            'value' => old('color', isset($site->widget) ? $site->widget->display_settings->getMessageTextColor() : ''),
                            'placeholder' => 'Выберите цвет текста сообщения'
                        ])
                        @include('dashboard.layouts.partials.forms.color', [
                            'title' => 'Цвет фона сообщения',
                            'id' => 'message_background_color',
                            'name' => 'display_settings[message_background_color]',
                            'required' => true,
                            'value' => old('color', isset($site->widget) ? $site->widget->display_settings->getMessageBackgroundColor() : ''),
                            'placeholder' => 'Выберите цвет фона сообщения'
                        ])
                        <input type="submit" class="btn btn-sm btn-success inline m-t-8" value="Применить" />
                    @endcomponent
                @endcomponent
            </div>
            <div class="col-md-6">
                @component('dashboard.layouts.partials.card')
                    @slot('cardTitle')
                        Отображение сообщения
                    @endslot

                    <div class="padding-10">
                        <p id="previewMessage"> {{ $site->widget->display_settings->getCheckboxText() }} </p>
                    </div>

                    <style>
                        #previewMessage {
                            padding: 50px;
                            width: fit-content;
                        }
                        #clipboardWidgetCopyAlert {
                            display: none;
                            float: right;
                            margin: 15px 0px 0px 0px;
                        }
                        #clipboardButtonCopyAlert {
                            display: none;
                            float: right;
                            margin: 15px 0px 0px 0px;
                        }
                    </style>

                @endcomponent
            </div>
        @endif
    </div>
    @component('dashboard.layouts.partials.card')
        @slot('cardTitle')
            Товары
        @endslot

        @slot('cardHeader')
            @include('dashboard.layouts.partials.create-new-button', [
                'name' => 'Ипортировать Excel',
                'icon' => 'pg-download',
                'link' => route('dashboard.sites.items.excel', ['uuid' => $site->id])
            ])

            @include('dashboard.layouts.partials.create-new-button', [
                'link' => route('dashboard.items.create', ['uuid' => $site->id])
            ])
        @endslot

        @if(count($items) > 0)
            <table class="table table-condensed no-footer" role="grid">
                <thead>
                <tr>
                    <th style="width: 20%;" rowspan="1" colspan="1">Название</th>
                    <th style="width: 20%;" rowspan="1" colspan="1">Артикул</th>
                    <th style="width: 10%;" rowspan="1" colspan="1">Исходная цена</th>
                    <th style="width: 30%;" class="text-right" rowspan="1" colspan="1">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr role="row">
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->initial_price }}</td>
                        <td>
                            @include('dashboard.layouts.partials.button-list-delete-big', [
                                'link' => route('dashboard.items.delete', $item->id)
                            ])
                            @include('dashboard.layouts.partials.button-list-edit-big', [
                                'link' => route('dashboard.items.edit', $item->id)
                            ])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $items->links() !!}
        @else
            <span class="hint-text m-l-5">Пока нет товаров</span>
        @endif

    @endcomponent

    <div class="row">
        <div class="col-md-12">
            @component('dashboard.layouts.partials.card')
                @slot('cardTitle')
                    Воронка продаж
                @endslot

                <div class="row">
                    <div class="col-md-6">
                        <div id="funnelSuccessfulContainer" style="height: 350px; width: 100%;"></div>
                    </div>

                    <div class="col-md-6">
                        <div id="funnelUnsuccessfulContainer" style="height: 350px; width: 100%;"></div>
                    </div>
                </div>

            @endcomponent
        </div>
    </div>

    <div class="modal fade slide-up disable-scroll show" id="customFieldModal" tabindex="-1" role="dialog" data-current-client-id="" data-current-client-name="" data-current-client-phone="">
        <div class="modal-dialog">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-header clearfix text-left">
                        <h5 class="semi-bold m-t-0">Добавить поле</h5>
                        <p class="p-b-10">Виберите тип данных для нового поля</p>
                    </div>
                    <div class="modal-body">


                        <div class="card card-transparent ">
                            <ul class="nav nav-tabs nav-tabs-fillup hidden-sm-down" data-init-reponsive-tabs="dropdownfx">
                                <li class="nav-item">
                                    <a href="#" class="active" data-toggle="tab" data-target="#slide1" aria-expanded="false"><span>Слово</span></a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" data-toggle="tab" data-target="#slide2" class="" aria-expanded="true"><span>Число</span></a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" data-toggle="tab" data-target="#slide3" class="" aria-expanded="false"><span>Текст</span></a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" data-toggle="tab" data-target="#slide4" class="" aria-expanded="false"><span>Список</span></a>
                                </li>
                            </ul><div class="nav-tab-dropdown cs-wrapper full-width hidden-md-up"><div class="cs-select cs-skin-slide full-width" tabindex="0"><span class="cs-placeholder">Hello World</span><div class="cs-options"><ul><li data-option="" data-value="#slide1"><span>Home</span></li><li data-option="" data-value="#slide2"><span>Profile</span></li><li data-option="" data-value="#slide3"><span>Messages</span></li></ul></div><select class="cs-select cs-skin-slide full-width" data-init-plugin="cs-select"><option value="#slide1" selected="">Home</option><option value="#slide2">Profile</option><option value="#slide3">Messages</option></select><div class="cs-backdrop"></div></div></div>

                            <div class="tab-content">
                                <div class="tab-pane slide-left active" id="slide1" aria-expanded="false">

                                    <p>Текстовое поле - может содержать в себе слово и строку.</p>
                                    @component('dashboard.layouts.partials.form', ['action' => route('dashboard.widgets.fields.create', $site->id)])
                                        <div class="row">
                                            <div class="col-md-6">
                                                @include('dashboard.layouts.partials.forms.text', [
                                                    'title' => 'Название поля',
                                                    'name' => 'title',
                                                    'required' => true,
                                                    'value' => '',
                                                    'placeholder' => 'Введите название'
                                                ])
                                            </div>
                                            <div class="col-md-6">
                                                @include('dashboard.layouts.partials.forms.text', [
                                                    'title' => 'ID поля',
                                                    'name' => 'name',
                                                    'required' => true,
                                                    'value' => '',
                                                    'placeholder' => 'Введите ID поля'
                                                ])
                                            </div>
                                        </div>

                                        @include('dashboard.layouts.partials.forms.text', [
                                            'title' => 'Подсказка',
                                            'name' => 'placeholder',
                                            'required' => false,
                                            'value' => '',
                                            'placeholder' => 'Введите подсказку для поля ввода'
                                        ])

                                        <input type="hidden" name="type" value="word">
                                        <button type="submit" class="btn btn-success btn-cons">Добавить</button>
                                    @endcomponent
                                </div>
                                <div class="tab-pane slide-left" id="slide2" aria-expanded="true">

                                    <p>Числовое поле может содержать в себе только числовое значения, нельзя вводить строчные символы</p>
                                    @component('dashboard.layouts.partials.form', ['action' => route('dashboard.widgets.fields.create', $site->id)])
                                        <div class="row">
                                            <div class="col-md-6">
                                                @include('dashboard.layouts.partials.forms.text', [
                                                    'title' => 'Название поля',
                                                    'name' => 'title',
                                                    'required' => true,
                                                    'value' => '',
                                                    'placeholder' => 'Введите название'
                                                ])
                                            </div>
                                            <div class="col-md-6">
                                                @include('dashboard.layouts.partials.forms.text', [
                                                    'title' => 'ID поля',
                                                    'name' => 'name',
                                                    'required' => true,
                                                    'value' => '',
                                                    'placeholder' => 'Введите ID поля'
                                                ])
                                            </div>
                                        </div>

                                        @include('dashboard.layouts.partials.forms.text', [
                                            'title' => 'Подсказка',
                                            'name' => 'placeholder',
                                            'required' => false,
                                            'value' => '',
                                            'placeholder' => 'Введите подсказку для поля ввода'
                                        ])

                                        <input type="hidden" name="type" value="integer">
                                        <button type="submit" class="btn btn-success btn-cons">Добавить</button>
                                    @endcomponent
                                </div>
                                <div class="tab-pane slide-left" id="slide3" aria-expanded="false">

                                    <p>Текстовое поле - для объемов текста больших, чем одна строка</p>
                                    @component('dashboard.layouts.partials.form', ['action' => route('dashboard.widgets.fields.create', $site->id)])
                                        <div class="row">
                                            <div class="col-md-6">
                                                @include('dashboard.layouts.partials.forms.text', [
                                                    'title' => 'Название поля',
                                                    'name' => 'title',
                                                    'required' => true,
                                                    'value' => '',
                                                    'placeholder' => 'Введите название'
                                                ])
                                            </div>
                                            <div class="col-md-6">
                                                @include('dashboard.layouts.partials.forms.text', [
                                                    'title' => 'ID поля',
                                                    'name' => 'name',
                                                    'required' => true,
                                                    'value' => '',
                                                    'placeholder' => 'Введите ID поля'
                                                ])
                                            </div>
                                        </div>

                                        @include('dashboard.layouts.partials.forms.text', [
                                            'title' => 'Подсказка',
                                            'name' => 'placeholder',
                                            'required' => false,
                                            'value' => '',
                                            'placeholder' => 'Введите подсказку для поля ввода'
                                        ])

                                        <input type="hidden" name="type" value="text">
                                        <button type="submit" class="btn btn-success btn-cons">Добавить</button>
                                    @endcomponent
                                </div>
                                <div class="tab-pane slide-left" id="slide4" aria-expanded="false">
                                    <p>Выпадающий список - клиенту позволяется выбрать из предложенных вариантов ответа</p>
                                    @component('dashboard.layouts.partials.form', ['action' => route('dashboard.widgets.fields.create', $site->id)])
                                        <div class="row">
                                            <div class="col-md-6">
                                                @include('dashboard.layouts.partials.forms.text', [
                                                    'title' => 'Название поля',
                                                    'name' => 'title',
                                                    'required' => true,
                                                    'value' => '',
                                                    'placeholder' => 'Введите название'
                                                ])
                                            </div>
                                            <div class="col-md-6">
                                                @include('dashboard.layouts.partials.forms.text', [
                                                    'title' => 'ID поля',
                                                    'name' => 'name',
                                                    'required' => true,
                                                    'value' => '',
                                                    'placeholder' => 'Введите ID поля'
                                                ])
                                            </div>
                                        </div>

                                        <div id="customFieldSelect">
                                            @include('dashboard.layouts.partials.forms.text', [
                                                'title' => 'Элемент списка',
                                                'name' => 'options[]',
                                                'required' => true,
                                                'value' => '',
                                                'placeholder' => 'Введите название элемента'
                                            ])
                                        </div>

                                        <input type="hidden" name="type" value="select">
                                        <button type="submit" class="btn btn-success btn-cons">Добавить</button>
                                        <button type="button" class="btn btn-default btn-cons" id="customFieldSelectAdd">+ Элемент списка</button>
                                    @endcomponent
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#customFieldSelectAdd').click(function () {
                    var html = '<div class="form-group form-group-default required"><label>Элемент списка</label><input name="options[]" value="" type="text" class="form-control" placeholder="Введите название элемента" required="" maxlength=""></div>';
                    $('#customFieldSelect').append(html);
                });
            })
        </script>
    @endpush

    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("funnelSuccessfulContainer", {
                animationEnabled: true,
                theme: "light2", //"light1", "dark1", "dark2"
                title:{
                    text: "Успешные продажи"
                },
                data: [{
                    type: "funnel",
                    indexLabelPlacement: "inside",
                    indexLabelFontColor: "white",
                    toolTipContent: "<b>{label}</b>: {y} <b>({percentage}%)</b>",
                    indexLabel: "{label} ({percentage}%)",
                    dataPoints: [
                        { y: parseInt('{{ $widgetFunnel->getSeen() }}'), label: "Просмотр виджета" },
                        { y: parseInt('{{ $widgetFunnel->getOpened() }}'), label: "Открытие виджета" },
                        { y: parseInt('{{ $widgetFunnel->getMadeRequest() }}'), label: "Совершено запросов" },
                        { y: parseInt('{{ $widgetFunnel->getSuccessfullyClosedRequest() }}'), label: "Успешно" }
                    ]
                }]
            });

            calculatePercentage();
            chart.render();

            function calculatePercentage() {
                var dataPoint = chart.options.data[0].dataPoints;
                var total = dataPoint[0].y;
                for(var i = 0; i < dataPoint.length; i++) {
                    if(i == 0) {
                        chart.options.data[0].dataPoints[i].percentage = 100;
                    } else {
                        chart.options.data[0].dataPoints[i].percentage = ((dataPoint[i].y / total) * 100).toFixed(2);
                    }
                }
            }

            var chart = new CanvasJS.Chart("funnelUnsuccessfulContainer", {
                animationEnabled: true,
                theme: "light2", //"light1", "dark1", "dark2"
                title:{
                    text: "Неуспешные продажи"
                },
                data: [{
                    type: "funnel",
                    indexLabelPlacement: "inside",
                    indexLabelFontColor: "white",
                    toolTipContent: "<b>{label}</b>: {y} <b>({percentage}%)</b>",
                    indexLabel: "{label} ({percentage}%)",
                    dataPoints: [
                        { y: parseInt('{{ $widgetFunnel->getSeen() }}'), label: "Просмотр виджета" },
                        { y: parseInt('{{ $widgetFunnel->getOpened() }}'), label: "Открытие виджета" },
                        { y: parseInt('{{ $widgetFunnel->getMadeRequest() }}'), label: "Совершено запросов" },
                        { y: parseInt('{{ $widgetFunnel->getUnsuccessfullyClosedRequest() }}'), label: "Неуспешно" }
                    ]
                }]
            });

            calculatePercentage();
            chart.render();

            function calculatePercentage() {
                var dataPoint = chart.options.data[0].dataPoints;
                var total = dataPoint[0].y;
                for(var i = 0; i < dataPoint.length; i++) {
                    if(i == 0) {
                        chart.options.data[0].dataPoints[i].percentage = 100;
                    } else {
                        chart.options.data[0].dataPoints[i].percentage = ((dataPoint[i].y / total) * 100).toFixed(2);
                    }
                }
            }

            $('.canvasjs-chart-credit').each(function () {
                $(this).remove();
            });

            $('.customField a').each(function () {
                $(this).click(function () {
                    var name = $(this).data('name');

                    $.post(
                        '{{ route('dashboard.widgets.fields.delete', $site->id) }}',
                        {
                            name: name
                        },
                        function () {
                            window.location = '{{ route('dashboard.sites.view', $site->id) }}';
                        }
                    );

                    return false;
                });
            });
        }
    </script>

    <style>
        #clipboardWidgetCopyButton {
            margin-bottom: 20px;
        }
        .customField {
            position: relative;
        }
        .customField a {
            position: absolute;
            top: 10px;
            right: 15px;
        }
    </style>
@stop