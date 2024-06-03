<?php

namespace App\Http\Controllers;

//import Model "Post
use App\Models\HeroSection;
use App\Models\CompanyAbout;
use App\Models\CompanyKeypoint;

use Illuminate\Http\Request;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

class HeroSectionController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get posts
        $heroSections = HeroSection::latest()->paginate(5);

        //render view with posts
        return view('hero-sections.index', compact('heroSections'));
    }
    public function FrontEnd() //Halaman Frontend nya
    {
        //Tampilkan halaman view nya
        $companyAbout = CompanyAbout::latest()->paginate(5);
        $frontendHero = HeroSection::latest()->paginate(5);
        $keypoints = CompanyKeypoint::all();
        //render view with posts
        return view('frontend-home', compact('frontendHero','companyAbout','keypoints'));
    }



    public function create(): View
    {
        return view('hero-sections.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi form
        $request->validate([
            'heading' => 'required|string|max:255',
            'subheading' => 'required|string|max:255',
            'path_video' => 'required|string|max:255',
            'banner' => 'nullable|image|mimes:png|max:2048', // Validasi untuk file banner
            'achievements' => 'required|string',
        ]);

        $bannerName = null;

        // Upload image jika ada file yang diunggah
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $path = $image->storeAs('public/img', $image->hashName());
        }

        // Buat HeroSection
        HeroSection::create([
            'banner' => $path,
            'heading' => $request->heading,
            'subheading' => $request->subheading,
            'path_video' => $request->path_video,
            'achievements' => $request->achievements,
        ]);

        // Redirect ke index
        return redirect()->route('hero-sections.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id)
    {
        //get post by ID
        $heroSection = HeroSection::findOrFail($id);

        //render view with post
        return view('hero-sections.edit', compact('heroSection'));
    }
    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi form
        $this->validate($request, [
            'heading' => 'required|string|max:255',
            'subheading' => 'required|string|max:255',
            'path_video' => 'required|string|max:255',
            'banner' => 'nullable|image|mimes:png|max:2048', // validasi untuk file banner
            'achievements' => 'required|string',
        ]);

        // Dapatkan data HeroSection berdasarkan ID
        $heroSection = HeroSection::findOrFail($id);

        // Periksa apakah gambar diunggah
        if ($request->hasFile('banner')) {
            // Unggah gambar baru
            $image = $request->file('banner');
            $path = $image->storeAs('public/img', $image->hashName());

            // Hapus gambar lama
            if ($heroSection->banner) {
                Storage::delete('/public'.$heroSection->banner);
            }

            // Perbarui HeroSection dengan gambar baru
            $heroSection->update([
                'banner' => $path,
                'heading' => $request->heading,
                'subheading' => $request->subheading,
                'path_video' => $request->path_video,
                'achievements' => $request->achievements,
            ]);
        } else {
            // Perbarui HeroSection tanpa gambar
            $heroSection->update([
                'heading' => $request->heading,
                'subheading' => $request->subheading,
                'path_video' => $request->path_video,
                'achievements' => $request->achievements,
            ]);
        }

        // Redirect ke index
        return redirect()->route('hero-sections.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id)
    {
        $heroSection = HeroSection::findOrFail($id);
        $heroSection->delete();

        return redirect()->route('hero-sections.index')->with('success', 'Hero Section deleted successfully.');
    }
}
