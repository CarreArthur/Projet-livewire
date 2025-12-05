<div class="border-solid border-black border bg-yellow-200 mb-2">
        <img src={{$ingredient->image_path}} alt={{$ingredient->name}}>
    <h2>{{$ingredient->price/100}}€</h2>
    <button wire:click="addBurger">Ajouter</button>
</div>
