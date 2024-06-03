<?php
namespace App\Http\Controllers;

//import Model "Post
use App\Models\Testimonial;
use Illuminate\Http\Request;
//return type View
use Illuminate\View\View;
//return type redirectResponse
use Illuminate\Http\RedirectResponse;
//import Facade "Storage"
use Illuminate\Support\Facades\Storage;


class TestimonialController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index()
    {
        //get posts
        $ourTestimoni = Testimonial::latest()->paginate(5);

        //render view with posts
        return view('our-testimoni.index', compact('ourTestimoni'));
    }



    public function create(): View
    {
        return view('our-testimoni.create');
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

        // Buat Testimonial
        Testimonial::create([
            'name' => $request->name,
            'description' => $request->description,
            'avatar' => $path_thumb,
            'logo' => $path_icon,
        ]);

        // Redirect ke index
        return redirect()->route('our-testimonis.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }


    public function edit(string $id)
    {
        //get post by ID
        $ourTestimoni = Testimonial::findOrFail($id);

        //render view with post
        return view('our-testimoni.edit', compact('Testimonial'));
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
    $ourTestimoni = Testimonial::findOrFail($id);

    // Periksa apakah thumbnail diunggah
    if ($request->hasFile('avatar')) {
        // Unggah gambar baru untuk thumbnail
        $image_thumb = $request->file('avatar');
        $path_thumb = $image_thumb->storeAs('public/img', $image_thumb->hashName());

        // Hapus thumbnail lama
        if ($ourTestimoni->avatar) {
            Storage::delete('public/img/'.$ourTestimoni->avatar);
        }

        // Perbarui Testimonial dengan gambar thumbnail baru
        $ourTestimoni->avatar = $path_thumb;
    }

    // Periksa apakah ikon diunggah
    if ($request->hasFile('logo')) {
        // Unggah gambar baru untuk ikon
        $image_icon = $request->file('logo');
        $path_icon = $image_icon->storeAs('public/icon', $image_icon->hashName());

        // Hapus ikon lama
        if ($ourTestimoni->icon) {
            Storage::delete('public/icon/'.$ourTestimoni->icon);
        }

        // Perbarui Testimonial dengan gambar ikon baru
        $ourTestimoni->icon = $path_icon;
    }

    // Perbarui Testimonial dengan data lain
    $ourTestimoni->update([
        'name' => $request->name,
        'description' => $request->description,
        'avatar' => $Testimonial->avatar,
        'logo' => $Testimonial->logo,
    ]);

    // Redirect ke index
    return redirect()->route('our-testimoni.index')->with(['success' => 'Data Berhasil Diubah!']);
}

    public function destroy($id)
    {
        $Testimonial = Testimonial::findOrFail($id);
        $Testimonial->delete();

        return redirect()->route('our-testimonis.index')->with('success', 'Hero Section deleted successfully.');
    }
}
