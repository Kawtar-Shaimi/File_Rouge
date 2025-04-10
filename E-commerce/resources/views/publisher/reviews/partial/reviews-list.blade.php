<table class="w-full border-collapse">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-3 border">ID</th>
            <th class="p-3 border">Reviewed Book</th>
            <th class="p-3 border">Reviewed By</th>
            <th class="p-3 border">Content</th>
            <th class="p-3 border">Rate</th>
            <th class="p-3 border">Action</th>
        </tr>
    </thead>
    <tbody>
        @if ($reviews->count() > 0)
            @foreach ($reviews as $review)
                <tr class="text-center">
                    <td class="p-3 border underline italic hover:text-blue-400"><a
                            href="{{ route('publisher.reviews.show', $review->uuid) }}">#{{ $review->uuid }}</a></td>
                    <td class="p-3 border">{{ $review->book->name }}</td>
                    <td class="p-3 border">{{ $review->client->name }}</td>
                    <td class="p-3 border">{{ Str::limit($review->content, 15) }}</td>
                    <td class="p-3 border">{{ $review->rate }}</td>
                    <td class="p-3 border">
                        <div class="flex justify-center items-center space-x-2">
                            <a href="{{ route('publisher.reviews.show', $review->uuid) }}"
                                class="px-4 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition duration-300">Show</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" class="text-red-500 text-center py-3 px-6 text-2xl font-bold">No Reviews Yet</td>
            </tr>
        @endif
    </tbody>
</table>
<div id="pagination" class="mt-4">
    {{ $reviews->links() }}
</div>
