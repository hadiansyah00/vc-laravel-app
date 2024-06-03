
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
                            <form action="{{ route('hero-sections.update', $heroSection->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label class="font-weight-bold">Heading</label>
                                    <input type="text" class="form-control @error('heading') is-invalid @enderror" name="heading" value="{{ old('heading', $heroSection->heading) }}">
                                    @error('heading')
                                        <div class="mt-2 alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Sub Heading</label>
                                    <input type="text" class="form-control @error('subheading') is-invalid @enderror" name="subheading" value="{{ old('subheading', $heroSection->subheading) }}" placeholder="Masukkan subheading">
                                    @error('subheading')
                                        <div class="mt-2 alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Path Video</label>
                                    <input type="text" class="form-control @error('path_video') is-invalid @enderror" name="path_video" value="{{ old('path_video', $heroSection->path_video) }}">
                                    @error('path_video')
                                        <div class="mt-2 alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Achievements</label>
                                    <textarea class="form-control @error('achievements') is-invalid @enderror" rows="3" name="achievements">{{ old('achievements', $heroSection->achievements) }}</textarea>
                                    @error('achievements')
                                        <div class="mt-2 alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Banner</label>
                                    <input type="file" id="banner" name="banner" class="form-control">
                                    @if ($heroSection->banner)
                                    <img src="{{ Storage::url($heroSection->banner) }}" alt="Current Banner" class="mt-2" width="150">
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

