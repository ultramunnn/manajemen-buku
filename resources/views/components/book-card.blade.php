@props(['book'])

<div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:-translate-y-1 flex flex-col">
    <!-- Cover -->
    <div class="relative h-56 overflow-hidden bg-gradient-to-br from-indigo-100 to-purple-100">
        @if ($book->image_path)
            <img src="{{ Storage::url($book->image_path) }}"
                 alt="{{ $book->title }}"
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        @else
            <div class="w-full h-full flex flex-col items-center justify-center text-indigo-300">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-xs mt-1 font-medium">Tanpa Sampul</span>
            </div>
        @endif
        <!-- Badge -->
        <div class="absolute top-3 right-3">
            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-white/90 text-indigo-600 backdrop-blur-sm shadow">
                #{{ $book->id }}
            </span>
        </div>
    </div>

    <!-- Body -->
    <div class="p-5 flex flex-col flex-1">
        <h3 class="text-lg font-bold text-gray-900 line-clamp-2 group-hover:text-indigo-600 transition-colors">
            {{ $book->title }}
        </h3>
        <p class="text-sm text-gray-500 mt-1 flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            {{ $book->author }}
        </p>
        <p class="text-sm text-gray-600 mt-3 line-clamp-3 flex-1">
            {{ $book->description ?? 'Tidak ada deskripsi.' }}
        </p>

        <!-- Actions -->
        <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between gap-2">
            <a href="{{ route('books.show', $book) }}"
               class="inline-flex items-center gap-1 text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                Lihat
            </a>
            <div class="flex items-center gap-2">
                <a href="{{ route('books.edit', $book) }}"
                   class="p-2 rounded-lg text-amber-500 hover:bg-amber-50 transition" title="Edit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </a>
                <form action="{{ route('books.destroy', $book) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="p-2 rounded-lg text-red-500 hover:bg-red-50 transition" title="Hapus">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
