
<section class="dark:bg-gray-100 dark:text-gray-800">
    <div class="container flex flex-col justify-center p-6 mx-auto sm:py-12 lg:py-24 lg:flex-row lg:justify-between">
        @foreach($frontendHero as $hero)
            <div class="flex flex-col justify-center p-6 text-center rounded-sm lg:max-w-md xl:max-w-lg lg:text-left">
                <h1 class="text-5xl font-bold leading-none">{{ $hero->heading }}
                    <span class="dark:text-gray-600">{{ $hero->subheading }}</span>
                </h1>
                <p class="mt-6 mb-8 text-lg sm:mb-12">{{ $hero->achievements }}
                    <br class="hidden md:inline lg:hidden">{{ $hero->additional_info }}
                </p>
                <div class="flex flex-col space-y-4 sm:items-center sm:justify-center sm:flex-row sm:space-y-0 sm:space-x-4 lg:justify-start">
                    <a rel="noopener noreferrer" href="{{ $hero->primary_link }}" class="px-8 py-3 text-lg font-semibold rounded dark:bg-violet-600 dark:text-gray-50">Tentang SBH</a>
                    <a rel="noopener noreferrer" href="{{ $hero->secondary_link }}" class="px-8 py-3 text-lg font-semibold border rounded dark:border-gray-800">Isi Kusioner</a>
                </div>
            </div>
            <div class="flex items-center justify-center p-6 mt-8 lg:mt-0 h-72 sm:h-80 lg:h-96 xl:h-112 2xl:h-128">
                <img src="{{ Storage::url($hero->banner) }}" alt="{{ $hero->banner }}" class="object-contain h-72 sm:h-80 lg:h-96 xl:h-112 2xl:h-128">
            </div>

        @endforeach
    </div>
    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $frontendHero->links() }}
    </div>
</section>
