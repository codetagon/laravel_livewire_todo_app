<?php

namespace App\Http\Livewire\Todos;

use Livewire\Component;
use App\Models\Todo;

class EachTodo extends Component {
    public Todo $todo;
    public $title, $editModal = false, $deleteModal = false;

    public function mount( $todo ) {
        $this->title = $todo->title;
    }

    public function render() {
        return view( 'livewire.todos.each-todo' );
    }

    public function update() {
        $this->validate([
            'title' => 'required|string|max:500'
        ]);

        $this->todo->update([
            'title' => $this->title
        ]);
        $this->editModal = false;
        $this->emitUp( 'notify', 'Todo Updated Successfully.' );
    }

    public function delete()
    {
        $this->todo->delete();
        $this->emitUp( 'notify', 'Todo Deleted Successfully.' );
    }


    public function changeStatus( $id ) {
        $this->todo->status = !$this->todo->status;
        $this->todo->save();
        $this->emitUp( 'notify', 'Todo status changed Successfully.' );
    }
}
