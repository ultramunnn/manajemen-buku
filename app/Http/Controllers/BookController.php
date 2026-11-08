<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::latest()->paginate(10);
        return view("books.index", compact("books"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("books.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "title" => "required|string|max:255",
            "author" => "required|string|max:255",
            "description" => "nullable|string",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048", // Validasi gambar
        ]);

        // Handle upload gambar
        if ($request->hasFile("image")) {
            // Simpan gambar ke disk 'public' di dalam folder 'book-covers'
            // store() akan otomatis membuat nama file unik dan mengembalikan path relatifnya
            $path = $request->file("image")->store("book-covers", "public");
            $validated["image_path"] = $path;
        }

        Book::create($validated);

        return redirect()
            ->route("books.index")
            ->with("success", "Buku berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view("books.show", compact("book"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view("books.edit", compact("book"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            "title" => "required|string|max:255",
            "author" => "required|string|max:255",
            "description" => "nullable|string",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        if ($request->hasFile("image")) {
            // Hapus gambar lama jika ada
            if ($book->image_path) {
                Storage::disk("public")->delete($book->image_path);
            }
            // Simpan gambar baru
            $path = $request->file("image")->store("book-covers", "public");
            $validated["image_path"] = $path;
        }

        $book->update($validated);

        return redirect()
            ->route("books.index")
            ->with("success", "Buku berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        // Hapus file gambar terkait dari storage
        if ($book->image_path) {
            Storage::disk("public")->delete($book->image_path);
        }

        $book->delete();

        return redirect()
            ->route("books.index")
            ->with("success", "Buku berhasil dihapus.");
    }
}
