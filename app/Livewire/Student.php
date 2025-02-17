<?php

namespace App\Livewire;

use App\Models\Student as ModelsStudent;
use Livewire\Component;
use Livewire\WithPagination;

class Student extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //This variabel bellow is called properties
    public $name;
    public $email;
    public $address;
    public $updateData = false;
    public $studentId;

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

    public function edit($id) 
    {
        $data = ModelsStudent::find($id);
        $this->name = $data->name;
        $this->email = $data->email;
        $this->address = $data->address;
        $this->updateData = true;
        $this->studentId = $id;
    }

    public function update()
    {
          $rules = [
            'name' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
        ];
        $validated = $this->validate($rules);
        $data = ModelsStudent::find($this->studentId);
        $data->update($validated);

        session()->flash('message', 'Data updated successfully');
    }

    public function render()
    {
        $data = ModelsStudent::orderBy('name', 'asc')->paginate(5);

        return view('livewire.student', ['studentsData'=>$data]);
    }
}
