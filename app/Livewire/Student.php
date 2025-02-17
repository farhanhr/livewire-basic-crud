<?php

namespace App\Livewire;

use App\Models\Student as ModelsStudent;
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
        $validated = $this->validate($rules);
        ModelsStudent::create($validated);

        session()->flash('message', 'Data created successfully');

    }

    public function render()
    {
        return view('livewire.student');
    }
}
