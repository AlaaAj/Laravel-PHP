@extends('layouts.app')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <div class="container chart-container">
        <div class="row">
            <div class="col chart-container" style="position: relative; height:40vh; width:80vw">
                <canvas id="myChart"  style="width:100%;max-width:600px"></canvas>
                <script>
                    var ctx = document.getElementById('myChart').getContext('2d');
                                                const orders_status = [];
                                                const orders_counts = [];
                                                @foreach($orders as $order)
                                                orders_counts.push({{$order->count}});
                                                orders_status.push('{{$order->status}}');
                                                        @endforeach
                    var myChart = new Chart(ctx, {

                        type: 'pie',
                        data: {
                            labels: orders_status,
                            datasets: [{
                                label: 'Orders status',
                                data: orders_counts,
                                backgroundColor: [
                                    'rgba(243, 112, 42, 0.2)',
                                    'rgba(9, 173, 200, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(42, 216, 108, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(243, 112, 42, 1)',
                                    'rgba(9, 173, 200, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(42, 216, 108, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            legend: {display: true},
                            title: {
                                display: true,
                                text: "Orders status"
                            },
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            </div>

            <div class="col chart-container" style="position: relative; height:40vh; width:80vw">
                <canvas id="myChart2" style="width:100%;max-width:600px"></canvas>
                <script>
                    const item_name = [];
                    const items_count = [];
                    @foreach($items as $item)
                    items_count.push({{$item->count}});
                    item_name.push('{{$item->name}}');
                            @endforeach
                    var ctx = document.getElementById('myChart2').getContext('2d');
                    var myChart = new Chart(ctx, {

                        type: 'bar',
                        data: {
                            labels: item_name,
                            datasets: [{
                                label: 'Top 5 Items',
                                data: items_count,
                                backgroundColor: [
                                    'rgba(243, 112, 42, 0.2)',
                                    'rgba(9, 173, 200, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(42, 216, 108, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(243, 112, 42, 1)',
                                    'rgba(9, 173, 200, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(42, 216, 108, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            legend: {display: false},
                            title: {
                                display: true,
                                text: "Top 5 Items"
                            },
                            responsive: true,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        precision: 0
                                    }
                                }]
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </br>
        <div class="row">
            <div class="col chart-container" style="position: relative; height:40vh; width:80vw"">
                <canvas id="myChart3" style="width:100%;max-width:600px"></canvas>
                <script>
                    const designer_name = [];
                    const designer_count = [];
                    @foreach($designers as $designer)
                    designer_count.push({{$designer->count}});
                    designer_name.push('{{$designer->designer->name}}');
                            @endforeach
                    var ctx = document.getElementById('myChart3').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: designer_name,
                            datasets: [{
                                label: 'Top 5 Designers',
                                data: designer_count,
                                base: 0,
                                indexAxis: 0,
                                backgroundColor: [
                                    'rgba(243, 112, 42, 0.2)',
                                    'rgba(9, 173, 200, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(42, 216, 108, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(243, 112, 42, 1)',
                                    'rgba(9, 173, 200, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(42, 216, 108, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            legend: {display: false},
                            title: {
                                display: true,
                                text: "Top 5 Designers"
                            },
                            responsive: true,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        precision: 0
                                    }
                                }],
                                xAxes: [{
                                    barPercentage: 0.2
                                }]
                            }
                        }
                    });
                </script>
            </div>

            <div class="col chart-container" style="position: relative; height:40vh; width:80vw"">
                <canvas id="myChart4" style="width:100%;max-width:600px"></canvas>
                <script>
                    const printworker_name = [];
                    const printworker_count = [];
                    @foreach($printworkers as $printworker)
                    printworker_count.push({{$printworker->count}});
                    printworker_name.push('{{$printworker->printWorker->name}}');
                            @endforeach
                    var ctx = document.getElementById('myChart4').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: printworker_name,
                            datasets: [{
                                label: 'Top 5 PrintWorkers',
                                data: printworker_count,
                                backgroundColor: [
                                    'rgba(243, 112, 42, 0.2)',
                                    'rgba(9, 173, 200, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(42, 216, 108, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(243, 112, 42, 1)',
                                    'rgba(9, 173, 200, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(42, 216, 108, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            legend: {display: false},
                            title: {
                                display: true,
                                text: "Top 5 PrintWorkers"
                            },
                            responsive: true,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        precision: 0
                                    }
                                }],
                                xAxes: [{
                                    barPercentage: 0.2
                                }]
                            }
                        }
                    });
                </script>
            </div>
        </div>
        </div>
    </div>

@endsection
