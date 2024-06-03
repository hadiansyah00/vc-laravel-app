<?php

namespace App\Http\Controllers;

//import Model "Post
use App\Models\Product;
use Illuminate\Http\Request;
//return type View
use Illuminate\View\View;
//return type redirectResponse
use Illuminate\Http\RedirectResponse;
//import Facade "Storage"
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * index
     *
     * @return View
     */

    public function index(): View
    {
        //get posts
        $ourProducts = Product::latest()->paginate(5);

        //render view with posts
        return view('our-products.index', compact('ourProducts'));
    }


    public function create(): View
    {
        return view('our-products.create');
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
            'tagline' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048', // Validasi untuk file icon
        ]);

        $thumbnailName = null;

        // Upload image jika ada file yang diunggah
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $path = $image->storeAs('public/img', $image->hashName());
        }

        // Buat OurTeam
        Product::create([
            'thumbnail' => $path,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'tagline' => $request->tagline,
        ]);

        // Redirect ke index
        return redirect()->route('our-products.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id)
    {
        //get post by ID
        $ourProducts = Product::findOrFail($id);

        //render view with post
        return view('our-products.edit', compact('ourProducts'));
    }
    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi form
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048', // Validasi untuk file icon
        ]);

        // Dapatkan data OurTeam berdasarkan ID
        $ourProducts = Product::findOrFail($id);

        // Periksa apakah gambar diunggah
        if ($request->hasFile('thumbnail')) {
            // Unggah gambar baru
            $image = $request->file('thumbnail');
            $path = $image->storeAs('public/img', $image->hashName());

            // Hapus gambar lama
            if ($ourProducts->thumbnail) {
                Storage::delete('/public/img'.$ourProducts->thumbnail);
            }

            // Perbarui Product dengan gambar baru
            $ourProducts->update([
                'thumbnail' => $path,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'tagline' => $request->tagline,
            ]);
        } else {
            // Perbarui OurTeam tanpa gambar
            $ourProducts->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'tagline' => $request->tagline,
            ]);
        }

        // Redirect ke index
        return redirect()->route('our-products.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id)
    {
        $ourProducts = Product::findOrFail($id);
        $ourProducts->delete();

        return redirect()->route('our-products.index')->with('success', 'Company Statistics Section deleted successfully.');
    }
}
