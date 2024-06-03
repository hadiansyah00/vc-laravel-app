
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Hero Section List') }}
            </h2>
            <a href="{{ route('our-principles.create') }}" class="btn btn-primary">
                Add New
            </a>
        </div>
    </x-slot>
    <div class="py-5">
        <div class="container">
            <div class="shadow-sm card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-warning">
                                <tr>
                                    <th class="px-4 py-2">No</th>
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Subtitle</th>
                                    <th class="px-4 py-2">Thumbnail</th>
                                    <th class="px-4 py-2">Icon</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ourPrinciples as $row)
                                    <tr>
                                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2">{{ $row->name }}</td>
                                        <td class="px-4 py-2">{{ $row->subtitle }}</td>
                                        <td class="text-center">
                                            <img src="{{ Storage::url($row->thumbnail) }}" class="rounded" style="width: 150px">
                                        </td>
                                        <td class="text-center">
                                            <img src="{{ Storage::url($row->icon) }}" class="rounded" style="width: 150px">
                                        </td>
                                        <td class="px-4 py-2">
                                            <div class="flex justify-center gap-2">
                                                <a href="{{ route('our-principles.edit', $row->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <form action="{{ route('our-principles.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

