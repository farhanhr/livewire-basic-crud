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
    public $searchKey;
    public $student_selected_id = [];

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

        $this->clear();
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
        
        $this->clear();
    }
    
    public function delete()
    {
        if ($this->studentId != '') {
            $id = $this->studentId;
            ModelsStudent::find($id)->delete();
        }
        if (count($this->student_selected_id)) {
            for($x=0; $x<count($this->student_selected_id); $x++) {
                ModelsStudent::find($this->student_selected_id[$x])->delete();
            }
        }
        $this->clear();
        session()->flash('message', 'Data deleted successfully');
    }

    public function delete_confirmation($id)
    {
        if ($id != '') {
            $this->studentId = $id;
        }
    }

    public function clear() 
    {
        $this->name = '';
        $this->email = '';
        $this->address = '';
        $this->updateData = false;
        $this->studentId = '';
        $this->student_selected_id= [];
    }

    public function render()
    {
        if($this->searchKey != null) {
            $data = ModelsStudent::where('name', 'like', '%'.$this->searchKey.'%')->orWhere('address', 'like', '%'.$this->searchKey.'%')->orderBy('name', 'asc')->paginate(3);
        } else {
            $data = ModelsStudent::orderBy('name', 'asc')->paginate(3);
        }

        return view('livewire.student', ['studentsData'=>$data]);
    }
}
