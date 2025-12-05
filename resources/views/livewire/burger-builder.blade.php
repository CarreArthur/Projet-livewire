<div>
    @foreach($ingredients as $ingredient)        
            <livewire:ingredient :$ingredient wire:key="$ingredient->id"/>
    @endforeach

</div>