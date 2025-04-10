<table class="w-full border-collapse">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-3 border">ID</th>
            <th class="p-3 border">Name</th>
            <th class="p-3 border">Description</th>
            <th class="p-3 border">Created By</th>
            <th class="p-3 border">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if ($categories->count() > 0)
            @foreach ($categories as $category)
                <tr class="text-center">
                    <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.categories.show', $category->uuid) }}">#{{ $category->uuid }}</a></td>
                    <td class="p-3 border">{{ $category->name }}</td>
                    <td class="p-3 border">{{ Str::limit($category->description, 15) }}</td>
                    <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.users.show', $category->admin->uuid) }}">{{ $category->admin->name }}</td>
                    <td class="p-3 border">
                        <div class="flex justify-center items-center space-x-2">
                            <button class="bg-blue-500 text-white px-3 py-1 rounded"><a href="{{ route('admin.categories.edit', $category->uuid) }}">Update</a></button>
                            <form id="delete-form-{{ $category->uuid }}" action="{{ route('admin.categories.delete', $category->uuid) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button id="delete-{{ $category->uuid }}" type="submit" class="bg-red-500 text-white px-3 py-1 rounded" onclick="showDeleteConfirmation(event, '{{ $category->uuid }}')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4" class="text-red-500 text-center py-3 px-6 text-2xl font-bold">No Categories Yet</td>
            </tr>
        @endif
    </tbody>
</table>
<div id="pagination" class="mt-4">
    {{ $categories->links() }}
</div>
