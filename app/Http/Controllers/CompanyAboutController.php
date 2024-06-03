<?php

namespace App\Http\Controllers;

//import Model "Post
use App\Models\CompanyAbout;
use App\Models\CompanyKeypoint;
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
                    'keypoints' => 'nullable|array', // Validasi untuk keypoints
                    'keypoints.*' => 'nullable|string|max:255', // Validasi untuk setiap keypoint
                ]);

                $thumbnailName = null;

                // Upload image jika ada file yang diunggah
                if ($request->hasFile('thumbnail')) {
                    $image = $request->file('thumbnail');
                    $path = $image->storeAs('public/img', $image->hashName());
                }

                // Buat CompanyAbout
                $companyAbout = CompanyAbout::create([
                    'thumbnail' => $path ?? null,
                    'name' => $request->name,
                    'type' => $request->type,
                ]);

                // Buat CompanyKeypoint jika ada
                if ($request->has('keypoints')) {
                    foreach ($request->keypoints as $keypoint) {
                        CompanyKeypoint::create([
                            'company_about_id' => $companyAbout->id,
                            'keypoint' => $keypoint,
                        ]);
                    }
                }

    // Redirect ke index
    return redirect()->route('company-about.index')->with(['success' => 'Data Berhasil Disimpan!']);
}


    public function edit(string $id)
    {
        //get post by ID
        $companyAbout = CompanyAbout::findOrFail($id);
        $keypoints = CompanyKeypoint::where('company_about_id', $id)->get();

        return view('company-about.edit', compact('companyAbout','keypoints'));
    }
    public function update(Request $request, $id): RedirectResponse
        {
            // Validasi form
            $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'thumbnail' => 'nullable|image|mimes:png|max:2048', // Validasi untuk file thumbnail
                'keypoints' => 'nullable|array', // Validasi untuk keypoints
                'keypoints.*' => 'nullable|string|max:255', // Validasi untuk setiap keypoint
            ]);

            // Dapatkan data CompanyAbout berdasarkan ID
            $companyAbout = CompanyAbout::findOrFail($id);

            // Periksa apakah gambar diunggah
            if ($request->hasFile('thumbnail')) {
                // Unggah gambar baru
                $image = $request->file('thumbnail');
                $path = $image->storeAs('public/img', $image->hashName());

                // Hapus gambar lama
                if ($companyAbout->thumbnail) {
                    Storage::delete('/public/img/'.$companyAbout->thumbnail);
                }

                // Perbarui CompanyAbout dengan gambar baru
                $companyAbout->update([
                    'thumbnail' => $path,
                    'name' => $request->name,
                    'type' => $request->type,
                ]);
            } else {
                // Perbarui CompanyAbout tanpa gambar
                $companyAbout->update([
                    'name' => $request->name,
                    'type' => $request->type,
                ]);
            }

            // Update atau buat keypoints baru
            if ($request->has('keypoints')) {
                // Hapus keypoints lama
                CompanyKeypoint::where('company_about_id', $id)->delete();

                // Buat keypoints baru
                foreach ($request->keypoints as $keypoint) {
                    CompanyKeypoint::create([
                        'company_about_id' => $companyAbout->id,
                        'keypoint' => $keypoint,
                    ]);
                }
            }

            // Redirect ke index
            return redirect()->route('company-about.index')->with(['success' => 'Data Berhasil Diubah!']);
        }

    public function destroy($id)
    {
        $heroSection = CompanyAbout::findOrFail($id);
        $heroSection->delete();

        return redirect()->route('company-about.index')->with('success', 'Company About Section deleted successfully.');
    }
}
