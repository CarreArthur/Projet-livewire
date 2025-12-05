<div class="min-h-screen bg-white flex flex-col relative overflow-hidden font-sans">
    
    @if (session()->has('success'))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => { show = false; }, 3000)" 
        x-show="show"
        x-transition:leave="transition ease-in duration-500"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-full"
        class="fixed top-0 left-0 right-0 z-[10000] bg-green-500 text-white p-4 text-center font-bold shadow-lg"
    >
        {{ session('success') }}
    </div>
@endif
    
    <div class="bg-yellow-400 h-[65vh] w-full rounded-b-[4rem] flex flex-col items-center pt-12 relative shadow-xl z-10">
        
        <div class="text-center z-20">
            <h1 class="text-4xl font-black text-gray-900 tracking-tight leading-none uppercase drop-shadow-sm">
                Burger<br>
                <span class="text-white text-5xl drop-shadow-md">Architect</span>
            </h1>
            <p class="text-yellow-900 font-bold mt-2 opacity-80 text-sm uppercase tracking-widest">
                Stack it. Eat it.
            </p>
        </div>

        <div class="mt-8 relative w-full flex justify-center z-20">
            <div class="absolute top-10 w-64 h-64 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse"></div>
            
            <img 
                src="../../ingredients/burger.png"
                class="w-72 h-auto object-contain drop-shadow-2xl animate-float hover:scale-105 transition duration-500 ease-in-out cursor-pointer"
                alt="Giant Burger"
            >
        </div>
    </div>

    <div class="flex-1 flex flex-col items-center justify-center p-8 space-y-6 bg-white relative">
        
        <div class="text-center space-y-2 mt-4">
            <h2 class="text-2xl font-bold text-gray-800">Faim de créativité ?</h2>
            <p class="text-gray-400 text-sm max-w-xs mx-auto">
                Compose le burger de tes rêves, étage par étage, et commande-le instantanément.
            </p>
        </div>

        <a href="{{ url('/builder') }}" wire:navigate class="w-full max-w-sm group">
            <div class="relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-green-600 to-green-400 rounded-full blur opacity-40 group-hover:opacity-100 transition duration-200"></div>
                <button class="relative w-full bg-green-600 hover:bg-green-500 text-white font-bold py-4 px-8 rounded-full shadow-lg transform transition hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3 text-lg">
                    <span>Créer mon Burger</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </button>
            </div>
        </a>

        <div class="w-full max-w-sm grid grid-cols-2 gap-4">
            
            <button class="flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 px-4 rounded-2xl transition">
                <span>Historique</span>
            </button>
            
            
            @auth
                <a href="{{ url('/home') }}" class="flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-2xl transition shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.98 5.98 0 0010 16a5.978 5.978 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                    </svg>
                    <span class="truncate" title="{{ Auth::user()->name }}">
                        Salut, {{ Auth::user()->name }}
                    </span>
                </a>
            @else
                <button 
                    x-data="{}"
                    x-on:click="$dispatch('open-auth-modal', { initialMode: 'login' })" 
                    class="flex items-center justify-center gap-2 bg-orange-100 hover:bg-orange-200 text-orange-700 font-bold py-3 px-4 rounded-2xl transition"
                >
                    <span>Compte</span>
                </button>
            @endauth
            
        </div>
        
        @auth
            <div class="text-sm text-gray-500 mt-2">
                <button 
                    wire:click="$dispatch('logout')" 
                    class="text-red-500 hover:text-red-700 font-semibold underline"
                >
                    (Se déconnecter)
                </button>
            </div>
        @endauth
        

    </div>

    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 4s ease-in-out infinite;
        }
    </style>
    
    <livewire:auth-modal wire:key="auth-modal-main" />
    
</div>