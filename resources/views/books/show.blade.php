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
                <h1 class="text-2xl font-extrabold text-gray-900">Detail Buku</h1>
                <p class="text-sm text-gray-500">Informasi lengkap buku.</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="grid md:grid-cols-5 gap-0">
                <!-- Cover -->
                <div class="md:col-span-2 bg-gradient-to-br from-indigo-100 to-purple-100 min-h-[300px] flex items-center justify-center p-6">
                    @if ($book->image_path)
                        <img src="{{ Storage::url($book->image_path) }}"
                             alt="{{ $book->title }}"
                             class="w-full max-w-xs rounded-xl shadow-2xl object-cover">
                    @else
                        <div class="text-center text-indigo-300">
                            <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <p class="text-sm mt-2 font-medium">Tidak ada sampul</p>
                        </div>
                    @endif
                </div>

                <!-- Info -->
                <div class="md:col-span-3 p-6 sm:p-8 flex flex-col">
                    <span class="text-xs font-bold text-indigo-500 uppercase tracking-wider">Buku #{{ $book->id }}</span>
                    <h2 class="text-3xl font-extrabold text-gray-900 mt-2 leading-tight">{{ $book->title }}</h2>

                    <div class="flex items-center gap-2 mt-3 text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="font-medium">{{ $book->author }}</span>
                    </div>

                    <div class="mt-6 flex-1">
                        <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-2">Deskripsi</h3>
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                            {{ $book->description ?? 'Tidak ada deskripsi untuk buku ini.' }}
                        </p>
                    </div>

                    <div class="text-xs text-gray-400 mt-6 pt-4 border-t border-gray-100">
                        Ditambahkan {{ $book->created_at->diffForHumans() }}
                        @if ($book->updated_at->ne($book->created_at))
                            · Diperbarui {{ $book->updated_at->diffForHumans() }}
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-3 mt-6">
                        <a href="{{ route('books.edit', $book) }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white text-sm font-semibold rounded-xl shadow-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-500 hover:bg-red-600 text-white text-sm font-semibold rounded-xl shadow-lg transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
