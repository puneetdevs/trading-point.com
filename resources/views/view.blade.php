@extends('layouts.app')
@section('content')
    <x-common.card>
        @slot('card_content')
            <div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-12">

                            <x-common.messages />

                            <div class="card">
                                <h4 class="card-header">{{ __('Historical Quotes For Company Symbol: ') }}</h4>

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Open</th>
                                                <th>High</th>
                                                <th>Low</th>
                                                <th>Close</th>
                                                <th>Volume</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $quote)
                                                <tr class="quote-row">
                                                    <td>{{ date('Y-m-d H:i:s', $quote['date']) ?? 'na' }}</td>
                                                    <td>{{ $quote['open'] ?? 'na' }}</td>
                                                    <td>{{ $quote['high'] ?? 'na' }}</td>
                                                    <td>{{ $quote['low'] ?? 'na' }}</td>
                                                    <td>{{ $quote['close'] ?? 'na' }}</td>
                                                    <td>{{ $quote['volume'] ?? 'na' }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                                    <div class="text-center mb-5">
                                        <button class="btn btn-primary show-more">Show More</button>
                                        <button class="btn btn-primary show-less" style="display: none;">Show Less</button>
                                    </div>

                                    <script>
                                        $(document).ready(function() {
                                            var rowsToShow = 5;
                                            var $tableRows = $('.quote-row');

                                            $tableRows.slice(rowsToShow).hide();

                                            $('.show-more').on('click', function() {
                                                rowsToShow += 5;
                                                $tableRows.slice(0, rowsToShow).show();
                                                if (rowsToShow >= $tableRows.length) {
                                                    $(this).hide();
                                                }
                                                $('.show-less').show();
                                            });

                                            $('.show-less').on('click', function() {
                                                rowsToShow -= 5;
                                                $tableRows.slice(rowsToShow).hide();
                                                if (rowsToShow <= 5) {
                                                    $(this).hide();
                                                }
                                                $('.show-more').show();
                                            });
                                        });
                                    </script>
                                </div>
                            </div>

                            <div class="card mt-5">
                                <h4 class="card-header">{{ __('Chart of the Open and Close prices: ') }}</h4>

                                <div>
                                    <canvas id="ocPricesChart"></canvas>
                                </div>

                                <script>
                                    var ctx = document.getElementById('ocPricesChart').getContext('2d');
                                    var data = {
                                        labels: [
                                            @foreach ($data as $item)
                                                "{{ date('Y-m-d', $item['date']) ?? '0' }}",
                                            @endforeach
                                        ],
                                        datasets: [{
                                            label: 'Open',
                                            data: [
                                                @foreach ($data as $item)
                                                    "{{ $item['open'] ?? '0' }}",
                                                @endforeach
                                            ],
                                            borderColor: 'rgba(255, 99, 132, 1)',
                                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                        }, {
                                            label: 'Close',
                                            data: [
                                                @foreach ($data as $item)
                                                    "{{ $item['close'] ?? '0' }}",
                                                @endforeach
                                            ],
                                            borderColor: 'rgba(54, 162, 235, 1)',
                                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                        }]
                                    };
                                    var myChart = new Chart(ctx, {
                                        type: 'line',
                                        data: data,
                                        options: {
                                            responsive: true,
                                            scales: {
                                            }
                                        }
                                    });
                                </script>


                            </div>
                        </div>
                    </div>
                </div>
            </div>


            </div>
        @endslot
    </x-common.card>
@endsection
