@extends('layouts.back-office')

@section('title', 'Dashboard')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content')
    @include('layouts.publisher-sidebar')

    <div class="container w-5/6 ms-auto p-6 bg-slate-50 min-h-screen">
        <!-- Dashboard Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-slate-800">Dashboard</h1>
            <div class="text-sm text-slate-500">
                <span class="font-medium">Welcome back,</span>
                <span class="text-teal-600 font-semibold">{{ Auth::guard('publisher')->user()->name }}</span>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-slate-700">Books</h3>
                    <div class="p-2 bg-orange-100 rounded-lg">
                        <i class="fas fa-book text-orange-500"></i>
                    </div>
                </div>
                <p class="text-3xl font-bold text-orange-500">{{ $books_count }}</p>
                <p class="text-sm text-slate-500 mt-2">Total books in your collection</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-slate-700">Orders</h3>
                    <div class="p-2 bg-red-100 rounded-lg">
                        <i class="fas fa-shopping-cart text-red-500"></i>
                    </div>
                </div>
                <p class="text-3xl font-bold text-red-500">{{ $orders_count }}</p>
                <p class="text-sm text-slate-500 mt-2">Total orders received</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-slate-700">Reviews</h3>
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <i class="fas fa-star text-yellow-500"></i>
                    </div>
                </div>
                <p class="text-3xl font-bold text-yellow-500">{{ $reviews_count }}</p>
                <p class="text-sm text-slate-500 mt-2">Total customer reviews</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-slate-700">Incomes</h3>
                    <div class="p-2 bg-teal-100 rounded-lg">
                        <i class="fas fa-dollar-sign text-teal-500"></i>
                    </div>
                </div>
                <p class="text-3xl font-bold text-teal-500">${{ $incomes }}</p>
                <p class="text-sm text-slate-500 mt-2">Total earnings</p>
            </div>
        </div>

        <!-- Charts -->
        <div class="space-y-8">
            <!-- Incomes Chart -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                <h2 class="text-xl font-semibold text-slate-800 mb-4">Hourly Incomes</h2>
                <div id="incomes_chart_div" class="h-[50vh]"></div>
            </div>

            <!-- Best Saled Books -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                    <h2 class="text-xl font-semibold text-slate-800 mb-4">Best Saled Books</h2>
                    <div id="best_saled_books_chart_div" class="h-[50vh]"></div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                    <h2 class="text-xl font-semibold text-slate-800 mb-4">Best Saled Books of the Month</h2>
                    <div id="best_saled_books_of_the_month_chart_div" class="h-[50vh]"></div>
                </div>
            </div>

            <!-- Best Saled Categories -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                    <h2 class="text-xl font-semibold text-slate-800 mb-4">Best Saled Categories</h2>
                    <div id="best_saled_categories_chart_div" class="h-[50vh]"></div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                    <h2 class="text-xl font-semibold text-slate-800 mb-4">Best Saled Categories of the Month</h2>
                    <div id="best_saled_categories_of_the_month_chart_div" class="h-[50vh]"></div>
                </div>
            </div>

            <!-- Best Rated Books -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                    <h2 class="text-xl font-semibold text-slate-800 mb-4">Best Rated Books</h2>
                    <div id="best_rated_books_chart_div" class="h-[50vh]"></div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                    <h2 class="text-xl font-semibold text-slate-800 mb-4">Best Rated Books of the Month</h2>
                    <div id="best_rated_books_of_the_month_chart_div" class="h-[50vh]"></div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            /* Incomes chart */
            @if ($incomes_chart_data->count() > 0)
                let incomes_chart_data = google.visualization.arrayToDataTable([
                    ['Time', 'Incomes'],
                    ...@json($incomes_chart_data)
                ]);

                let incomes_chart_options = {
                    title: 'Hourly Incomes',
                    hAxis: {
                        title: 'Time',
                        titleTextStyle: {
                            color: '#333'
                        }
                    },
                    vAxis: {
                        minValue: 0
                    },
                    backgroundColor: 'transparent',
                    chartArea: {
                        backgroundColor: 'transparent'
                    },
                    colors: ['#0d9488']
                };

                let incomes_chart = new google.visualization.AreaChart(document.getElementById('incomes_chart_div'));
                incomes_chart.draw(incomes_chart_data, incomes_chart_options);
            @else
                $('#incomes_chart_div').html(`
                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-400">
                        <i class="fas fa-chart-line text-5xl mb-4"></i>
                        <p class="text-lg font-medium">No Data To Show</p>
                    </div>
                `);
            @endif

            /* Best Saled Books chart */
            @if ($best_saled_books_chart_data->count() > 0)
                let best_saled_books_chart_data = google.visualization.arrayToDataTable([
                    ["Title", "Incomes", { role: 'style' }],
                    ...@json($best_saled_books_chart_data)
                ]);

                let best_saled_books_chart_view = new google.visualization.DataView(best_saled_books_chart_data);
                best_saled_books_chart_view.setColumns([0, 1,
                    {
                        calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation"
                    },
                    2
                ]);

                let best_saled_books_chart_options = {
                    title: "Best Saled Books",
                    bar: {
                        groupWidth: "95%"
                    },
                    legend: {
                        position: "none"
                    },
                    backgroundColor: 'transparent',
                    chartArea: {
                        backgroundColor: 'transparent'
                    },
                    colors: ['#0d9488']
                };

                let best_saled_books_chart = new google.visualization.ColumnChart(document.getElementById("best_saled_books_chart_div"));
                best_saled_books_chart.draw(best_saled_books_chart_view, best_saled_books_chart_options);
            @else
                $("#best_saled_books_chart_div").html(`
                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-400">
                        <i class="fas fa-chart-bar text-5xl mb-4"></i>
                        <p class="text-lg font-medium">No Data To Show</p>
                    </div>
                `);
            @endif

            /* Best Saled Books of the Month chart */
            @if ($best_saled_books_of_the_month_chart_data->count() > 0)
                let best_saled_books_of_the_month_chart_data = google.visualization.arrayToDataTable([
                    ["Title", "Incomes", {
                        role: 'style'
                    }],
                    ...@json($best_saled_books_of_the_month_chart_data)
                ]);

                let best_saled_books_of_the_month_chart_view = new google.visualization.DataView(
                    best_saled_books_of_the_month_chart_data);
                best_saled_books_of_the_month_chart_view.setColumns([0, 1,
                    {
                        calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation"
                    },
                    2
                ]);

                let best_saled_books_of_the_month_chart_options = {
                    title: "Best Saled Books of the Month",
                    bar: {
                        groupWidth: "95%"
                    },
                    legend: {
                        position: "none"
                    },
                };

                let best_saled_books_of_the_month_chart = new google.visualization.ColumnChart(document.getElementById(
                    "best_saled_books_of_the_month_chart_div"));
                best_saled_books_of_the_month_chart.draw(best_saled_books_of_the_month_chart_view,
                    best_saled_books_of_the_month_chart_options);
            @else
                $('#best_saled_books_of_the_month_chart_div').html(`
                <p class="w-full h-full m-0 p-0 flex justify-center items-center text-red-500 font-bold text-3xl text-center">No Rated Books Yet</p>
            `);
            @endif

            /* Best Saled Categories chart */
            @if ($best_saled_categories_chart_data->count() > 0)
                let best_saled_categories_chart_data = google.visualization.arrayToDataTable([
                    ["Category", "Incomes", {
                        role: 'style'
                    }],
                    ...@json($best_saled_categories_chart_data)
                ]);

                let best_saled_categories_chart_view = new google.visualization.DataView(best_saled_categories_chart_data);
                best_saled_categories_chart_view.setColumns([0, 1,
                    {
                        calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation"
                    },
                    2
                ]);

                let best_saled_categories_chart_options = {
                    title: "Best Saled Categories",
                    bar: {
                        groupWidth: "95%"
                    },
                    legend: {
                        position: "none"
                    },
                };

                let best_saled_categories_chart = new google.visualization.ColumnChart(document.getElementById(
                    "best_saled_categories_chart_div"));
                best_saled_categories_chart.draw(best_saled_categories_chart_view, best_saled_categories_chart_options);
            @else
                $("#best_saled_categories_chart_div").html(`
                <p class="w-full h-full m-0 p-0 flex justify-center items-center text-red-500 font-bold text-3xl text-center">No Data To Show</p>
            `);
            @endif

            /* Best Saled Categories of the Month chart */
            @if ($best_saled_categories_of_the_month_chart_data->count() > 0)
                let best_saled_categories_of_the_month_chart_data = google.visualization.arrayToDataTable([
                    ["Category", "Incomes", {
                        role: 'style'
                    }],
                    ...@json($best_saled_categories_of_the_month_chart_data)
                ]);

                let best_saled_categories_of_the_month_chart_view = new google.visualization.DataView(
                    best_saled_categories_of_the_month_chart_data);
                best_saled_categories_of_the_month_chart_view.setColumns([0, 1,
                    {
                        calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation"
                    },
                    2
                ]);

                let best_saled_categories_of_the_month_chart_options = {
                    title: "Best Saled Categories of the Month",
                    bar: {
                        groupWidth: "95%"
                    },
                    legend: {
                        position: "none"
                    },
                };

                let best_saled_categories_of_the_month_chart = new google.visualization.ColumnChart(document.getElementById(
                    "best_saled_categories_of_the_month_chart_div"));
                best_saled_categories_of_the_month_chart.draw(best_saled_categories_of_the_month_chart_view,
                    best_saled_categories_of_the_month_chart_options);
            @else
                $("#best_saled_categories_of_the_month_chart_div").html(`
                <p class="w-full h-full m-0 p-0 flex justify-center items-center text-red-500 font-bold text-3xl text-center">No Data To Show</p>
            `);
            @endif

            /* Best Rated Books chart */
            @if ($best_rated_books_chart_data->count() > 0)
                let best_rated_books_chart_data = google.visualization.arrayToDataTable([
                    ["Title", "Rating", {
                        role: 'style'
                    }],
                    ...@json($best_rated_books_chart_data)
                ]);

                let best_rated_books_chart_view = new google.visualization.DataView(best_rated_books_chart_data);
                best_rated_books_chart_view.setColumns([0, 1,
                    {
                        calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation"
                    },
                    2
                ]);

                let best_rated_books_chart_options = {
                    title: "Best Rated Books",
                    bar: {
                        groupWidth: "95%"
                    },
                    legend: {
                        position: "none"
                    },
                };

                let best_rated_books_chart = new google.visualization.ColumnChart(document.getElementById(
                    "best_rated_books_chart_div"));
                best_rated_books_chart.draw(best_rated_books_chart_view, best_rated_books_chart_options);
            @else
                $("#best_rated_books_chart_div").html(`
                <p class="w-full h-full m-0 p-0 flex justify-center items-center text-red-500 font-bold text-3xl text-center">No Rated Books Yet</p>
            `);
            @endif

            /* Best Rated Books of the Month chart */
            @if ($best_rated_books_of_the_month_chart_data->count() > 0)
                let best_rated_books_of_the_month_chart_data = google.visualization.arrayToDataTable([
                    ["Title", "Rating", {
                        role: 'style'
                    }],
                    ...@json($best_rated_books_of_the_month_chart_data)
                ]);

                let best_rated_books_of_the_month_chart_view = new google.visualization.DataView(
                    best_rated_books_of_the_month_chart_data);
                best_rated_books_of_the_month_chart_view.setColumns([0, 1,
                    {
                        calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation"
                    },
                    2
                ]);

                let best_rated_books_of_the_month_chart_options = {
                    title: "Best Rated Books of the Month",
                    bar: {
                        groupWidth: "95%"
                    },
                    legend: {
                        position: "none"
                    },
                };

                let best_rated_books_of_the_month_chart = new google.visualization.ColumnChart(document.getElementById(
                    "best_rated_books_of_the_month_chart_div"));
                best_rated_books_of_the_month_chart.draw(best_rated_books_of_the_month_chart_view,
                    best_rated_books_of_the_month_chart_options);
            @else
                $('#best_rated_books_of_the_month_chart_div').html(`
                <p class="w-full h-full m-0 p-0 flex justify-center items-center text-red-500 font-bold text-3xl text-center">No Rated Books Yet</p>
            `);
            @endif
        }
    </script>
@endsection
