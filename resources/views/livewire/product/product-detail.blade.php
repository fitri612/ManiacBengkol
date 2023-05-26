<div>
    @include('partials.success_toast')
    {{-- @foreach ($products as $item) --}}
    @if($selectedProduct)
    <button wire:click="BackToList" type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Back</button>
    <div class="dark:text-white m-3">
        <h1>product name : {{ $selectedProduct->name }}</h1>
        <p>product ID: {{ $selectedProduct->id }}</p>
        <p>product picture : 
        <img src="{{ asset('storage/' . $selectedProduct->image) }}" alt="img" height="100px" width="100px">
        </p>
        <p>description : {{ $selectedProduct->description }}</p>
        <p>stock : {{ $selectedProduct->stock }}</p>
        <p>price : {{ $selectedProduct->price }}</p>
        <br>
        <button wire:click="addToCart({{ $selectedProduct->id }})" type="button" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">add to cart</button>
        <br>
        <button>buy</button>
        <br>
        @else
        @livewire('cart.index')
    </div>
    @endif    
</div>
