@php /** @var \App\Models\Item $item */ @endphp
<div class="row">

    <div class="col-md-7">
        @component('dashboard.layouts.partials.card')
            @slot('cardTitle')
                Основные данные
            @endslot

            @include('dashboard.layouts.partials.forms.text', [
                'title' => 'Название',
                'name' => 'name',
                'required' => true,
                'value' => old('name', isset($item) ? $item->name : ''),
                'placeholder' => 'Введите название товара'
            ])
            @include('dashboard.layouts.partials.forms.text', [
                'title' => 'Артикул',
                'name' => 'code',
                'required' => false,
                'value' => old('code', isset($item) ? $item->code : ''),
                'placeholder' => 'Введите артикул товара'
            ])
            @include('dashboard.layouts.partials.forms.number', [
                'title' => 'Исходная цена',
                'name' => 'initial_price',
                'required' => true,
                'value' => old('initial_price', isset($item) ? $item->initial_price : ''),
                'placeholder' => 'Введите исходную версию товара'
            ])
            @include('dashboard.layouts.partials.forms.number', [
                'title' => 'Минимальная допустимая цена',
                'name' => 'min_acceptable_price',
                'required' => true,
                'value' => old('min_acceptable_price', isset($item) ? $item->min_acceptable_price : ''),
                'placeholder' => 'Введите минимальную допустимую цену товара'
            ])
            @include('dashboard.layouts.partials.forms.number', [
                'title' => 'Минимальная недопустимая цена',
                'name' => 'min_unacceptable_price',
                'required' => true,
                'value' => old('min_unacceptable_price', isset($item) ? $item->min_unacceptable_price : ''),
                'placeholder' => 'Введите минимальную недопустимую цену товара'
            ])
            @include('dashboard.layouts.partials.forms.tags-input', [
                'title' => 'Url-ы',
                'name' => 'urls[]',
                'required' => true,
                'values' => old('urls', isset($item->urls) ? $item->urls : []),
                'placeholder' => 'Ввeдите URL-ы'
            ])
            <p class="no-margin">Введите ссылку на продукт или ее часть, при совпадении с которой вы хотели бы ссылаться на данный товар и нажмите <strong>enter</strong>.</p>
            <p>Например: <code>product</code>, <code>product/15</code> и тд.</p>
        @endcomponent
    </div>

    @if(isset($itemGraph))
        <div class="col-md-5">
            @component('dashboard.layouts.partials.card')
                @slot('cardTitle')
                    Динамика предлагаемых цен за товар
                @endslot

                <div id="graph"></div>
                <div id="legend"></div>
            @endcomponent
        </div>
    @endif
</div>

@if(isset($itemGraph))
    @push('scripts')

        <script>

            $(document).ready(function () {

                // instantiate our graph!
                var graph = new Rickshaw.Graph( {
                    element: document.getElementById("graph"),
                    renderer: 'line',
                    unstack: true,
                    series: [
                        {
                            color: "#c05020",
                            name: 'Цены покупателя',
                            // data: seriesData[0],
                            data: <?=json_encode($itemGraph->getClientOffers())?>,
                        },
                        {
                            color: "#30c020",
                            name: 'Цены продавца',
                            data: <?=json_encode($itemGraph->getSellerOffers())?>,
                        },
                        {
                            color: "#6060c0",
                            name: 'Цены успешных сделок',
                            data: <?=json_encode($itemGraph->getSuccessfullyOffers())?>,
                        },
                        {
                            color: "#ffd700",
                            name: 'Цены неуспешных сделок',
                            data: <?=json_encode($itemGraph->getUnsuccessfullyOffers())?>,
                        }
                    ]
                });

                graph.render();

                var hoverDetail = new Rickshaw.Graph.HoverDetail({
                    graph: graph
                });

                var legend = new Rickshaw.Graph.Legend({
                    graph: graph,
                    element: document.getElementById('legend')
                });
            });

        </script>
    @endpush
@endif
