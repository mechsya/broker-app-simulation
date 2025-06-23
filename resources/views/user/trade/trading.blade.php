@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Trading',
        'path' => ['Home', 'Trading'],
    ])

    <section class="w-full mt-6 overflow-hidden rounded-lg text-white/80">
        <div class="bg-black rounded-lg p-4">
            <form action="{{ route('trade.store') }}" method="POST">
                @csrf
                <select id="instrumentSelect" name="market"
                    class="bg-background outline-none p-3 mb-4 border border-white/30 w-full mt-2 rounded-lg h-[50px]">
                    <option data-instrument="BTC" value="bitcoin" selected>BTC/USD</option>
                    <option data-instrument="ETH" value="ethereum">BTC/ETH</option>
                    <option data-instrument="DOGE" value="dogecoin">DOGE/USD</option>
                    <option data-instrument="BNB" value="bnb">BNB/USD</option>
                </select>

                <!-- TradingView Widget START -->
                <div class="h-96 lg:h-[600px]">
                    <div class="tradingview-widget-container" style="height:100%;width:100%">
                        <div class="tradingview-widget-container__widget" id="tradingviewWidget"
                            style="height:calc(100% - 32px);width:100%"></div>
                    </div>
                </div>
                <!-- TradingView Widget END -->

                <div class="flex lg:flex-row flex-col gap-4 items-center">
                    <div class="w-full">
                        @include('components.input-icon', [
                            'name' => 'amount',
                            'icon' => 'AED',
                            'required' => true,
                        ])
                    </div>

                    <div
                        class="flex w-full items-center h-[50px] relative border rounded-lg overflow-hidden border-white/30">
                        <div class="bg-background outline-none h-full p-3 px-5  rounded-l-lg border-r-0">
                            <i class="fa fa-id-badge text-lg" aria-hidden="true"></i>
                        </div>

                        <select name="timeFrame"
                            class="text-white/50 w-full mt-2 outline-none rounded-r-lg p-3 bg-black mb-2">
                            <option value="{{ 30 }}">30 Seconds</option>
                            <option value="{{ 30 * 2 * 1 }}">1 Minute</option>
                            <option value="{{ 30 * 2 * 5 }}">5 Minutes</option>
                            <option value="{{ 30 * 2 * 10 }}">10 Minutes</option>
                        </select>
                    </div>

                    <div class="flex w-full items-center">
                        <button class="bg-red-400 p-3 rounded-lg w-full text-white h-[50px]" value="sell"
                            name="type">Sell
                            50%</button>
                    </div>

                    <div class="flex w-full items-center">
                        <button class="bg-green p-3 rounded-lg w-full text-white h-[50px]" value="buy" name="type">Buy
                            50%</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="w-full mt-6 rounded-lg overflow-hidden bg-black">
            <div class="p-6 text-white/70 border-b border-white/25">
                <p>History</p>
            </div>
            <div class="p-4 lg:p-6 overflow-x-scroll">
                <div class="w-[900px] lg:w-auto">
                    <table id="container-table" class="w-full table-bottom-border">
                        <thead>
                            <tr class="table-bottom-border">
                                <td class="table-bottom-border">Date</td>
                                <td class="table-bottom-border">Market</td>
                                <td class="table-bottom-border">Trx</td>
                                <td class="table-bottom-border">Package</td>
                                <td class="table-bottom-border">Amount</td>
                                <td class="table-bottom-border">Bet Rate</td>
                                <td class="table-bottom-border">Profit</td>
                                <td class="table-bottom-border">Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($tradings) != 0)
                                @foreach ($tradings as $trading)
                                    <tr class="table-bottom-border">
                                        <td class="table-bottom-border">{{ $trading->created_at }}</td>
                                        <td class="table-bottom-border uppercase">{{ $trading->market }}</td>
                                        <td class="table-bottom-border">
                                            <span
                                                class="{{ $trading->type == 'buy' ? 'win' : 'lose' }} uppercase">{{ $trading->type }}</span>
                                            <br />{{ $trading->package }}
                                        </td>
                                        <td class="table-bottom-border">@money($trading->amount)</td>
                                        <td class="table-bottom-border">
                                            <button class="bg-blue-500 px-2 py-1 rounded">Detail</button>
                                        </td>
                                        <td class="table-bottom-border">@money($trading->open)</td>
                                        <td class="table-bottom-border">
                                            @if ($trading->status == 'pending')
                                                <button class="bg-orange px-2 py-1 rounded">Pending</button>
                                            @else
                                                <p>{{ $trading->profit }}</p>
                                            @endif
                                        </td>
                                        <td class="table-bottom-border">
                                            <button
                                                class="{{ $trading->status == 'win' ? 'bg-green' : 'bg-red-500' }} px-2 py-1 rounded">{{ $trading->status }}</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="p-4" colspan="8">No data available in table</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script type="text/javascript">
        // Function to update the TradingView widget
        function updateTradingViewWidget(symbol) {
            const widgetContainer = document.getElementById('tradingviewWidget');

            // Clear the existing widget
            widgetContainer.innerHTML = '';

            // Create new script element
            const script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js';
            script.async = true;

            // Set new widget configuration
            script.innerHTML = JSON.stringify({
                "autosize": true,
                "symbol": symbol,
                "interval": "D",
                "timezone": "Etc/UTC",
                "theme": "dark",
                "style": "1",
                "locale": "en",
                "allow_symbol_change": true,
                "calendar": false,
                "support_host": "https://www.tradingview.com"
            });

            // Append script to the widget container
            widgetContainer.appendChild(script);
        }

        // Update widget when selection changes
        document.getElementById('instrumentSelect').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            // Get the value of data-instrument attribute
            const instrument = selectedOption.getAttribute('data-instrument');
            updateTradingViewWidget(instrument);
        });

        // Set default instrument on page load
        window.addEventListener('load', function() {
            updateTradingViewWidget('BTC');
        });
    </script>
@endsection
