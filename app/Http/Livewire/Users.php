<?php
  
namespace App\Http\Livewire;
  
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;
use Livewire\Component;
  
class Users extends Component
{

    use WithPagination;

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
    public $name, $last_name, $email, $password, $cpf, $phone, $postcode, $address, $number, $district, $address_additional, $city, $state, $terms;

    /**
     * Handles the form modal state.
     * (visible or hidden).
     *
     * @var boolean
     */
    public $isOpen = false;

    /**
     * Defines what view we should 
     * render for this component.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.users.list', [
            'users' => User::orderBy('id', 'desc')->paginate()
        ]);
    }

    /**
     * Validates the request.
     * 
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required',
            'last_name' => 'required', 
            'email' => [
                'required', 
                'email', 
                Rule::unique('users', 'email')->ignore($this->user_id)
            ],
            'cpf' => [
                'required', 
                'size:14', 
                Rule::unique('users', 'cpf')->ignore($this->user_id)
            ], 
            'phone' => 'required|size:16', 
            'postcode' => 'required|size:9', 
            'address' => 'required', 
            'number' => 'required', 
            'city' => 'required', 
            'password' => 'nullable|min:8', 
            'state' => 'required|size:2', 
        ];

        // When creating a new user, 
        // we should verify if the user 
        // typed a password and accepted 
        // the terms and conditions.
        if (empty($this->user_id)) {
            $rules['password'] = 'required|min:8';
            $rules['terms'] = 'accepted';
        }

        return $rules;
    }

    /**
     * Runs after any update to the Livewire component's 
     * data (Using wire:model, not directly inside PHP)
     *
     * @return void
     */
    public function updated($property)
    {
        $this->validateOnly($property);
    }
  
    /**
     * Resets the input fields and 
     * opens the form modal.
     *
     * @return void
     */
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

        $fields = [
            'name' => $this->name, 
            'last_name' => $this->last_name, 
            'email' => $this->email, 
            'cpf' => $this->cpf, 
            'phone' => $this->phone, 
            'postcode' => $this->postcode, 
            'address' => $this->address, 
            'number' => $this->number, 
            'district' => $this->district, 
            'address_additional' => $this->address_additional, 
            'city' => $this->city, 
            'state' => $this->state, 
        ];

        // If the user retypes the password
        // when updating, then we should 
        // store the new password in database
        if ( ! empty($this->password)) {
            $fields['password'] = bcrypt($this->password);
        }

        User::updateOrCreate(['id' => $this->user_id], $fields);
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
     * Defines the default 
     * pagination view.
     *
     * @return string
     */
    public function paginationView()
    {
        return 'components.pagination';
    }

    /**
     * Make a request to the ViaCEP API
     * then returns the address informations 
     * based on a given postcode.
     * 
     * @return void
     */
    public function getPostcode()
    {
        // We only make a request to ViaCEP 
        // if our postcode is equal or greater 
        // than 9.
        if (strlen($this->postcode) >= 9) {

            // Makes a get request to ViaCEP API
            $response = Http::get('https://viacep.com.br/ws/' . $this->postcode . '/json/');
            $response = $response->json();

            // ViaCEP API returns an array with 
            // error setted to true, if the poste 
            // code can't be found.
            if(array_key_exists('erro', $response)) {
                $this->address = null;
                $this->city = null;
                $this->district = null;
                $this->state = null;

                // Thrown a custom validation message.
                $this->addError('postcode', 'CEP ' . $this->postcode . ' não encontrado.');

                return false;
            }

            $this->address = $response['logradouro'];
            $this->city = $response['localidade'];
            $this->district = $response['bairro'];
            $this->state = $response['uf'];
        }
    }
}