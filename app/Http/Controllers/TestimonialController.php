<?php
namespace App\Http\Controllers;

//import Model "Post
use App\Models\Testimonial;
use App\Models\ProjectClient;
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
        $projectClients = ProjectClient::all(); // Mengambil semua data project clients
        //render view with posts
        return view('our-testimoni.index', compact('ourTestimoni','projectClients'));
    }



    public function create(): View
    {
        $projectClients = ProjectClient::all(); // Mengambil semua data project clients
        return view('our-testimoni.create', compact('projectClients'));

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
        'author' => 'required|string|max:255',
        'content' => 'required|string|max:255',
        'thumbnail' => 'nullable|image|mimes:png|max:2048', // Validasi untuk file Avatar

        'project_client_id' => 'required|exists:project_clients,id', // Validasi untuk project_client_id
    ]);

    $path_thumb = null;
    $path_icon = null;

    // Upload avatar jika ada file yang diunggah
    if ($request->hasFile('thumbnail')) {
        $image_thumb = $request->file('thumbnail');
        $path_thumb = $image_thumb->storeAs('public/img', $image_thumb->hashName());
    }


    // Buat Testimonial
    Testimonial::create([
        'author' => $request->author,
        'content' => $request->content,
        'thumbnail' => $path_thumb,

        'project_client_id' => $request->project_client_id, // Menyimpan project_client_id
    ]);

    // Redirect ke index
    return redirect()->route('our-testimoni.index')->with(['success' => 'Data Berhasil Disimpan!']);
}


    public function edit(string $id)
    {
        //get post by ID
        $ourTestimoni = Testimonial::findOrFail($id);
        $projectClients = ProjectClient::where('company_about_id', $id)->get();
        //render view with post
        return view('our-testimoni.edit', compact('Testimonial','projectClients'));
    }
    public function update(Request $request, $id): RedirectResponse
{
    // Validasi form
    $request->validate([
        'author' => 'required|string|max:255',
        'content' => 'required|string|max:255',
        'thumbnail' => 'nullable|image|mimes:png|max:2048', // Validasi untuk file Thumbnail
    ]);

    // Dapatkan data Testimonial berdasarkan ID
    $ourTestimoni = Testimonial::findOrFail($id);

    // Periksa apakah thumbnail diunggah
    if ($request->hasFile('thumbnail')) {
        // Unggah gambar baru untuk thumbnail
        $image_thumb = $request->file('thumbnail');
        $path_thumb = $image_thumb->storeAs('public/img', $image_thumb->hashName());

        // Hapus thumbnail lama
        if ($ourTestimoni->avatar) {
            Storage::delete('public/img/'.$ourTestimoni->thumbnail);
        }

        // Perbarui Testimonial dengan gambar thumbnail baru
        $ourTestimoni->thumbnail = $path_thumb;
    }

    // Perbarui Testimonial dengan data lain
    $ourTestimoni->update([
        'author' => $request->author,
        'content' => $request->content,
        'thumbnail' => $Testimonial->thumbnail,

    ]);

    // Redirect ke index
    return redirect()->route('our-testimoni.index')->with(['success' => 'Data Berhasil Diubah!']);
}

    public function destroy($id)
    {
        $ourTestimoni = Testimonial::findOrFail($id);
        $ourTestimoni->delete();

        return redirect()->route('our-testimoni.index')->with('success', 'Testimonial deleted successfully.');
    }
}
