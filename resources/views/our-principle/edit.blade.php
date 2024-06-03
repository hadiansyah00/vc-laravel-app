<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Edit Our Principle') }}
            </h2>
        </x-slot>
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="border-0 rounded shadow-sm card">
                        <div class="card-body">
                            <form action="{{ route('our-principles.update', $ourPrinciple->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label class="font-weight-bold">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $ourPrinciple->name) }}">
                                    @error('name')
                                        <div class="mt-2 alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Subtitle</label>
                                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror" name="subtitle" value="{{ old('subtitle', $ourPrinciple->subtitle) }}">
                                    @error('subtitle')
                                        <div class="mt-2 alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Thumbnail</label>
                                    <input type="file" id="thumbnail" name="thumbnail" class="form-control">
                                    @if ($ourPrinciple->thumbnail)
                                    <img src="{{ Storage::url($ourPrinciple->thumbnail) }}" alt="Current Thumbnail" class="mt-2" width="150">
                                @endif
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Icon</label>
                                    <input type="file" id="icon" name="icon" class="form-control">
                                    @if ($ourPrinciple->icon)
                                    <img src="{{ Storage::url($ourPrinciple->icon) }}" alt="Current icon" class="mt-2" width="150">
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

