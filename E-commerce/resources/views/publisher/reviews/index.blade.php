@extends('layouts.back-office')

@section('content')

@include('layouts.publisher-sidebar')

<!-- Contenu principal -->
<main class="ml-64 p-6">



    <!-- Tableau des Reviews -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold mt-8 mb-4">Liste des Reviews</h2>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3 border">ID</th>
                    <th class="p-3 border">Content</th>
                    <th class="p-3 border">Rate</th>
                    <th class="p-3 border">Reviewed By</th>
                    <th class="p-3 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($reviews->count() > 0)
                    @foreach ($reviews as $review)
                        <tr class="text-center">
                            <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('publisher.reviews.show', $review) }}">#{{ $review->id }}</a></td>
                            <td class="p-3 border">{{ Str::limit($review->content, 15) }}</td>
                            <td class="p-3 border">{{ $review->rate }}</td>
                            <td class="p-3 border">{{ $review->client->name }}</td>
                            <td class="p-3 border">
                                <a href="{{ route('publisher.reviews.show', $review) }}">
                                    <button class="bg-blue-500 text-white px-3 py-1 rounded">Show</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-red-500 text-center py-3 px-6 text-2xl font-bold">No Reviews Yet</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

</main>

@endsection
