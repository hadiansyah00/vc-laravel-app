<?php
namespace App\Http\Controllers;

//import Model "Post
use App\Models\ProjectClient;
use Illuminate\Http\Request;
//return type View
use Illuminate\View\View;
//return type redirectResponse
use Illuminate\Http\RedirectResponse;
//import Facade "Storage"
use Illuminate\Support\Facades\Storage;


class ProjectClientController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index()
    {
        //get posts
        $ourClient = ProjectClient::latest()->paginate(5);

        //render view with posts
        return view('project-client.index', compact('ourClient'));
    }



    public function create(): View
    {
        return view('project-client.create');
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
            'description' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:png|max:2048', // Validasi untuk file Thumbnail
            'logo' => 'nullable|image|mimes:png|max:2048', // Validasi untuk file ICON
        ]);

        $path_thumb = null;
        $path_icon = null;

        // Upload thumbnail jika ada file yang diunggah
        if ($request->hasFile('avatar')) {
            $image_thumb = $request->file('avatar');
            $path_thumb = $image_thumb->storeAs('public/img', $image_thumb->hashName());
        }

        // Upload icon jika ada file yang diunggah
        if ($request->hasFile('logo')) {
            $image_icon = $request->file('logo');
            $path_icon = $image_icon->storeAs('public/icon', $image_icon->hashName());
        }

        // Buat ProjectClient
        ProjectClient::create([
            'name' => $request->name,
            'description' => $request->description,
            'avatar' => $path_thumb,
            'logo' => $path_icon,
        ]);

        // Redirect ke index
        return redirect()->route('our-client.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }


    public function edit(string $id)
    {
        //get post by ID
        $ourClient = ProjectClient::findOrFail($id);

        //render view with post
        return view('project-client.edit', compact('ourClient'));
    }
    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi form
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:png|max:2048', // Validasi untuk file Thumbnail
            'logo' => 'nullable|image|mimes:png|max:2048', // Validasi untuk file ICON
        ]);

        // Dapatkan data Testimonial berdasarkan ID
        $ourClient = ProjectClient::findOrFail($id);

        // Periksa apakah thumbnail diunggah
        if ($request->hasFile('avatar')) {
            // Unggah gambar baru untuk thumbnail
            $image_thumb = $request->file('avatar');
            $path_thumb = $image_thumb->storeAs('public/img', $image_thumb->hashName());

            // Hapus thumbnail lama
            if ($ourClient->avatar) {
                Storage::delete('public/img/'.$ourClient->avatar);
            }

            // Perbarui Testimonial dengan gambar thumbnail baru
            $ourClient->avatar = $path_thumb;
        }

    // Periksa apakah ikon diunggah
    if ($request->hasFile('logo')) {
        // Unggah gambar baru untuk ikon
        $image_icon = $request->file('logo');
        $path_icon = $image_icon->storeAs('public/icon', $image_icon->hashName());

        // Hapus ikon lama
        if ($ourClient->logo) {
            Storage::delete('public/icon/'.$ourClient->logo);
        }

        // Perbarui Project Client dengan gambar logo baru
        $ourClient->logo = $path_icon;
    }

    // Perbarui Testimonial dengan data lain
    $ourClient->update([
        'name' => $request->name,
        'description' => $request->description,

    ]);

    // Redirect ke index
    return redirect()->route('our-client.index')->with(['success' => 'Data Berhasil Diubah!']);
}

    public function destroy($id)
    {
        $ourClient = ProjectClient::findOrFail($id);
        $ourClient->delete();

        return redirect()->route('our-client.index')->with('success', 'Project Client Section deleted successfully.');
    }
}
