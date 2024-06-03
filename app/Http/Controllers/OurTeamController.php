<?php

namespace App\Http\Controllers;

//import Model "Post
use App\Models\OurTeam;
use Illuminate\Http\Request;
//return type View
use Illuminate\View\View;
//return type redirectResponse
use Illuminate\Http\RedirectResponse;
//import Facade "Storage"
use Illuminate\Support\Facades\Storage;


class OurTeamController extends Controller
{
    /**
     * index
     *
     * @return View
     */

    public function index(): View
    {
        //get posts
        $ourTeams = OurTeam::latest()->paginate(5);

        //render view with posts
        return view('our-teams.index', compact('ourTeams'));
    }


    public function create(): View
    {
        return view('our-teams.create');
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
            'role' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048', // Validasi untuk file icon
        ]);

        $bannerName = null;

        // Upload image jika ada file yang diunggah
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->storeAs('public/img', $image->hashName());
        }

        // Buat OurTeam
        OurTeam::create([
            'image' => $path,
            'name' => $request->name,
            'role' => $request->role,
        ]);

        // Redirect ke index
        return redirect()->route('our-teams.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id)
    {
        //get post by ID
        $ourTeams = OurTeam::findOrFail($id);

        //render view with post
        return view('our-teams.edit', compact('ourTeams'));
    }
    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi form
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048', // Validasi untuk file icon
        ]);

        // Dapatkan data OurTeam berdasarkan ID
        $ourTeam = OurTeam::findOrFail($id);

        // Periksa apakah gambar diunggah
        if ($request->hasFile('image')) {
            // Unggah gambar baru
            $image = $request->file('image');
            $path = $image->storeAs('public/img', $image->hashName());

            // Hapus gambar lama
            if ($ourTeam->banner) {
                Storage::delete('/public/img'.$ourTeam->banner);
            }

            // Perbarui OurTeam dengan gambar baru
            $ourTeam->update([
                'image' => $path,
                'name' => $request->name,
                'role' => $request->role,
            ]);
        } else {
            // Perbarui OurTeam tanpa gambar
            $ourTeam->update([
                'name' => $request->name,
                'role' => $request->role,
            ]);
        }

        // Redirect ke index
        return redirect()->route('our-teams.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id)
    {
        $ourTeam = OurTeam::findOrFail($id);
        $ourTeam->delete();

        return redirect()->route('our-teams.index')->with('success', 'Company Statistics Section deleted successfully.');
    }
}
