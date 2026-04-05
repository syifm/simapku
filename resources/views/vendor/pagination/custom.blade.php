@if ($paginator->hasPages())
    <nav class="flex items-center justify-between mt-4">
        <div class="text-sm text-gray-600">
            Showing {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
        </div>

        <div class="flex items-center gap-1">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-1.5 rounded-lg text-sm text-gray-400 bg-gray-100 cursor-not-allowed">
                    &laquo;
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="px-3 py-1.5 rounded-lg text-sm text-white bg-emerald-500 hover:bg-emerald-600 transition">
                    &laquo;
                </a>
            @endif

            {{-- Page Numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-3 py-1.5 text-sm text-gray-400">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-1.5 rounded-lg text-sm text-white bg-emerald-600 font-semibold">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                                class="px-3 py-1.5 rounded-lg text-sm text-emerald-600 border border-emerald-300 hover:bg-emerald-50 transition">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="px-3 py-1.5 rounded-lg text-sm text-white bg-emerald-500 hover:bg-emerald-600 transition">
                    &raquo;
                </a>
            @else
                <span class="px-3 py-1.5 rounded-lg text-sm text-gray-400 bg-gray-100 cursor-not-allowed">
                    &raquo;
                </span>
            @endif
        </div>
    </nav>
@endif
