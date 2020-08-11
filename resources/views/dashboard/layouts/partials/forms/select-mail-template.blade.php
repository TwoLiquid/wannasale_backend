<div class="form-group form-group-default {{ $class or '' }} form-group-default-select2 {{ isset($required) && $required ? 'required' : '' }}">
    <label>{!! $title or '' !!}</label>
    <select id="mailTemplatesSelect" title="{!! $title or '' !!}" name="{{ $name or '' }}" class="full-width" data-init-plugin="select2" data-placeholder="{{ $placeholer or '' }}" {{ isset($required) && $required ? 'required' : '' }}>
        <option data-title="" data-text="" value="none" selected>Нет</option>
        @if(isset($optionsRaw))
            {!! $optionsRaw !!}
        @elseif(isset($options) && is_array($options))
            @foreach($options as $optValue => $optData)
                <option value="{{ $optValue }}" data-title="{{ $optData['title'] }}" data-text="{{ $optData['text'] }}" title="{{ $optData['title'] }}. {{ $optData['text'] }}">{{ $optData['name'] }}</option>
            @endforeach
        @endif
    </select>
</div>
@if(isset($note))
    <div class="fs-11 hint-text p-l-15 m-b-10" style="margin-top: -8px;">{!! $note !!}</div>
@endif
