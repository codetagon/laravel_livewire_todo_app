<?php

namespace App\Http\Livewire\Todos;

use Livewire\Component;
use App\Models\Todo;

class ListTodos extends Component
{

    public $todos, $title, $modalOpened = false;

    protected $listeners = ['notify'];

    public function render()
    {
        $this->todos = Todo::oldest('status')->latest()->get();
        return view('livewire.todos.list-todos');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->modalOpened = true;
    }

    public function closeModal()
    {
        $this->modalOpened = false;
    }

    private function resetInputFields(){
        $this->title = '';
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|string|max:500'
        ]);
   
        Todo::create([
            'title' => $this->title
        ]);
  
        session()->flash('message', 'Todo Created Successfully.');
  
        $this->closeModal();
        $this->resetInputFields();
    }

    public function notify($message)
    {
        session()->flash("message", $message);
    }

    public function clearMessage()
    {
        session()->forget('message');
    }
}
