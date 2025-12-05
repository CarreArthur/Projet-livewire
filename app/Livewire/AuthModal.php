<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Auth; 
use App\Models\User; 

class AuthModal extends Component
{
    public bool $isOpen = false;
    public string $mode = 'login'; 
    
    // Propriétés du formulaire
    #[Rule('required|email')]
    public string $email = '';

    #[Rule('required|min:6')]
    public string $password = '';
    
    // Propriétés spécifiques à l'inscription
    #[Rule('required|min:3')]
    public string $name = '';

    #[Rule('required|same:password')]
    public string $password_confirmation = '';


    #[On('open-auth-modal')]
    public function openModal(string $initialMode = 'login'): void
    {
        $this->reset(['email', 'password', 'name', 'password_confirmation']); // Réinitialise les champs à l'ouverture
        $this->isOpen = true;
        $this->mode = $initialMode;
        $this->resetValidation(); // Efface les erreurs de validation
    }

    public function closeModal(): void
    {
        // Utilise $this->js() pour fermer l'état PHP APRÈS l'animation (300ms)
        $this->js('
            const modalElement = document.getElementById("auth-modal-wrapper");
            // Vérifie si l\'élément existe et supprime l\'état après l\'animation
            if (modalElement) {
                setTimeout(() => { $wire.isOpen = false; }, 300);
            } else {
                $wire.isOpen = false;
            }
        ');
    }
    
    public function setMode(string $newMode): void
    {
        $this->mode = $newMode;
        $this->resetValidation(); // Efface les erreurs de validation lors du changement d'onglet
    }

    // --- Méthode de Connexion ---
    public function login(): void
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->flash('success', 'Connexion réussie ! Bienvenue.');
            $this->closeModal();
            $this->redirect(route('home'), navigate: true); // Assurez-vous que la route 'dashboard' existe
        } else {
            $this->addError('email', 'Ces identifiants ne correspondent pas à nos enregistrements.');
        }
    }

    // --- Méthode d'Inscription ---
    public function register(): void
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password), // Hachez toujours le mot de passe
        ]);
        
        Auth::login($user);

        session()->flash('success', 'Compte créé avec succès !');
        $this->closeModal();
        $this->redirect(route('home'), navigate: true); // Assurez-vous que la route 'dashboard' existe
    }
    
    // --- Méthode de Déconnexion ---
    #[On('logout')] 
    public function logout(): void
    {
        Auth::logout();
        session()->flash('success', 'Vous êtes déconnecté.');
        $this->redirect('/', navigate: true); // Redirige vers la page d'accueil
    }


    public function render()
    {
        return view('livewire.auth-modal');
    }
}