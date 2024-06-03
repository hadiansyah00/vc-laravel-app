
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
                            <form action="{{ route('company-about.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="font-weight-bold">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="mt-2 alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Type</label>
                                    <input type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" required>
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
                                    <input type="text" class="form-control @error('keypoints.0') is-invalid @enderror" name="keypoints[]" placeholder="Keypoint 1" required>
                                    <input type="text" class="form-control mt-2 @error('keypoints.1') is-invalid @enderror" name="keypoints[]" placeholder="Keypoint 2" required>
                                    <input type="text" class="form-control mt-2 @error('keypoints.2') is-invalid @enderror" name="keypoints[]" placeholder="Keypoint 3" required>
                                    @error('keypoints.*')
                                        <div class="mt-2 alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-md btn-primary">CREATE</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>

