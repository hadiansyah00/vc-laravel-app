
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Create Our Principle') }}
            </h2>
        </x-slot>
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="border-0 rounded shadow-sm card">
                        <div class="card-body">
                            <form action="{{ route('our-principles.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label class="font-weight-bold">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Input name">
                                    @error('name')
                                        <div class="mt-2 alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Subtitle</label>
                                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror" name="subtitle" placeholder="Input subheading">
                                    @error('subtitle')
                                        <div class="mt-2 alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Thumbnail</label>
                                    <input type="file" id="thumbnail" name="thumbnail" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Icon</label>
                                    <input type="file" id="icon" name="icon" class="form-control">
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

