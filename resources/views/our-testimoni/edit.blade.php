
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Edit Hero Section') }}
            </h2>
        </x-slot>
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="border-0 rounded shadow-sm card">
                        <div class="card-body">
                            <form action="{{ route('our-testimonis.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label class="font-weight-bold">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $testimonial->name) }}" required>
                                    @error('name')
                                        <div class="mt-2 alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Content</label>
                                    <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description', $testimonial->description) }}" required>
                                    @error('description')
                                        <div class="mt-2 alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Avatar</label>
                                    <input type="file" id="avatar" name="avatar" class="form-control">
                                    @error('avatar')
                                        <div class="mt-2 alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Logo</label>
                                    <input type="file" id="logo" name="logo" class="form-control">
                                    @error('logo')
                                        <div class="mt-2 alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Project Client</label>
                                    <select class="form-control @error('project_client_id') is-invalid @enderror" name="project_client_id" required>
                                        <option value="" disabled>Select a project client</option>
                                        @foreach ($projectClients as $projectClient)
                                            <option value="{{ $projectClient->id }}" {{ $testimonial->project_client_id == $projectClient->id ? 'selected' : '' }}>
                                                {{ $projectClient->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('project_client_id')
                                        <div class="mt-2 alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-md btn-primary">UPDATE TESTIMONIAL</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </x-app-layout>
</body>

