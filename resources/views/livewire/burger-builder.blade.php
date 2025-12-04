<div>
    @foreach($ingredients as $ingredient)
        <div class="border-solid border-black border bg-yellow-200 mb-2">
            <livewire:ingredient lien="{{$ingredient->image_path}}" price="{{$ingredient->price/100}}"/>
            <button wire:click='addToBurger({{$ingredient->id}})'>Ajouter au burger</button>
        </div>
    @endforeach
</div>
