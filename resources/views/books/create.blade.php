<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('books.index') }}"
               class="p-2 rounded-lg bg-white shadow-sm hover:bg-gray-50 transition">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900">Tambah Buku Baru</h1>
                <p class="text-sm text-gray-500">Lengkapi form di bawah ini.</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 sm:p-8">
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <!-- Judul -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Judul <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition @error('title') border-red-400 @enderror"
                           placeholder="Contoh: Laskar Pelangi">
                    @error('title')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Penulis -->
                <div>
                    <label for="author" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Penulis <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="author" id="author" value="{{ old('author') }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition @error('author') border-red-400 @enderror"
                           placeholder="Contoh: Andrea Hirata">
                    @error('author')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition resize-none @error('description') border-red-400 @enderror"
                              placeholder="Sinopsis singkat buku...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Upload Gambar -->
                <div>
                    <label for="image" class="block text-sm font-semibold text-gray-700 mb-1.5">Gambar Sampul</label>
                    <div class="relative border-2 border-dashed border-gray-300 hover:border-indigo-400 rounded-xl p-6 text-center transition cursor-pointer bg-gray-50/50"
                         onclick="document.getElementById('image').click()">
                        <div id="preview-container" class="hidden mb-3">
                            <img id="preview" class="mx-auto max-h-48 rounded-lg shadow-md" alt="Preview">
                        </div>
                        <svg class="w-10 h-10 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-sm text-gray-600 mt-2">Klik untuk memilih gambar</p>
                        <p class="text-xs text-gray-400 mt-1">JPG, PNG, GIF · Maks 2MB</p>
                    </div>
                    <input type="file" name="image" id="image" accept="image/*" class="hidden"
                           onchange="previewImage(event)">
                    @error('image')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('books.index') }}"
                       class="px-5 py-2.5 text-sm font-semibold text-gray-600 hover:text-gray-800 transition">
                        Batal
                    </a>
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white text-sm font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Buku
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById('preview');
                const container = document.getElementById('preview-container');
                preview.src = URL.createObjectURL(file);
                container.classList.remove('hidden');
            }
        }
    </script>
</x-app-layout>
