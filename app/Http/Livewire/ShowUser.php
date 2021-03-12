<?php
  
namespace App\Http\Livewire;
  
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
  
class ShowUser extends Component
{
    public $user;
  
    public function render()
    {
        return view('livewire.users.show');
    }
}