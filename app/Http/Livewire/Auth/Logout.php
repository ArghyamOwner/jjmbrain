<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    public $schemeId;

    public function logout()
    {
        Auth::logout();
 
        request()->session()->invalidate();
     
        request()->session()->regenerateToken();
        
        return redirect()->route('schemes.qrcodeDetails', $this->schemeId);
    }

    public function render()
    {
        return view('livewire.auth.logout');
    }
}
