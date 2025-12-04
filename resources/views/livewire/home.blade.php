<div class="min-h-screen bg-white flex flex-col relative overflow-hidden font-sans">
    
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
            <button class="flex items-center justify-center gap-2 bg-orange-100 hover:bg-orange-200 text-orange-700 font-bold py-3 px-4 rounded-2xl transition">
                <span>Compte</span>
            </button>
        </div>

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
</div>