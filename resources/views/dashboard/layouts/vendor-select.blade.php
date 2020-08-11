<div class="pull-right m-r-20" style="width: 160px;">
    <div class="form-group form-group-default m-t-10">
        <select id="headerVendorSelect" class="form-control" data-domain="{{ config('app.domain') }}" title="Доступные компании" style="height: 25px;">
            @foreach($vendors as $vendor)
                @php /** @var \App\Models\Vendor $vendor */ @endphp
                <option value="{{ $vendor->slug }}" {{ $vendor->slug === get_url_default('vendorSlug') ? 'selected' : '' }}>{{ $vendor->name }}</option>
            @endforeach
        </select>
    </div>
</div>
