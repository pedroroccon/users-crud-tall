<?php
  
namespace App\Http\Livewire;
  
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Livewire\Component;
  
class Users extends Component
{

    /**
     * Handles the users.
     * 
     * @var \Illuminate\Database\Eloquent\Collection
     */
    public $users;

    /**
     * Handles the user id, if 
     * is setted.
     * 
     * @return mixed
     */
    public $user_id = null;

    /**
     * Defines the fields that 
     * should be filled.
     * 
     * @var mixed
     */
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
        $state, 
        $terms;

    public $isOpen = false;


    /**
     * Defines what view we should 
     * render for this component.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        $this->users = User::all();
        return view('livewire.users.list');
    }

    /**
     * Validates the request.
     * 
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'last_name' => 'required', 
            'email' => [
                'required', 
                'email', 
                Rule::unique('users', 'email')->ignore($this->user_id)
            ],
            'cpf' => [
                'required', 
                Rule::unique('users', 'cpf')->ignore($this->user_id)
            ], 
            'phone' => 'required', 
            'postcode' => 'required', 
            'address' => 'required', 
            'number' => 'required', 
            'city' => 'required', 
            'state' => 'required|size:2', 
            'password' => 'required|min:8', 
            'terms' => 'sometimes|accepted'
        ];
    }

    /**
     * 
     */
    public function updated($property)
    {
        $this->validateOnly($property);
    }
  
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }
    
    /**
     * Opens the form modal.
     * 
     * @return void
     */
    public function openModal()
    {
        $this->isOpen = true;
    }

    /**
     * Closes the form modal.
     * 
     * @return void
     */
    public function closeModal()
    {
        // We should clear the errors bag when 
        // we closes the modal. This prevents the 
        // errors keep showing when we switch to 
        // create/edit user.
        $this->resetValidation();

        $this->isOpen = false;
    }

    /**
     * Reset all fields.
     * 
     * @return void
     */
    private function resetInputFields() {
        $this->user_id = null;
        $this->name = null;
        $this->last_name = null;
        $this->email = null;
        $this->password = null;
        $this->cpf = null;
        $this->phone = null;
        $this->postcode = null;
        $this->address = null;
        $this->number = null;
        $this->district = null;
        $this->address_additional = null;
        $this->city = null;
        $this->state = null;
        $this->terms = null;
    }

    /**
     * Persist the information 
     * on the database.
     * 
     * @return void
     */
    public function store()
    {
        $this->validate();

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
    
    /**
     * Deletes the given resource.
     * 
     * @return void 
     */
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        session()->flash('message', 'Usuário ' . $user->name . ' removido com sucesso!');
    }

    /**
     * Make a request to the ViaCEP API
     * and returns the address informations 
     * based on a given postcode.
     * 
     * @return void
     */
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