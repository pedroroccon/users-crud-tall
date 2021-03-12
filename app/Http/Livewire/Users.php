<?php
  
namespace App\Http\Livewire;
  
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
  
class Users extends Component
{
    public $users;

    public $user_id = null;

    public $name, 
        $last_name, 
        $email, 
        $password, 
        $cpf, 
        $phone, 
        $postcode, 
        $address, 
        $number, 
        $district, 
        $address_additional, 
        $city, 
        $state;

    public $isOpen = false;

    protected $rules = [
        'name' => 'required',
        'last_name' => 'required', 
        'email' => 'required|email',
        'cpf' => 'required|unique:users', 
        'phone' => 'required', 
        'postcode' => 'required', 
        'address' => 'required', 
        'number' => 'required', 
        'city' => 'required', 
        'state' => 'required|size:2', 
    ];
  
    public function render()
    {
        $this->users = User::all();
        return view('livewire.users.list');
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }
  
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }
  
    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields() {
        $this->user_id = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function store()
    {
        $this->validate([

        ]);
   
        User::updateOrCreate(['id' => $this->user_id], [
            'name' => $this->name,
            'email' => $this->email
        ]);
  
        session()->flash('message', $this->user_id ? 'Usuário ' . $this->name . ' atualizado com sucesso!' : 'Usuário ' . $this->name . ' adicionado com sucesso!');
  
        $this->closeModal();
        $this->resetInputFields();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->cpf = $user->cpf;
        $this->phone = $user->phone;
        $this->postcode = $user->postcode;
        $this->address = $user->address;
        $this->number = $user->number;
        $this->district = $user->district;
        $this->address_additional = $user->address_additional;
        $this->city = $user->city;
        $this->state = $user->state;
    
        $this->openModal();
    }
    
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        session()->flash('message', 'Usuário ' . $user->name . ' removido com sucesso!');
    }

    public function getPostcode()
    {
        // Makes a get request to ViaCEP API
        $response = Http::get('https://viacep.com.br/ws/' . $this->postcode . '/json/');

        if ($response->successful()) {
            $response = json_decode($response->body());

            $this->address = $response->logradouro;
            $this->city = $response->localidade;
            $this->district = $response->bairro;
            $this->state = $response->uf;
        }
    }
}