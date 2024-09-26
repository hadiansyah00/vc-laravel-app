
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Hero Section List') }}
            </h2>
            <a href="{{ route('hero-sections.create') }}" class="btn btn-primary">
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
                                    <th class="px-4 py-2">Heading</th>
                                    <th class="px-4 py-2">Subheading</th>
                                    <th class="px-4 py-2">Path Video</th>
                                    <th class="px-4 py-2">Banner</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($heroSections as $heroSection)
                                    <tr>
                                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2">{{ $heroSection->heading }}</td>
                                        <td class="px-4 py-2">{{ $heroSection->subheading }}</td>
                                        <td class="px-4 py-2">{{ $heroSection->path_video }}</td>
                                        <td class="text-center">
                                            <img src="{{ Storage::url($heroSection->banner) }}" class="rounded" style="width: 150px">
                                        </td>
                                        <td class="px-4 py-2">
                                            <div class="flex justify-center gap-2">
                                                <a href="{{ route('hero-sections.edit', $heroSection->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <form action="{{ route('hero-sections.destroy', $heroSection->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
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

