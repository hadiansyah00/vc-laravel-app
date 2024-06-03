<?php

namespace App\Http\Controllers;

//import Model "Post
use App\Models\CompanyAbout;

use Illuminate\Http\Request;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

class CompanyAboutController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get posts
        $companyAbout = CompanyAbout::latest()->paginate(5);

        //render view with posts
        return view('company-about.index', compact('companyAbout'));
    }



    public function create(): View
    {
        return view('company-about.create');
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
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:png|max:2048', // Validasi untuk file thumbnail

        ]);

        $thumbnailName = null;

        // Upload image jika ada file yang diunggah
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $path = $image->storeAs('public/img', $image->hashName());
        }

        // Buat CompanyAbout
        CompanyAbout::create([
            'thumbnail' => $path,
            'name' => $request->name,
            'type' => $request->type,
        ]);

        // Redirect ke index
        return redirect()->route('company-about.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id)
    {
        //get post by ID
        $heroSection = CompanyAbout::findOrFail($id);

        //render view with post
        return view('company-about.edit', compact('heroSection'));
    }
    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi form
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:png|max:2048', // validasi untuk file thumbnail
        ]);

        // Dapatkan data CompanyAbout berdasarkan ID
        $companyAboout = CompanyAbout::findOrFail($id);

        // Periksa apakah gambar diunggah
        if ($request->hasFile('thumbnail')) {
            // Unggah gambar baru
            $image = $request->file('thumbnail');
            $path = $image->storeAs('public/img', $image->hashName());

            // Hapus gambar lama
            if ($companyAboout->thumbnail) {
                Storage::delete('/public'.$companyAbout->thumbnail);
            }

            // Perbarui HeroSection dengan gambar baru
            $heroSection->update([
                'thumbnail' => $path,
                'name' => $request->heading,
                'type' => $request->subheading,

            ]);
        } else {
            // Perbarui HeroSection tanpa gambar
            $heroSection->update([
                'name' => $request->heading,
                'type' => $request->subheading,
            ]);
        }

        // Redirect ke index
        return redirect()->route('company-about.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id)
    {
        $heroSection = HeroSection::findOrFail($id);
        $heroSection->delete();

        return redirect()->route('company-about.index')->with('success', 'Company About Section deleted successfully.');
    }
}
