<div class="form-group form-group-default {{ isset($required) && $required ? 'required' : '' }}">
    <label>
        {!! $title or '' !!}
        @if(isset($lang))
            @include('dashboard.layouts.partials.'.$lang.'-label')
        @endif
    </label>

    <select data-role="tagsinput" {{ isset($id) ? 'id=' . $id : '' }} title="{!! $title or '' !!}" name="{{ $name or '' }}" class="full-width" multiple data-placeholder="{{ $placeholder or '' }}" {{ isset($required) && $required ? 'required' : '' }}>
        @if(isset($values) && is_array($values))
            @foreach($values as $value)
                <option value="{{ $value }}">{{ $value }}</option>
            @endforeach
        @endif
    </select>
</div>
