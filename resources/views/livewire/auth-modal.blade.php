<div 
    id="auth-modal-wrapper" {{-- 💡 Ajout de l'ID pour la méthode closeModal dans le PHP --}}
    x-data="{ 
        show: @entangle('isOpen'),
        showLoginPassword: false, 
        showRegisterPassword: false, 
        showRegisterConfirmPassword: false 
    }" 
    x-show="show"
    
    {{-- Transition globale de l'opacité du fond (backdrop) --}}
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[9999]" {{-- Z-index augmenté --}}
    style="display: none;" 
>
    
    <div 
        x-show="show"
        
        {{-- Transition pour l'effet de zoom (le contenu de la modale) --}}
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"

        class="bg-white rounded-3xl shadow-2xl p-8 w-11/12 max-w-md transform transition-all duration-300 ease-out" 
        @click.away="$wire.closeModal()"
    >
        
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-black text-gray-800">Accès Compte</h3>
            <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="space-y-6">
            <div class="flex border-b border-gray-200">
                <button 
                    wire:click="setMode('login')"
                    class="py-2 px-4 text-sm font-medium border-b-2 transition duration-150 ease-in-out focus:outline-none"
                    @class([
                        'border-yellow-500 text-yellow-600' => $mode === 'login',
                        'border-transparent text-gray-500 hover:text-gray-700' => $mode !== 'login',
                    ])
                >
                    Connexion
                </button>
                <button 
                    wire:click="setMode('register')"
                    class="py-2 px-4 text-sm font-medium border-b-2 transition duration-150 ease-in-out focus:outline-none"
                    @class([
                        'border-yellow-500 text-yellow-600' => $mode === 'register',
                        'border-transparent text-gray-500 hover:text-gray-700' => $mode !== 'register',
                    ])
                >
                    Inscription
                </button>
            </div>

            <form wire:submit="login" x-show="$wire.mode === 'login'" class="space-y-4">
                
                <input type="email" placeholder="Email" wire:model.blur="email" class="w-full p-3 border border-gray-300 rounded-xl focus:border-yellow-500 focus:ring-yellow-500 transition">
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                
                <div class="relative">
                    <input 
                        :type="showLoginPassword ? 'text' : 'password'" 
                        placeholder="Mot de passe" 
                        wire:model.blur="password" 
                        class="w-full p-3 border border-gray-300 rounded-xl focus:border-yellow-500 focus:ring-yellow-500 transition pr-10"
                    >
                    <button type="button" @click="showLoginPassword = !showLoginPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                        <svg x-show="showLoginPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.433 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <svg x-show="!showLoginPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395m-4.59-1.312l-2.095-2.095m2.095 2.095l2.095-2.095m-2.095 2.095l-2.095-2.095M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.68.22.845.289 1.733.205 2.617M10.74 13.924l2.427 2.427m2.426-2.427l-2.426-2.427m-2.427-2.427l-2.426 2.427m2.427-2.427l2.427-2.427M12 12v.01" />
                        </svg>
                    </button>
                </div>
                @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                
                <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 rounded-full shadow-md transition transform hover:scale-[1.01] active:scale-95">
                    Se connecter
                </button>
                <p class="text-center text-sm text-gray-400 mt-2">
                    <a href="#" class="hover:text-yellow-600 transition">Mot de passe oublié ?</a>
                </p>
            </form>

            <form wire:submit="register" x-show="$wire.mode === 'register'" class="space-y-4">
                
                <input type="text" placeholder="Nom d'utilisateur" wire:model.blur="name" class="w-full p-3 border border-gray-300 rounded-xl focus:border-yellow-500 focus:ring-yellow-500 transition">
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                <input type="email" placeholder="Email" wire:model.blur="email" class="w-full p-3 border border-gray-300 rounded-xl focus:border-yellow-500 focus:ring-yellow-500 transition">
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                <div class="relative">
                    <input 
                        :type="showRegisterPassword ? 'text' : 'password'" 
                        placeholder="Mot de passe (6 car. min.)" 
                        wire:model.blur="password" 
                        class="w-full p-3 border border-gray-300 rounded-xl focus:border-yellow-500 focus:ring-yellow-500 transition pr-10"
                    >
                    <button type="button" @click="showRegisterPassword = !showRegisterPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                        <svg x-show="showRegisterPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.433 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <svg x-show="!showRegisterPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395m-4.59-1.312l-2.095-2.095m2.095 2.095l-2.095-2.095m-2.095 2.095l-2.095-2.095M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.68.22.845.289 1.733.205 2.617M10.74 13.924l2.427 2.427m2.426-2.427l-2.426-2.427m-2.427-2.427l-2.426 2.427m2.427-2.427l2.427-2.427M12 12v.01" />
                        </svg>
                    </button>
                </div>
                @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                <div class="relative">
                    <input 
                        :type="showRegisterConfirmPassword ? 'text' : 'password'" 
                        placeholder="Confirmer Mot de passe" 
                        wire:model.blur="password_confirmation" 
                        class="w-full p-3 border border-gray-300 rounded-xl focus:border-yellow-500 focus:ring-yellow-500 transition pr-10"
                    >
                    <button type="button" @click="showRegisterConfirmPassword = !showRegisterConfirmPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                        <svg x-show="showRegisterConfirmPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.433 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <svg x-show="!showRegisterConfirmPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395m-4.59-1.312l-2.095-2.095m2.095 2.095l-2.095-2.095m-2.095 2.095l-2.095-2.095M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.68.22.845.289 1.733.205 2.617M10.74 13.924l2.427 2.427m2.426-2.427l-2.426-2.427m-2.427-2.427l-2.426 2.427m2.427-2.427l2.427-2.427M12 12v.01" />
                        </svg>
                    </button>
                </div>
                @error('password_confirmation') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-full shadow-md transition transform hover:scale-[1.01] active:scale-95">
                    S'inscrire
                </button>
            </form>
        </div>
    </div>
</div>