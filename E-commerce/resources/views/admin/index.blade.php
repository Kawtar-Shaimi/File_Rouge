@extends('layouts.back-office')

@section('title', 'Dashboard')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content')
    @include('layouts.admin-sidebar')

    <main class="ml-64 p-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <!-- Dashboard Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-slate-800">Dashboard</h1>
                <p class="text-sm text-slate-500 mt-1">Welcome to your admin dashboard</p>
            </div>

            <!-- Statistics Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 text-center hover:shadow-md transition-all duration-300">
                    <h3 class="text-lg font-semibold text-slate-700">Users</h3>
                    <p class="text-3xl font-bold text-teal-600 mt-2">{{ $users_count }}</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 text-center hover:shadow-md transition-all duration-300">
                    <h3 class="text-lg font-semibold text-slate-700">Books</h3>
                    <p class="text-3xl font-bold text-teal-600 mt-2">{{ $books_count }}</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 text-center hover:shadow-md transition-all duration-300">
                    <h3 class="text-lg font-semibold text-slate-700">Orders</h3>
                    <p class="text-3xl font-bold text-teal-600 mt-2">{{ $orders_count }}</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 text-center hover:shadow-md transition-all duration-300">
                    <h3 class="text-lg font-semibold text-slate-700">Categories</h3>
                    <p class="text-3xl font-bold text-teal-600 mt-2">{{ $categories_count }}</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 text-center hover:shadow-md transition-all duration-300">
                    <h3 class="text-lg font-semibold text-slate-700">Incomes</h3>
                    <p class="text-3xl font-bold text-teal-600 mt-2">${{ $incomes }}</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 text-center hover:shadow-md transition-all duration-300">
                    <h3 class="text-lg font-semibold text-slate-700">Visits</h3>
                    <p class="text-3xl font-bold text-teal-600 mt-2">{{ $visits_count }}</p>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="space-y-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                        <h2 class="text-xl font-semibold text-slate-800 mb-4">Incomes Chart</h2>
                        <div id="incomes_chart_div" class="h-[50vh]"></div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                        <h2 class="text-xl font-semibold text-slate-800 mb-4">Visits Chart</h2>
                        <div id="visits_chart_div" class="h-[50vh]"></div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                    <h2 class="text-xl font-semibold text-slate-800 mb-4">Users Distribution</h2>
                    <div id="users_distribution_chart_div" class="h-[50vh]"></div>
                </div>

                <div class="space-y-6">
                    <h2 class="text-2xl font-bold text-slate-800">Best Saled Books</h2>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                            <h3 class="text-lg font-semibold text-slate-700 mb-4">All Time</h3>
                            <div id="best_saled_books_chart_div" class="h-[50vh]"></div>
                        </div>
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                            <h3 class="text-lg font-semibold text-slate-700 mb-4">This Month</h3>
                            <div id="best_saled_books_of_the_month_chart_div" class="h-[50vh]"></div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <h2 class="text-2xl font-bold text-slate-800">Best Saled Categories</h2>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                            <h3 class="text-lg font-semibold text-slate-700 mb-4">All Time</h3>
                            <div id="best_saled_categories_chart_div" class="h-[50vh]"></div>
                        </div>
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                            <h3 class="text-lg font-semibold text-slate-700 mb-4">This Month</h3>
                            <div id="best_saled_categories_of_the_month_chart_div" class="h-[50vh]"></div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <h2 class="text-2xl font-bold text-slate-800">Best Saled Publishers</h2>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                            <h3 class="text-lg font-semibold text-slate-700 mb-4">All Time</h3>
                            <div id="best_saled_publishers_chart_div" class="h-[50vh]"></div>
                        </div>
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                            <h3 class="text-lg font-semibold text-slate-700 mb-4">This Month</h3>
                            <div id="best_saled_publishers_of_the_month_chart_div" class="h-[50vh]"></div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <h2 class="text-2xl font-bold text-slate-800">Best Rated Books</h2>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                            <h3 class="text-lg font-semibold text-slate-700 mb-4">All Time</h3>
                            <div id="best_rated_books_chart_div" class="h-[50vh]"></div>
                        </div>
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                            <h3 class="text-lg font-semibold text-slate-700 mb-4">This Month</h3>
                            <div id="best_rated_books_of_the_month_chart_div" class="h-[50vh]"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            /* Users Distribution Chart */
            @if ($users_distribution_chart_data->count() > 0)
                let users_distribution_chart_data = google.visualization.arrayToDataTable([
                    ['Users', 'Count'],
                    ...@json($users_distribution_chart_data)
                ]);

                let users_distribution_chart_options = {
                    title: 'Users Distribution',
                    pieHole: 0.4,
                    is3D: true,
                    backgroundColor: 'transparent',
                    titleTextStyle: {
                        color: '#334155',
                        fontSize: 16,
                        bold: true
                    },
                    legend: {
                        textStyle: {
                            color: '#334155'
                        }
                    }
                };

                let users_distribution_chart = new google.visualization.PieChart(document.getElementById(
                    'users_distribution_chart_div'));
                users_distribution_chart.draw(users_distribution_chart_data, users_distribution_chart_options);
            @else
                $('#users_distribution_chart_div').html(`
                    <div class="flex items-center justify-center h-full">
                        <p class="text-slate-500 text-lg font-medium">No Data To Show</p>
                    </div>
                `);
            @endif


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
                            color: '#334155'
                        },
                        textStyle: {
                            color: '#334155'
                        }
                    },
                    vAxis: {
                        minValue: 0,
                        titleTextStyle: {
                            color: '#334155'
                        },
                        textStyle: {
                            color: '#334155'
                        }
                    },
                    backgroundColor: 'transparent',
                    titleTextStyle: {
                        color: '#334155',
                        fontSize: 16,
                        bold: true
                    },
                    colors: ['#0d9488']
                };

                let incomes_chart = new google.visualization.AreaChart(document.getElementById('incomes_chart_div'));
                incomes_chart.draw(incomes_chart_data, incomes_chart_options);
            @else
                $('#incomes_chart_div').html(`
                    <div class="flex items-center justify-center h-full">
                        <p class="text-slate-500 text-lg font-medium">No Data To Show</p>
                    </div>
                `);
            @endif


            /* Visits chart */
            @if ($visits_chart_data->count() > 0)
                let visits_chart_data = google.visualization.arrayToDataTable([
                    ['Time', 'Visits'],
                    ...@json($visits_chart_data)
                ]);

                let visits_chart_options = {
                    title: 'Hourly Visits',
                    hAxis: {
                        title: 'Time',
                        titleTextStyle: {
                            color: '#334155'
                        },
                        textStyle: {
                            color: '#334155'
                        }
                    },
                    vAxis: {
                        minValue: 0,
                        titleTextStyle: {
                            color: '#334155'
                        },
                        textStyle: {
                            color: '#334155'
                        }
                    },
                    backgroundColor: 'transparent',
                    titleTextStyle: {
                        color: '#334155',
                        fontSize: 16,
                        bold: true
                    },
                    colors: ['#0d9488']
                };

                let visits_chart = new google.visualization.AreaChart(document.getElementById('visits_chart_div'));
                visits_chart.draw(visits_chart_data, visits_chart_options);
            @else
                $('#visits_chart_div').html(`
                    <div class="flex items-center justify-center h-full">
                        <p class="text-slate-500 text-lg font-medium">No Data To Show</p>
                    </div>
                `);
            @endif


            /* Best Saled Books chart */
            @if ($best_saled_books_chart_data->count() > 0)
                let best_saled_books_chart_data = google.visualization.arrayToDataTable([
                    ["Title", "Incomes", {
                        role: 'style'
                    }],
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
                    titleTextStyle: {
                        color: '#334155',
                        fontSize: 16,
                        bold: true
                    },
                    hAxis: {
                        textStyle: {
                            color: '#334155'
                        }
                    },
                    vAxis: {
                        textStyle: {
                            color: '#334155'
                        }
                    },
                    colors: ['#0d9488']
                };

                let best_saled_books_chart = new google.visualization.ColumnChart(document.getElementById(
                    "best_saled_books_chart_div"));
                best_saled_books_chart.draw(best_saled_books_chart_view, best_saled_books_chart_options);
            @else
                $("#best_saled_books_chart_div").html(`
                    <div class="flex items-center justify-center h-full">
                        <p class="text-slate-500 text-lg font-medium">No Data To Show</p>
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
                    backgroundColor: 'transparent',
                    titleTextStyle: {
                        color: '#334155',
                        fontSize: 16,
                        bold: true
                    },
                    hAxis: {
                        textStyle: {
                            color: '#334155'
                        }
                    },
                    vAxis: {
                        textStyle: {
                            color: '#334155'
                        }
                    },
                    colors: ['#0d9488']
                };

                let best_saled_books_of_the_month_chart = new google.visualization.ColumnChart(document.getElementById(
                    "best_saled_books_of_the_month_chart_div"));
                best_saled_books_of_the_month_chart.draw(best_saled_books_of_the_month_chart_view,
                    best_saled_books_of_the_month_chart_options);
            @else
                $("#best_saled_books_of_the_month_chart_div").html(`
                    <div class="flex items-center justify-center h-full">
                        <p class="text-slate-500 text-lg font-medium">No Data To Show</p>
                    </div>
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
                    backgroundColor: 'transparent',
                    titleTextStyle: {
                        color: '#334155',
                        fontSize: 16,
                        bold: true
                    },
                    hAxis: {
                        textStyle: {
                            color: '#334155'
                        }
                    },
                    vAxis: {
                        textStyle: {
                            color: '#334155'
                        }
                    },
                    colors: ['#0d9488']
                };

                let best_saled_categories_chart = new google.visualization.ColumnChart(document.getElementById(
                    "best_saled_categories_chart_div"));
                best_saled_categories_chart.draw(best_saled_categories_chart_view, best_saled_categories_chart_options);
            @else
                $("#best_saled_categories_chart_div").html(`
                    <div class="flex items-center justify-center h-full">
                        <p class="text-slate-500 text-lg font-medium">No Data To Show</p>
                    </div>
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
                    backgroundColor: 'transparent',
                    titleTextStyle: {
                        color: '#334155',
                        fontSize: 16,
                        bold: true
                    },
                    hAxis: {
                        textStyle: {
                            color: '#334155'
                        }
                    },
                    vAxis: {
                        textStyle: {
                            color: '#334155'
                        }
                    },
                    colors: ['#0d9488']
                };

                let best_saled_categories_of_the_month_chart = new google.visualization.ColumnChart(document.getElementById(
                    "best_saled_categories_of_the_month_chart_div"));
                best_saled_categories_of_the_month_chart.draw(best_saled_categories_of_the_month_chart_view,
                    best_saled_categories_of_the_month_chart_options);
            @else
                $("#best_saled_categories_of_the_month_chart_div").html(`
                    <div class="flex items-center justify-center h-full">
                        <p class="text-slate-500 text-lg font-medium">No Data To Show</p>
                    </div>
                `);
            @endif


            /* Best Saled Publishers chart */
            @if ($best_saled_publishers_chart_data->count() > 0)
                let best_saled_publishers_chart_data = google.visualization.arrayToDataTable([
                    ["Publisher", "Incomes", {
                        role: 'style'
                    }],
                    ...@json($best_saled_publishers_chart_data)
                ]);

                let best_saled_publishers_chart_view = new google.visualization.DataView(best_saled_publishers_chart_data);
                best_saled_publishers_chart_view.setColumns([0, 1,
                    {
                        calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation"
                    },
                    2
                ]);

                let best_saled_publishers_chart_options = {
                    title: "Best Saled Publishers",
                    bar: {
                        groupWidth: "95%"
                    },
                    legend: {
                        position: "none"
                    },
                    backgroundColor: 'transparent',
                    titleTextStyle: {
                        color: '#334155',
                        fontSize: 16,
                        bold: true
                    },
                    hAxis: {
                        textStyle: {
                            color: '#334155'
                        }
                    },
                    vAxis: {
                        textStyle: {
                            color: '#334155'
                        }
                    },
                    colors: ['#0d9488']
                };

                let best_saled_publishers_chart = new google.visualization.ColumnChart(document.getElementById(
                    "best_saled_publishers_chart_div"));
                best_saled_publishers_chart.draw(best_saled_publishers_chart_view, best_saled_publishers_chart_options);
            @else
                $("#best_saled_publishers_chart_div").html(`
                    <div class="flex items-center justify-center h-full">
                        <p class="text-slate-500 text-lg font-medium">No Data To Show</p>
                    </div>
                `);
            @endif


            /* Best Saled Publishers of the Month chart */
            @if ($best_saled_publishers_of_the_month_chart_data->count() > 0)
                let best_saled_publishers_of_the_month_chart_data = google.visualization.arrayToDataTable([
                    ["Publisher", "Incomes", {
                        role: 'style'
                    }],
                    ...@json($best_saled_publishers_of_the_month_chart_data)
                ]);

                let best_saled_publishers_of_the_month_chart_view = new google.visualization.DataView(
                    best_saled_publishers_of_the_month_chart_data);
                best_saled_publishers_of_the_month_chart_view.setColumns([0, 1,
                    {
                        calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation"
                    },
                    2
                ]);

                let best_saled_publishers_of_the_month_chart_options = {
                    title: "Best Saled Publishers of the Month",
                    bar: {
                        groupWidth: "95%"
                    },
                    legend: {
                        position: "none"
                    },
                    backgroundColor: 'transparent',
                    titleTextStyle: {
                        color: '#334155',
                        fontSize: 16,
                        bold: true
                    },
                    hAxis: {
                        textStyle: {
                            color: '#334155'
                        }
                    },
                    vAxis: {
                        textStyle: {
                            color: '#334155'
                        }
                    },
                    colors: ['#0d9488']
                };

                let best_saled_publishers_of_the_month_chart = new google.visualization.ColumnChart(document.getElementById(
                    "best_saled_publishers_of_the_month_chart_div"));
                best_saled_publishers_of_the_month_chart.draw(best_saled_publishers_of_the_month_chart_view,
                    best_saled_publishers_of_the_month_chart_options);
            @else
                $("#best_saled_publishers_of_the_month_chart_div").html(`
                    <div class="flex items-center justify-center h-full">
                        <p class="text-slate-500 text-lg font-medium">No Data To Show</p>
                    </div>
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
                    backgroundColor: 'transparent',
                    titleTextStyle: {
                        color: '#334155',
                        fontSize: 16,
                        bold: true
                    },
                    hAxis: {
                        textStyle: {
                            color: '#334155'
                        }
                    },
                    vAxis: {
                        textStyle: {
                            color: '#334155'
                        }
                    },
                    colors: ['#0d9488']
                };

                let best_rated_books_chart = new google.visualization.ColumnChart(document.getElementById(
                    "best_rated_books_chart_div"));
                best_rated_books_chart.draw(best_rated_books_chart_view, best_rated_books_chart_options);
            @else
                $("#best_rated_books_chart_div").html(`
                    <div class="flex items-center justify-center h-full">
                        <p class="text-slate-500 text-lg font-medium">No Data To Show</p>
                    </div>
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
                    backgroundColor: 'transparent',
                    titleTextStyle: {
                        color: '#334155',
                        fontSize: 16,
                        bold: true
                    },
                    hAxis: {
                        textStyle: {
                            color: '#334155'
                        }
                    },
                    vAxis: {
                        textStyle: {
                            color: '#334155'
                        }
                    },
                    colors: ['#0d9488']
                };

                let best_rated_books_of_the_month_chart = new google.visualization.ColumnChart(document.getElementById(
                    "best_rated_books_of_the_month_chart_div"));
                best_rated_books_of_the_month_chart.draw(best_rated_books_of_the_month_chart_view,
                    best_rated_books_of_the_month_chart_options);
            @else
                $("#best_rated_books_of_the_month_chart_div").html(`
                    <div class="flex items-center justify-center h-full">
                        <p class="text-slate-500 text-lg font-medium">No Data To Show</p>
                    </div>
                `);
            @endif
        }
    </script>
@endsection
