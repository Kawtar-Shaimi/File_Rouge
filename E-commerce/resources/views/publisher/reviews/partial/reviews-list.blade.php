<table class="w-full border-collapse">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-3 border">Reviewed Book</th>
            <th class="p-3 border">Reviewed By</th>
            <th class="p-3 border">Content</th>
            <th class="p-3 border">Rate</th>
        </tr>
    </thead>
    <tbody>
        @if ($reviews->count() > 0)
            @foreach ($reviews as $review)
                <tr class="text-center">
                    <td class="p-3 border">{{ $review->book->name }}</td>
                    <td class="p-3 border">{{ $review->client->name }}</td>
                    <td class="p-3 border">{{ Str::limit($review->content, 15) }}</td>
                    <td class="p-3 border">{{ $review->rate }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4" class="text-red-500 text-center py-3 px-6 text-2xl font-bold">No Reviews Yet</td>
            </tr>
        @endif
    </tbody>
</table>
<div id="pagination" class="mt-4">
    {{ $reviews->links() }}
</div>