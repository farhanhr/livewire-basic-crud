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
        $this->name = "John";
        $this->email = "John@mail.com";
        $this->address = "Florida";


    }

    public function render()
    {
        return view('livewire.student');
    }
}
