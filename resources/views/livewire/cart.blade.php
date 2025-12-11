<div class="min-h-screen bg-gradient-to-br from-yellow-50 via-white to-gray-100 flex items-center justify-center py-10 px-4">
    <div class="w-full max-w-4xl bg-white rounded-3xl shadow-xl p-6 space-y-4">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900">Votre panier</h1>
            <a href="{{ url('/builder') }}" class="text-sm text-yellow-600 hover:text-yellow-700 font-semibold underline">
                Retour au builder
            </a>
        </div>

        @if (session()->has('success'))
            <div class="w-full px-4 py-3 text-sm font-semibold text-green-800 bg-green-100 rounded-2xl">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="w-full px-4 py-3 text-sm font-semibold text-red-800 bg-red-100 rounded-2xl">
                {{ session('error') }}
            </div>
        @endif

        @if (empty($items))
            <div class="text-center text-gray-500 py-10">
                Votre panier est vide.
            </div>
        @else
            <div class="space-y-4">
                @foreach($items as $index => $cartItem)
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-gray-50 border border-gray-200 rounded-2xl p-4">
                        <div class="flex-1 space-y-2">
                            <p class="font-semibold text-gray-800">Burger #{{ $index + 1 }}</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($cartItem['items'] as $ingredient)
                                    <span class="inline-flex items-center gap-2 bg-white border border-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700">
                                        <img src="{{ $ingredient['image_path'] }}" alt="{{ $ingredient['name'] }}" class="w-6 h-6 object-contain">
                                        {{ $ingredient['name'] }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="text-right">
                                <p class="text-sm text-gray-600">Total</p>
                                <p class="text-xl font-bold text-gray-900">
                                    €{{ number_format($cartItem['total_price'] / 100, 2) }}
                                </p>
                            </div>
                            <button
                                wire:click="removeItem({{ $index }})"
                                class="text-sm text-red-600 hover:text-red-700 font-semibold"
                            >
                                Retirer
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-t border-gray-200 pt-4">
                <div>
                    <p class="text-sm text-gray-600">Total panier</p>
                    <p class="text-2xl font-bold text-gray-900">
                        €{{ number_format($this->total / 100, 2) }}
                    </p>
                </div>
                <button
                    wire:click="checkout"
                    class="w-full md:w-auto bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold px-6 py-3 rounded-full shadow-md transition"
                >
                    {{ count($items) > 1 ? 'Acheter mes burger' : 'Acheter mon burger' }}
                </button>
            </div>
        @endif
    </div>
</div>
