@extends('layouts.back-office')

@section('head')
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
@endsection

@section('content')

@include('layouts.admin-sidebar')

<main class="ml-64 p-6">
    <!-- Dashboard -->
    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

    <!-- Statistiques -->
    <div class="grid grid-cols-6 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h3 class="text-xl font-bold">Users</h3>
            <p class="text-3xl text-blue-500 font-bold">{{ $users_count }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h3 class="text-xl font-bold">Books</h3>
            <p class="text-3xl text-orange-500 font-bold">{{ $books_count }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h3 class="text-xl font-bold">Orders</h3>
            <p class="text-3xl text-red-500 font-bold">{{ $orders_count }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h3 class="text-xl font-bold">Categories</h3>
            <p class="text-3xl text-yellow-500 font-bold">{{ $categories_count }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h3 class="text-xl font-bold">Incomes</h3>
            <p class="text-3xl text-green-500 font-bold">${{ $incomes }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h3 class="text-xl font-bold">Visits</h3>
            <p class="text-3xl text-pink-500 font-bold">{{ $visits_count }}</p>
        </div>
    </div>

    <!-- Charts -->
    <h2 class="text-2xl font-bold mt-8 mb-4">Charts</h2>
    <div class="grid grid-cols-2 gap-6">
        <div id="incomes_chart_div" class="h-[50vh] bg-white p-6 rounded-lg shadow-lg overflow-hidden col-span-2"></div>
        <div id="visits_chart_div" class="h-[50vh] bg-white p-6 rounded-lg shadow-lg overflow-hidden"></div>
        <div id="users_distribution_chart_div" class="h-[50vh] bg-white p-6 rounded-lg shadow-lg overflow-hidden"></div>
        <h3 class="text-xl font-bold mt-8 mb-4 col-span-2">Best saled books charts</h3>
        <div id="best_saled_books_chart_div" class="h-[50vh] bg-white p-6 rounded-lg shadow-lg overflow-hidden"></div>
        <div id="best_saled_books_of_the_month_chart_div" class="h-[50vh] bg-white p-6 rounded-lg shadow-lg overflow-hidden"></div>
        <h3 class="text-xl font-bold mt-8 mb-4 col-span-2">Best saled categories charts</h3>
        <div id="best_saled_categories_chart_div" class="h-[50vh] bg-white p-6 rounded-lg shadow-lg overflow-hidden"></div>
        <div id="best_saled_categories_of_the_month_chart_div" class="h-[50vh] bg-white p-6 rounded-lg shadow-lg overflow-hidden"></div>
        <h3 class="text-xl font-bold mt-8 mb-4 col-span-2">Best saled publishers charts</h3>
        <div id="best_saled_publishers_chart_div" class="h-[50vh] bg-white p-6 rounded-lg shadow-lg overflow-hidden"></div>
        <div id="best_saled_publishers_of_the_month_chart_div" class="h-[50vh] bg-white p-6 rounded-lg shadow-lg overflow-hidden"></div>
        <h3 class="text-xl font-bold mt-8 mb-4 col-span-2">Best rated books charts</h3>
        <div id="best_rated_books_chart_div" class="h-[50vh] bg-white p-6 rounded-lg shadow-lg overflow-hidden"></div>
        <div id="best_rated_books_of_the_month_chart_div" class="h-[50vh] bg-white p-6 rounded-lg shadow-lg overflow-hidden"></div>
    </div>

</main>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
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
                is3D: true
            };

            let users_distribution_chart = new google.visualization.PieChart(document.getElementById('users_distribution_chart_div'));
            users_distribution_chart.draw(users_distribution_chart_data, users_distribution_chart_options);
        @else
            $('#users_distribution_chart_div').html(`
                <p class="w-full h-full m-0 p-0 flex justify-center items-center text-red-500 font-bold text-3xl text-center">No Data To Show</p>
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
                hAxis: {title: 'Time',  titleTextStyle: {color: '#333'}},
                vAxis: {minValue: 0}
            };

            let incomes_chart = new google.visualization.AreaChart(document.getElementById('incomes_chart_div'));
            incomes_chart.draw(incomes_chart_data, incomes_chart_options);
        @else
            $('#incomes_chart_div').html(`
                <p class="w-full h-full m-0 p-0 flex justify-center items-center text-red-500 font-bold text-3xl text-center">No Data To Show</p>
            `);
        @endif


        /* Incomes chart */
        @if ($visits_chart_data->count() > 0)
            let visits_chart_data = google.visualization.arrayToDataTable([
                ['Time', 'Incomes'],
                ...@json($visits_chart_data)
            ]);

            let visits_chart_options = {
                title: 'Hourly Incomes',
                hAxis: {title: 'Time',  titleTextStyle: {color: '#333'}},
                vAxis: {minValue: 0}
            };

            let visits_chart = new google.visualization.AreaChart(document.getElementById('visits_chart_div'));
            visits_chart.draw(visits_chart_data, visits_chart_options);
        @else
            $('#visits_chart_div').html(`
                <p class="w-full h-full m-0 p-0 flex justify-center items-center text-red-500 font-bold text-3xl text-center">No Data To Show</p>
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
                            { calc: "stringify",
                                sourceColumn: 1,
                                type: "string",
                                role: "annotation" },
                            2]);

            let best_saled_books_chart_options = {
                title: "Best Saled Books",
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };

            let best_saled_books_chart = new google.visualization.ColumnChart(document.getElementById("best_saled_books_chart_div"));
            best_saled_books_chart.draw(best_saled_books_chart_view, best_saled_books_chart_options);

        @else
            $("#best_saled_books_chart_div").html(`
                <p class="w-full h-full m-0 p-0 flex justify-center items-center text-red-500 font-bold text-3xl text-center">No Data To Show</p>
            `);
        @endif


        /* Best Saled Books of the Month chart */
        @if ($best_saled_books_of_the_month_chart_data->count() > 0)
            let best_saled_books_of_the_month_chart_data = google.visualization.arrayToDataTable([
                ["Title", "Incomes", { role: 'style' }],
                ...@json($best_saled_books_of_the_month_chart_data)
            ]);

            let best_saled_books_of_the_month_chart_view = new google.visualization.DataView(best_saled_books_of_the_month_chart_data);
            best_saled_books_of_the_month_chart_view.setColumns([0, 1,
                            { calc: "stringify",
                                sourceColumn: 1,
                                type: "string",
                                role: "annotation" },
                            2]);

            let best_saled_books_of_the_month_chart_options = {
                title: "Best Saled Books of the Month",
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };

            let best_saled_books_of_the_month_chart = new google.visualization.ColumnChart(document.getElementById("best_saled_books_of_the_month_chart_div"));
            best_saled_books_of_the_month_chart.draw(best_saled_books_of_the_month_chart_view, best_saled_books_of_the_month_chart_options);
        @else
            $("#best_saled_books_of_the_month_chart_div").html(`
                <p class="w-full h-full m-0 p-0 flex justify-center items-center text-red-500 font-bold text-3xl text-center">No Data To Show</p>
            `);
        @endif


        /* Best Saled Categories chart */
        @if ($best_saled_categories_chart_data->count() > 0)
            let best_saled_categories_chart_data = google.visualization.arrayToDataTable([
                ["Category", "Incomes", { role: 'style' }],
                ...@json($best_saled_categories_chart_data)
            ]);

            let best_saled_categories_chart_view = new google.visualization.DataView(best_saled_categories_chart_data);
            best_saled_categories_chart_view.setColumns([0, 1,
                            { calc: "stringify",
                                sourceColumn: 1,
                                type: "string",
                                role: "annotation" },
                            2]);

            let best_saled_categories_chart_options = {
                title: "Best Saled Categories",
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };

            let best_saled_categories_chart = new google.visualization.ColumnChart(document.getElementById("best_saled_categories_chart_div"));
            best_saled_categories_chart.draw(best_saled_categories_chart_view, best_saled_categories_chart_options);
        @else
            $("#best_saled_categories_chart_div").html(`
                <p class="w-full h-full m-0 p-0 flex justify-center items-center text-red-500 font-bold text-3xl text-center">No Data To Show</p>
            `);
        @endif


        /* Best Saled Categories of the Month chart */
        @if ($best_saled_categories_of_the_month_chart_data->count() > 0)
            let best_saled_categories_of_the_month_chart_data = google.visualization.arrayToDataTable([
                ["Category", "Incomes", { role: 'style' }],
                ...@json($best_saled_categories_of_the_month_chart_data)
            ]);

            let best_saled_categories_of_the_month_chart_view = new google.visualization.DataView(best_saled_categories_of_the_month_chart_data);
            best_saled_categories_of_the_month_chart_view.setColumns([0, 1,
                            { calc: "stringify",
                                sourceColumn: 1,
                                type: "string",
                                role: "annotation" },
                            2]);

            let best_saled_categories_of_the_month_chart_options = {
                title: "Best Saled Categories of the Month",
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };

            let best_saled_categories_of_the_month_chart = new google.visualization.ColumnChart(document.getElementById("best_saled_categories_of_the_month_chart_div"));
            best_saled_categories_of_the_month_chart.draw(best_saled_categories_of_the_month_chart_view, best_saled_categories_of_the_month_chart_options);
        @else
            $("#best_saled_categories_of_the_month_chart_div").html(`
                <p class="w-full h-full m-0 p-0 flex justify-center items-center text-red-500 font-bold text-3xl text-center">No Data To Show</p>
            `);
        @endif


        /* Best Saled Publishers chart */
        @if ($best_saled_publishers_chart_data->count() > 0)
            let best_saled_publishers_chart_data = google.visualization.arrayToDataTable([
                ["Publisher", "Incomes", { role: 'style' }],
                ...@json($best_saled_publishers_chart_data)
            ]);

            let best_saled_publishers_chart_view = new google.visualization.DataView(best_saled_publishers_chart_data);
            best_saled_publishers_chart_view.setColumns([0, 1,
                            { calc: "stringify",
                                sourceColumn: 1,
                                type: "string",
                                role: "annotation" },
                            2]);

            let best_saled_publishers_chart_options = {
                title: "Best Saled Publishers",
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };

            let best_saled_publishers_chart = new google.visualization.ColumnChart(document.getElementById("best_saled_publishers_chart_div"));
            best_saled_publishers_chart.draw(best_saled_publishers_chart_view, best_saled_publishers_chart_options);
        @else
            $("#best_saled_publishers_chart_div").html(`
                <p class="w-full h-full m-0 p-0 flex justify-center items-center text-red-500 font-bold text-3xl text-center">No Data To Show</p>
            `);
        @endif


        /* Best Saled Publishers of the Month chart */
        @if ($best_saled_publishers_of_the_month_chart_data->count() > 0)
            let best_saled_publishers_of_the_month_chart_data = google.visualization.arrayToDataTable([
                ["Publisher", "Incomes", { role: 'style' }],
                ...@json($best_saled_publishers_of_the_month_chart_data)
            ]);

            let best_saled_publishers_of_the_month_chart_view = new google.visualization.DataView(best_saled_publishers_of_the_month_chart_data);
            best_saled_publishers_of_the_month_chart_view.setColumns([0, 1,
                            { calc: "stringify",
                                sourceColumn: 1,
                                type: "string",
                                role: "annotation" },
                            2]);

            let best_saled_publishers_of_the_month_chart_options = {
                title: "Best Saled Publishers of the Month",
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };

            let best_saled_publishers_of_the_month_chart = new google.visualization.ColumnChart(document.getElementById("best_saled_publishers_of_the_month_chart_div"));
            best_saled_publishers_of_the_month_chart.draw(best_saled_publishers_of_the_month_chart_view, best_saled_publishers_of_the_month_chart_options);
        @else
            $("#best_saled_publishers_of_the_month_chart_div").html(`
                <p class="w-full h-full m-0 p-0 flex justify-center items-center text-red-500 font-bold text-3xl text-center">No Data To Show</p>
            `);
        @endif


        /* Best Rated Books chart */
        @if ($best_rated_books_chart_data->count() > 0)
            let best_rated_books_chart_data = google.visualization.arrayToDataTable([
                ["Title", "Rating", { role: 'style' }],
                ...@json($best_rated_books_chart_data)
            ]);

            let best_rated_books_chart_view = new google.visualization.DataView(best_rated_books_chart_data);
            best_rated_books_chart_view.setColumns([0, 1,
                            { calc: "stringify",
                                sourceColumn: 1,
                                type: "string",
                                role: "annotation" },
                            2]);

            let best_rated_books_chart_options = {
                title: "Best Rated Books",
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };

            let best_rated_books_chart = new google.visualization.ColumnChart(document.getElementById("best_rated_books_chart_div"));
            best_rated_books_chart.draw(best_rated_books_chart_view, best_rated_books_chart_options);
        @else
            $("#best_rated_books_chart_div").html(`
                <p class="w-full h-full m-0 p-0 flex justify-center items-center text-red-500 font-bold text-3xl text-center">No Rated Books Yet</p>
            `);
        @endif


        /* Best Rated Books of the Month chart */
        @if ($best_rated_books_of_the_month_chart_data->count() > 0)
            let best_rated_books_of_the_month_chart_data = google.visualization.arrayToDataTable([
                ["Title", "Rating", { role: 'style' }],
                ...@json($best_rated_books_of_the_month_chart_data)
            ]);

            let best_rated_books_of_the_month_chart_view = new google.visualization.DataView(best_rated_books_of_the_month_chart_data);
            best_rated_books_of_the_month_chart_view.setColumns([0, 1,
                            { calc: "stringify",
                                sourceColumn: 1,
                                type: "string",
                                role: "annotation" },
                            2]);

            let best_rated_books_of_the_month_chart_options = {
                title: "Best Rated Books of the Month",
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };

            let best_rated_books_of_the_month_chart = new google.visualization.ColumnChart(document.getElementById("best_rated_books_of_the_month_chart_div"));
            best_rated_books_of_the_month_chart.draw(best_rated_books_of_the_month_chart_view, best_rated_books_of_the_month_chart_options);
        @else
            $('#best_rated_books_of_the_month_chart_div').html(`
                <p class="w-full h-full m-0 p-0 flex justify-center items-center text-red-500 font-bold text-3xl text-center">No Rated Books Yet</p>
            `);
        @endif
    }
</script>

@endsection
