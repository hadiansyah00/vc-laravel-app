
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
                            <form action="{{ route('our-teams.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label class="font-weight-bold">Name</label>
                                    <input type="text" class="form-control" @error('name') is-invalid @enderror name="name" placeholder="Input Name">
                                    @error('name')
                                        <div class="mt-2 alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Jabatan</label>
                                    <input type="text" class="form-control" @error('role') is-invalid @enderror name="role" placeholder="Input Role">
                                    @error('role')
                                        <div class="mt-2 alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Image</label>
                                    <input type="file" id="image" name="image" class="form-control">

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

