<div class="grid grid-cols-2 md:grid-cols-3 gap-4 p-4 pb-32 overflow-y-auto h-full">
    
    @foreach($ingredients as $ingredient)
        <button 
            wire:click="addToBurger({{ $ingredient->id }})"
            class="group bg-white rounded-3xl p-3 shadow-sm border-2 border-transparent hover:border-yellow-400 hover:shadow-lg transition-all duration-200 active:scale-95 flex flex-col items-center relative"
        >
            <div class="absolute top-3 right-3 bg-green-100 text-green-600 w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold opacity-0 group-hover:opacity-100 transition-opacity">
                +
            </div>

            <livewire:ingredient 
                lien="{{ asset($ingredient->image_path) }}" 
                price="{{ number_format($ingredient->price / 100, 2) }}"
            />

            <span class="text-xs font-bold text-gray-500 mt-2 group-hover:text-yellow-600">
                {{ $ingredient->name }}
            </span>

            </button>
    @endforeach

</div>