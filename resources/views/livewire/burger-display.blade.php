<div>
    <livewire:burger-builder/>

    @foreach($currentBurger as $burger)
        <img src="{{$burger->image_path}}" alt="{{$burger->name}}">
    @endforeach
</div>
