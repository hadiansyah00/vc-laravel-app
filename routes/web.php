<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HeroSectionController;
use App\Http\Controllers\CompanyStatisticController;
use App\Http\Controllers\OurPrincipleController;
use App\Http\Controllers\OurTeamController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyAboutController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ProjectClientController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HeroSectionController::class, 'FrontEnd']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {

    //Hero Sections
    Route::get('hero-sections', [HeroSectionController::class, 'index'])->name('hero-sections.index');
    Route::get('hero-sections/create', [HeroSectionController::class, 'create'])->name('hero-sections.create');
    Route::post('hero-sections', [HeroSectionController::class, 'store'])->name('hero-sections.store');
    Route::get('hero-sections/{heroSection}/edit', [HeroSectionController::class, 'edit'])->name('hero-sections.edit');
    Route::put('hero-sections/{id}', [HeroSectionController::class, 'update'])->name('hero-sections.update');
    Route::delete('hero-sections/{id}', [HeroSectionController::class, 'destroy'])->name('hero-sections.destroy');

    //Company Stats
    Route::get('company-stats', [CompanyStatisticController::class, 'index'])->name('company-stats.index');
    Route::get('company-stats/create', [CompanyStatisticController::class, 'create'])->name('company-stats.create');
    Route::post('company-stats', [CompanyStatisticController::class, 'store'])->name('company-stats.store');
    Route::get('company-stats/{companyStats}/edit', [CompanyStatisticController::class, 'edit'])->name('company-stats.edit');
    Route::put('company-stats/{id}', [CompanyStatisticController::class, 'update'])->name('company-stats.update');
    Route::delete('company-stats/{id}', [CompanyStatisticController::class, 'destroy'])->name('company-stats.destroy');

    //Our Principle
    Route::get('our-principle', [OurPrincipleController::class, 'index'])->name('our-principles.index');
    Route::get('our-principle/create', [OurPrincipleController::class, 'create'])->name('our-principles.create');
    Route::post('our-principle', [OurPrincipleController::class, 'store'])->name('our-principles.store');
    Route::get('our-principle/{ourPrinciple}/edit', [OurPrincipleController::class, 'edit'])->name('our-principles.edit');
    Route::put('our-principle/{id}', [OurPrincipleController::class, 'update'])->name('our-principles.update');
    Route::delete('our-principle/{id}', [OurPrincipleController::class, 'destroy'])->name('our-principles.destroy');

     //Our Team
     Route::get('our-teams', [OurTeamController::class, 'index'])->name('our-teams.index');
     Route::get('our-teams/create', [OurTeamController::class, 'create'])->name('our-teams.create');
     Route::post('our-teams', [OurTeamController::class, 'store'])->name('our-teams.store');
     Route::get('our-teams/{ourTeams}/edit', [OurTeamController::class, 'edit'])->name('our-teams.edit');
     Route::put('our-teams/{id}', [OurTeamController::class, 'update'])->name('our-teams.update');
     Route::delete('our-teams/{id}', [OurTeamController::class, 'destroy'])->name('our-teams.destroy');

     //Our Product
     Route::get('our-products', [ProductController::class, 'index'])->name('our-products.index');
     Route::get('our-products/create', [ProductController::class, 'create'])->name('our-products.create');
     Route::post('our-products', [ProductController::class, 'store'])->name('our-products.store');
     Route::get('our-products/{ourProducts}/edit', [ProductController::class, 'edit'])->name('our-products.edit');
     Route::put('our-products/{id}', [ProductController::class, 'update'])->name('our-products.update');
     Route::delete('our-products/{id}', [ProductController::class, 'destroy'])->name('our-products.destroy');

      //Testimonials
      Route::get('our-testimoni', [TestimonialController::class, 'index'])->name('our-testimoni.index');
      Route::get('our-testimoni/create', [TestimonialController::class, 'create'])->name('our-testimoni.create');
      Route::post('our-testimoni', [TestimonialController::class, 'store'])->name('our-testimoni.store');
      Route::get('our-testimoni/{ourTestimoni}/edit', [TestimonialController::class, 'edit'])->name('our-testimoni.edit');
      Route::put('our-testimoni/{id}', [TestimonialController::class, 'update'])->name('our-testimoni.update');
      Route::delete('our-testimoni/{id}', [TestimonialController::class, 'destroy'])->name('our-testimoni.destroy');

     //Our Client
     Route::get('our-client', [ProjectClientController::class, 'index'])->name('our-client.index');
     Route::get('our-client/create', [ProjectClientController::class, 'create'])->name('our-client.create');
     Route::post('our-client', [ProjectClientController::class, 'store'])->name('our-client.store');
     Route::get('our-client/{ourClient}/edit', [ProjectClientController::class, 'edit'])->name('our-client.edit');
     Route::put('our-client/{id}', [ProjectClientController::class, 'update'])->name('our-client.update');
     Route::delete('our-client/{id}', [ProjectClientController::class, 'destroy'])->name('our-client.destroy');

      //Company About
      Route::get('company-about', [CompanyAboutController::class, 'index'])->name('company-about.index');
      Route::get('company-about/create', [CompanyAboutController::class, 'create'])->name('company-about.create');
      Route::post('company-about', [CompanyAboutController::class, 'store'])->name('company-about.store');
      Route::get('company-about/{companyAbout}/edit', [CompanyAboutController::class, 'edit'])->name('company-about.edit');
      Route::put('company-about/{id}', [CompanyAboutController::class, 'update'])->name('company-about.update');
      Route::delete('company-about/{id}', [CompanyAboutController::class, 'destroy'])->name('company-about.destroy');
});

    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
