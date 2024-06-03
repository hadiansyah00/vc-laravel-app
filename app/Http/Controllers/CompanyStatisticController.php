<?php

namespace App\Http\Controllers;

//import Model "Post
use App\Models\CompanyStatistic;
use Illuminate\Http\Request;
//return type View
use Illuminate\View\View;
//return type redirectResponse
use Illuminate\Http\RedirectResponse;
//import Facade "Storage"
use Illuminate\Support\Facades\Storage;


class CompanyStatisticController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get posts
        $companyStatistics = CompanyStatistic::latest()->paginate(5);

        //render view with posts
        return view('company-stats.index', compact('companyStatistics'));
    }



    public function create(): View
    {
        return view('company-stats.create');
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
            'goal' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048', // Validasi untuk file icon
        ]);

        $bannerName = null;

        // Upload image jika ada file yang diunggah
        if ($request->hasFile('icon')) {
            $image = $request->file('icon');
            $path = $image->storeAs('public/icon', $image->hashName());
        }

        // Buat CompanyStatistic
        CompanyStatistic::create([
            'icon' => $path,
            'name' => $request->name,
            'goal' => $request->goal,
        ]);

        // Redirect ke index
        return redirect()->route('company-stats.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id)
    {
        //get post by ID
        $companyStatistics = CompanyStatistic::findOrFail($id);

        //render view with post
        return view('company-stats.edit', compact('companyStatistics'));
    }
    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi form
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'goal' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048', // Validasi untuk file icon
        ]);

        // Dapatkan data CompanyStatistic berdasarkan ID
        $companyStatistic = CompanyStatistic::findOrFail($id);

        // Periksa apakah gambar diunggah
        if ($request->hasFile('icon')) {
            // Unggah gambar baru
            $image = $request->file('icon');
            $path = $image->storeAs('public/icon', $image->hashName());

            // Hapus gambar lama
            if ($companyStatistic->banner) {
                Storage::delete('/public/icon'.$companyStatistic->banner);
            }

            // Perbarui CompanyStatistic dengan gambar baru
            $companyStatistic->update([
                'icon' => $path,
                'name' => $request->name,
                'goal' => $request->goal,
            ]);
        } else {
            // Perbarui CompanyStatistic tanpa gambar
            $companyStatistic->update([
                'name' => $request->name,
                'goal' => $request->goal,
            ]);
        }

        // Redirect ke index
        return redirect()->route('company-stats.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id)
    {
        $companyStatistic = CompanyStatistic::findOrFail($id);
        $companyStatistic->delete();

        return redirect()->route('company-stats.index')->with('success', 'Company Statistics Section deleted successfully.');
    }
}
