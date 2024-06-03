<!-- resources/views/sections/hero.blade.php -->
<section class="bg-gradient-to-r from-orange-400 to-white dark:text-gray-800">
    <div class="container flex flex-col justify-center p-6 mx-auto sm:py-12 lg:py-24">
        @foreach($companyAbout as $hero)
            <div class="flex flex-col lg:flex-row justify-between items-center p-6 text-center lg:text-left mb-8">
                <div class="flex flex-col justify-center lg:w-1/2">
                    <h1 class="text-5xl font-bold leading-none">{{ $hero->type }}</h1>
                    <h2 class="mt-2 text-xl font-semibold">{{ $hero->name }}</h2>
                    <div class="mt-4 mb-8 text-lg">
                        @php
                            $keypointsList = $keypoints->where('company_about_id', $hero->id);
                        @endphp
                        @if($keypointsList->isEmpty())
                            <p>No Keypoints</p>
                        @else
                            <ul class="list-none">
                                @foreach($keypointsList as $keypoint)
                                    <li class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>{{ $keypoint->keypoint }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="flex items-center justify-center lg:w-1/2">
                    <img src="{{ Storage::url($hero->thumbnail) }}" alt="{{ $hero->name }}" class="object-contain h-48 w-full">
                </div>
            </div>
        @endforeach
    </div>
</section>
