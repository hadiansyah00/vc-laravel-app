<?php
namespace App\Http\Controllers;

//import Model "Post
use App\Models\OurPrinciple;
use Illuminate\Http\Request;
//return type View
use Illuminate\View\View;
//return type redirectResponse
use Illuminate\Http\RedirectResponse;
//import Facade "Storage"
use Illuminate\Support\Facades\Storage;


class OurPrincipleController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index()
    {
        //get posts
        $ourPrinciples = OurPrinciple::latest()->paginate(5);

        //render view with posts
        return view('our-principle.index', compact('ourPrinciples'));
    }



    public function create(): View
    {
        return view('our-principle.create');
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
            'subtitle' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:png|max:2048', // Validasi untuk file Thumbnail
            'icon' => 'nullable|image|mimes:png|max:2048', // Validasi untuk file ICON
        ]);

        $path_thumb = null;
        $path_icon = null;

        // Upload thumbnail jika ada file yang diunggah
        if ($request->hasFile('thumbnail')) {
            $image_thumb = $request->file('thumbnail');
            $path_thumb = $image_thumb->storeAs('public/img', $image_thumb->hashName());
        }

        // Upload icon jika ada file yang diunggah
        if ($request->hasFile('icon')) {
            $image_icon = $request->file('icon');
            $path_icon = $image_icon->storeAs('public/icon', $image_icon->hashName());
        }

        // Buat OurPrinciple
        OurPrinciple::create([
            'name' => $request->name,
            'subtitle' => $request->subtitle,
            'thumbnail' => $path_thumb,
            'icon' => $path_icon,
        ]);

        // Redirect ke index
        return redirect()->route('our-principles.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }


    public function edit(string $id)
    {
        //get post by ID
        $ourPrinciple = OurPrinciple::findOrFail($id);

        //render view with post
        return view('our-principle.edit', compact('ourPrinciple'));
    }
    public function update(Request $request, $id): RedirectResponse
{
    // Validasi form
    $this->validate($request, [
        'name' => 'required|string|max:255',
        'subtitle' => 'required|string|max:255',
        'thumbnail' => 'nullable|image|mimes:png|max:2048', // Validasi untuk file Thumbnail
        'icon' => 'nullable|image|mimes:png|max:2048', // Validasi untuk file ICON
    ]);

    // Dapatkan data OurPrinciple berdasarkan ID
    $ourPrinciple = OurPrinciple::findOrFail($id);

    // Periksa apakah thumbnail diunggah
    if ($request->hasFile('thumbnail')) {
        // Unggah gambar baru untuk thumbnail
        $image_thumb = $request->file('thumbnail');
        $path_thumb = $image_thumb->storeAs('public/img', $image_thumb->hashName());

        // Hapus thumbnail lama
        if ($ourPrinciple->thumbnail) {
            Storage::delete('public/img/'.$ourPrinciple->thumbnail);
        }

        // Perbarui OurPrinciple dengan gambar thumbnail baru
        $ourPrinciple->thumbnail = $path_thumb;
    }

    // Periksa apakah ikon diunggah
    if ($request->hasFile('icon')) {
        // Unggah gambar baru untuk ikon
        $image_icon = $request->file('icon');
        $path_icon = $image_icon->storeAs('public/icon', $image_icon->hashName());

        // Hapus ikon lama
        if ($ourPrinciple->icon) {
            Storage::delete('public/icon/'.$ourPrinciple->icon);
        }

        // Perbarui OurPrinciple dengan gambar ikon baru
        $ourPrinciple->icon = $path_icon;
    }

    // Perbarui OurPrinciple dengan data lain
    $ourPrinciple->update([
        'name' => $request->name,
        'subtitle' => $request->subtitle,
        'thumbnail' => $ourPrinciple->thumbnail,
        'icon' => $ourPrinciple->icon,
    ]);

    // Redirect ke index
    return redirect()->route('our-principles.index')->with(['success' => 'Data Berhasil Diubah!']);
}

    public function destroy($id)
    {
        $ourPrinciple = OurPrinciple::findOrFail($id);
        $ourPrinciple->delete();

        return redirect()->route('our-principles.index')->with('success', 'Hero Section deleted successfully.');
    }
}
