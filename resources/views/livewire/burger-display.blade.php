<div class="min-h-screen bg-gradient-to-br from-yellow-50 via-white to-gray-100 flex items-center justify-center py-8 px-4">
    <div class="w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 gap-8 items-start">

        <div>
            <livewire:burger-builder />
        </div>

        <div class="flex flex-col items-center">
            <div class="bg-white rounded-3xl shadow-xl px-6 py-6 w-full flex flex-col items-center">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 w-full text-center">Votre burger</h2>

                <div class="relative w-full flex flex-col items-center" style="min-height: 320px;">
                    @foreach($currentBurger as $burger)
                        <img
                            src="{{ $burger->image_path }}"
                            alt="{{ $burger->name }}"
                            class="w-40 object-contain -mt-6 first:mt-0 drop-shadow-md"
                        >
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
