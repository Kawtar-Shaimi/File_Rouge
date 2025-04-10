@extends('layouts.back-office')

@section('title', 'Review Informations')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content')
    @include('layouts.publisher-sidebar')

    <div class="container w-5/6 ms-auto p-6">
        <div class=" max-w-4xl mx-auto">
            <div class="mt-10">
                <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Review Informations</h2>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <table class="w-full border-collapse">
                        <tr>
                            <td class="p-3 border">Review ID:</td>
                            <td class="p-3 border underline italic hover:text-blue-400"><a
                                    href="{{ route('publisher.reviews.show', $review->uuid) }}">#{{ $review->uuid }}</a></td>
                        </tr>
                        <tr>
                            <td class="p-3 border">Review Content:</td>
                            <td class="p-3 border">{{ $review->content }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">Review Rate:</td>
                            <td class="p-3 border">{{ $review->rate }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">Reviewed By:</td>
                            <td class="p-3 border">{{ $review->client->name }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">Creation Date:</td>
                            <td class="p-3 border">{{ $review->created_at }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">Last Update:</td>
                            <td class="p-3 border">{{ $review->updated_at }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
