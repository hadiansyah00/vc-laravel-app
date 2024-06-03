
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Create Hero Section') }}
            </h2>
        </x-slot>
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="border-0 rounded shadow-sm card">
                        <div class="card-body">
                            <form action="{{ route('hero-sections.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label class="font-weight-bold">Heading</label>
                                    <input type="text" class="form-control @error('heading') is-invalid @enderror" name="heading" placeholder="Input Heading">
                                    @error('heading')
                                        <div class="mt-2 alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Sub Heading</label>
                                    <input type="text" class="form-control @error('subheading') is-invalid @enderror" name="subheading" placeholder="Input subheading">
                                    @error('subheading')
                                        <div class="mt-2 alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Path Video</label>
                                    <input type="text" class="form-control @error('path_video') is-invalid @enderror" name="path_video" placeholder="Link Video">
                                    @error('path_video')
                                        <div class="mt-2 alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Achievements</label>
                                    <textarea class="form-control @error('achievements') is-invalid @enderror" rows="3" name="achievements" placeholder="Input Achievments"></textarea>
                                    @error('achievements')
                                        <div class="mt-2 alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Banner</label>
                                    <input type="file" id="banner" name="banner" class="form-control">

                                </div>

                                <button type="submit" class="mx-auto btn btn-md btn-primary">Simpan Data</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </x-app-layout>
</body>

