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
    
    #[Rule('required|email')]
    public string $email = '';
    #[Rule('required|min:6')]
    public string $password = '';
    #[Rule('required|min:3')]
    public string $name = '';
    #[Rule('required|same:password')]
    public string $password_confirmation = '';


    #[On('open-auth-modal')]
    public function openModal(string $initialMode = 'login'): void
    {
        $this->reset(['email', 'password', 'name', 'password_confirmation']); 
        $this->isOpen = true;
        $this->mode = $initialMode;
        $this->resetValidation(); 
    }

    public function closeModal(): void
    {
        $this->js('
            const modalElement = document.getElementById("auth-modal-wrapper"); 
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
        $this->resetValidation(); 
    }

    public function login(): void
    {
        $this->validate(['email' => 'required|email','password' => 'required',]);
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->flash('success', 'Connexion réussie ! Bienvenue.');
            $this->closeModal();
            $this->redirect(route('home'), navigate: true); 
        } else {
            $this->addError('email', 'Ces identifiants ne correspondent pas à nos enregistrements.');
        }
    }

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
            'password' => bcrypt($this->password), 
        ]);
        
        Auth::login($user);

        session()->flash('success', 'Compte créé avec succès !');
        $this->closeModal();
        $this->redirect(route('home'), navigate: true); 
    }
    

    #[On('logout')]
    public function logout(): void
    {
        Auth::logout();
        session()->flash('success', 'Vous êtes déconnecté.');
        $this->redirect('/', navigate: true); 
    }


    public function render()
    {
        return view('livewire.auth-modal');
    }
}