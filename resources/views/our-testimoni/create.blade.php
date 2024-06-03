
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Create Company About') }}
            </h2>
        </x-slot>
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="border-0 rounded shadow-sm card">
                        <div class="card-body">
                            <form action="{{ route('our-testimoni.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-group">
                                        <label class="font-weight-bold">Author</label>
                                        <input type="text" class="form-control @error('author') is-invalid @enderror" name="author" value="{{ old('author') }}" required>
                                        @error('author')
                                            <div class="mt-2 alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Content</label>
                                    <textarea type="text" class="form-control @error('content') is-invalid @enderror" name="content" value="{{ old('content') }}" required></textarea>
                                    @error('content')
                                        <div class="mt-2 alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">thumbnail</label>
                                    <input type="file" id="thumbnail" name="thumbnail" class="form-control">
                                    @error('thumbnail')
                                        <div class="mt-2 alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Project Client</label>
                                    <select class="form-control @error('project_client_id') is-invalid @enderror" name="project_client_id" required>
                                        @foreach ($projectClients as $projectClient)
                                            <option value="{{ $projectClient->id }}">{{ $projectClient->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('project_client_id')
                                        <div class="mt-2 alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-md btn-primary">ADD TESTIMONIAL</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>

