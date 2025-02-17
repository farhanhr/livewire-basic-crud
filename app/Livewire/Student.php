<?php

namespace App\Livewire;

use Livewire\Component;

class Student extends Component
{
    //This variabel bellow is called properties
    public $name;
    public $email;
    public $address;

    public function store()
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
        ];
        $validate = $this->validate($rules);

    }

    public function render()
    {
        return view('livewire.student');
    }
}
