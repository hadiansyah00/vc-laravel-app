
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
                            <form action="{{ route('company-about.update', $companyAbout->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label class="font-weight-bold">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $companyAbout->name) }}" required>
                                    @error('name')
                                        <div class="mt-2 alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Type</label>
                                    <input type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type', $companyAbout->type) }}" required>
                                    @error('type')
                                        <div class="mt-2 alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Thumbnail</label>
                                    <input type="file" id="thumbnail" name="thumbnail" class="form-control">
                                    @error('thumbnail')
                                        <div class="mt-2 alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Keypoints</label>
                                    @foreach ($keypoints as $keypoint)
                                        <input type="text" class="form-control mt-2 @error('keypoints.*') is-invalid @enderror" name="keypoints[]" value="{{ old('keypoints.*', $keypoint->keypoint) }}" placeholder="Keypoint">
                                    @endforeach
                                    <input type="text" class="form-control mt-2 @error('keypoints.*') is-invalid @enderror" name="keypoints[]" placeholder="New Keypoint" required>
                                    @error('keypoints.*')
                                        <div class="mt-2 alert alert-danger">{{ $message }}</div>
                                    @enderror
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

