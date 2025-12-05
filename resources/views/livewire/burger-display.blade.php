<div>
    <livewire:burger-builder/>

    @foreach($currentBurger as $burger)
        <p>{{$burger->slug}}</p>
    @endforeach
</div>
