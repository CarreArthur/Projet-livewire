<div class="min-h-screen bg-gradient-to-br from-yellow-50 via-white to-gray-100 flex items-center justify-center py-8 px-4">
    <div class="w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 gap-8 items-start">

        <div>
            <livewire:burger-builder />
        </div>

        <div class="flex flex-col items-center">
            <div class="bg-white rounded-3xl shadow-xl px-6 py-6 w-full flex flex-col items-center">
                <div class="w-full flex items-center justify-between mb-4 gap-3">
                    <h2 class="text-lg font-semibold text-gray-800 text-center flex-1">Votre burger</h2>
                    <a
                        href="{{ url('/panier') }}"
                        class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-semibold px-3 py-2 rounded-full transition"
                    >
                        <span>Panier</span>
                        <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-yellow-400 text-gray-900 text-xs font-bold">
                            {{ $cartCount }}
                        </span>
                    </a>
                </div>

                @if (session()->has('success'))
                    <div class="w-full mb-3 px-4 py-2 text-sm font-semibold text-green-800 bg-green-100 rounded-2xl">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="w-full mb-3 text-center">
                    <p class="text-sm font-semibold text-gray-700">
                        {{ $burgerName !== '' ? $burgerName : 'Burger sans nom' }}
                    </p>
                </div>

                <div class="relative w-full flex flex-col items-center" style="min-height: 320px;">
                    @foreach($currentBurger as $burger)
                        <img
                            src="{{ $burger->image_path }}"
                            alt="{{ $burger->name }}"
                            class="w-40 object-contain -mt-6 first:mt-0 drop-shadow-md"
                        >
                    @endforeach
                </div>

                <button
                    wire:click="addCurrentBurgerToCart"
                    class="mt-5 w-full bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-3 px-4 rounded-full shadow-md transition"
                >
                    Ajouter ce burger au panier
                </button>
            </div>
        </div>

    </div>
</div>
