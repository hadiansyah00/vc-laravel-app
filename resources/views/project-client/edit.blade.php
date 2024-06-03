<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Edit Our Client') }}
            </h2>
        </x-slot>
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="border-0 rounded shadow-sm card">
                        <div class="card-body">
                            <form action="{{ route('our-client.update', $ourClient->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label class="font-weight-bold">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $ourClient->name) }}">
                                    @error('name')
                                        <div class="mt-2 alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Description</label>
                                    <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description', $ourClient->description) }}">
                                    @error('description')
                                        <div class="mt-2 alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Avatar</label>
                                    <input type="file" id="thumbnail" name="avatar" class="form-control">
                                    @if ($ourClient->avatar)
                                    <img src="{{ Storage::url($ourClient->avatar) }}" alt="Current Thumbnail" class="mt-2" width="150">
                                @endif
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Logo</label>
                                    <input type="file" id="logo" name="logo" class="form-control">
                                    @if ($ourClient->logo)
                                    <img src="{{ Storage::url($ourClient->logo) }}" alt="Current logo" class="mt-2" width="150">
                                @endif
                                </div>

                                <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </x-app-layout>
</body>

