<div class="bg-white rounded-3xl shadow-lg p-4 flex flex-col items-center justify-between gap-4 transition transform hover:-translate-y-1 hover:shadow-xl h-full mt-4">
    
    <div class="h-32 w-full flex items-center justify-center  rounded-2xl p-2">
        <img 
            src="{{$ingredient->image_path}}" 
            alt="{{$ingredient->name}}" 
            class="max-h-full object-contain drop-shadow-md"
        >
    </div>

    <div class="flex flex-col items-center gap-2 w-full">
        <h2 class="font-black text-2xl text-gray-800 tracking-tight">
            {{$ingredient->price/100}}€
        </h2>

        <button 
            wire:click="$dispatch('ingredientAdd', { ingredient: {{ $ingredient }} })" 
            class="w-full bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-3 px-4 rounded-xl shadow-sm transition-colors duration-200 flex items-center justify-center gap-2"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Ajouter
        </button>
    </div>

</div>
