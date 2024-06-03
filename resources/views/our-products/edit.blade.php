
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
                            <form action="{{ route('our-products.update', $ourProducts->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label class="font-weight-bold">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $ourProducts->name) }}">
                                    @error('name')
                                        <div class="mt-2 alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Description</label>
                                    <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description', $ourProducts->description) }}" >
                                    @error('description')
                                        <div class="mt-2 alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Tagline</label>
                                    <input type="text" class="form-control @error('tagline') is-invalid @enderror" name="tagline" value="{{ old('tagline', $ourProducts->tagline) }}" >
                                    @error('tagline')
                                        <div class="mt-2 alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Price</label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $ourProducts->price) }}" >
                                    @error('price')
                                        <div class="mt-2 alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Image</label>
                                    <input type="file" id="thumbnail" name="thumbnail" class="form-control">
                                    @if ($ourProducts->thumbnail)
                                    <img src="{{ Storage::url($ourProducts->thumbnail) }}" alt="Current thumbnail" class="mt-2" width="150">
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

