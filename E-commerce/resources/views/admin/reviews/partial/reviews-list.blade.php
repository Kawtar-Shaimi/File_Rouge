<table class="w-full border-collapse">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-3 border">ID</th>
            <th class="p-3 border">Content</th>
            <th class="p-3 border">Rate</th>
            <th class="p-3 border">Reviewed By</th>
            <th class="p-3 border">Reviewed Book</th>
            <th class="p-3 border">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if ($reviews->count() > 0)
            @foreach ($reviews as $review)
                <tr class="text-center">
                    <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.reviews.show', $review->uuid) }}">#{{ $review->uuid }}</a></td>
                    <td class="p-3 border">{{ Str::limit($review->content, 15) }}</td>
                    <td class="p-3 border">{{ $review->rate }}</td>
                    <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.users.show', $review->client->uuid) }}">#{{ $review->client->name }}</a></td>
                    <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.books.show', $review->book->uuid) }}">{{ $review->book->name }}</a></td>
                    <td class="p-3 border">
                        <form action="{{ route('admin.reviews.delete', $review->uuid) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                        </form>
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
<div id="pagination" class="mt-4">
    {{ $reviews->links() }}
</div>
