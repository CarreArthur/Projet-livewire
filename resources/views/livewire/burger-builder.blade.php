<div class="max-w-md mx-auto bg-gray-50 rounded-3xl shadow-xl overflow-hidden">
    <div class="bg-yellow-400 px-6 py-4 flex items-center justify-between">
        <button
            wire:click="resetBuilder"
            class="flex items-center gap-2 bg-white/80 hover:bg-white text-gray-900 font-semibold px-4 py-2 rounded-full shadow-sm transition-colors duration-200"
        >
            <span class="inline-flex h-5 w-5 items-center justify-center rounded-full border border-gray-400 text-xs font-bold">⟳</span>
            <span>Refresh</span>
        </button>

        <div class="text-right">
            <p class="text-sm text-gray-800 font-medium">Your total</p>
            <p class="text-2xl font-extrabold text-gray-900">€{{ $this->formattedTotal }}</p>
        </div>
    </div>

    <div class="px-4 py-4 space-y-3">
        @foreach($ingredients as $ingredient)
            <div class="flex items-center gap-3 bg-white rounded-2xl shadow-sm px-3 py-2">
                <div class="w-16 h-16 flex items-center justify-center">
                    <img
                        src="{{ $ingredient->image_path }}"
                        alt="{{ $ingredient->name }}"
                        class="max-h-14 object-contain drop-shadow-md"
                    >
                </div>

                <div class="flex-1">
                    <p class="font-semibold text-gray-800 leading-tight">{{ $ingredient->name }}</p>
                    @unless(in_array($ingredient->slug, ['bun_top_brioche', 'bun_bottom_brioche']))
                        <p class="text-sm text-green-600 font-medium">+ {{ $ingredient->price / 100 }}€</p>
                    @endunless
                </div>

                <div class="flex items-center gap-2">
                    @if(in_array($ingredient->slug, ['bun_top_brioche', 'bun_bottom_brioche']))
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                            Inclus
                        </span>
                        <span class="w-6 text-center font-semibold text-gray-800">
                            1
                        </span>
                    @else
                        <button
                            wire:click="decrement({{ $ingredient->id }})"
                            class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-300 text-gray-700 text-lg font-bold hover:bg-gray-100"
                        >
                            −
                        </button>

                        <span class="w-6 text-center font-semibold text-gray-800">
                            {{ $quantities[$ingredient->id] ?? 0 }}
                        </span>

                        <button
                            wire:click="increment({{ $ingredient->id }})"
                            class="w-8 h-8 flex items-center justify-center rounded-full bg-yellow-400 hover:bg-yellow-500 text-gray-900 text-lg font-bold shadow-sm"
                        >
                            +
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>