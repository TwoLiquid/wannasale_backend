@php /** @var \App\Models\Site $item */ @endphp

@include('dashboard.layouts.partials.forms.text', [
    'title' => 'Название',
    'name' => 'name',
    'required' => true,
    'value' => old('name', isset($site) ? $site->name : ''),
    'placeholder' => 'Введите название сайта'
])
@include('dashboard.layouts.partials.forms.text', [
    'title' => 'Домен',
    'name' => 'url',
    'required' => true,
    'value' => old('name', isset($site->urls[0]) ? $site->urls[0] : ''),
    'placeholder' => 'Введите домен сайта'
])
{{-- @include('dashboard.layouts.partials.forms.tags-input', [
    'title' => 'Домены',
    'name' => 'urls[]',
    'required' => true,
    'values' => old('urls', isset($site->urls) ? $site->urls : []),
    'placeholder' => 'Ввeдите домены'
]) --}}
