<table class="w-full border-collapse">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-3 border">Nom</th>
            <th class="p-3 border">Description</th>
            <th class="p-3 border">Price</th>
            <th class="p-3 border">Stock</th>
            <th class="p-3 border">Category</th>
            <th class="p-3 border">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if ($books->count() > 0)
            @foreach ($books as $book)
                <tr class="text-center">
                    <td class="p-3 border underline italic hover:text-blue-400"><a
                            href="{{ route('publisher.books.show', $book->uuid) }}">{{ $book->name }}</a></td>
                    <td class="p-3 border truncate w-40">{{ Str::limit($book->description, 15) }}</td>
                    <td class="p-3 border text-green-600 font-bold">${{ $book->price }}</td>
                    <td class="p-3 border text-blue-500 font-semibold">{{ $book->stock }}</td>
                    <td class="p-3 border">{{ $book->category->name }}</td>
                    <td class="p-3 border">
                        <div class="flex justify-center items-center space-x-2">
                            <a class="bg-blue-500 text-white px-3 py-1 rounded"
                                href="{{ route('publisher.books.edit', $book->uuid) }}">Update</a>
                            <form id="delete-form-{{ $book->uuid }}"
                                action="{{ route('publisher.books.delete', $book->uuid) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button id="delete-{{ $book->uuid }}" type="submit"
                                    class="bg-red-500 text-white px-3 py-1 rounded"
                                    onclick="showDeleteConfirmation(event, '{{ $book->uuid }}')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" class="text-red-500 text-center py-3 px-6 text-2xl font-bold">No Books Yet</td>
            </tr>
        @endif
    </tbody>
</table>
<div id="pagination" class="mt-4">
    {{ $books->links() }}
</div>
