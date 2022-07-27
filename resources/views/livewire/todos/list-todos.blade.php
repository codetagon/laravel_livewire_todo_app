<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Todos') }}
                </h2>

                <button wire:click="create" type="button"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">New
                    Todo</button>

                <x-jet-dialog-modal wire:model="modalOpened">
                    <x-slot name="title">
                        New Todo
                    </x-slot>

                    <x-slot name="content">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                            <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Enter title" wire:model="title">
                            @error('title')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </x-slot>

                    <x-slot name="footer">
                        <x-jet-secondary-button wire:click="$toggle('modalOpened')" wire:loading.attr="disabled">
                            Cancel
                        </x-jet-secondary-button>

                        <x-jet-button class="ml-2" wire:click="store" wire:loading.attr="disabled">
                            Submit
                        </x-jet-button>
                    </x-slot>
                </x-jet-dialog-modal>
            </div>
        </div>
    </header>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('message'))
                <div wire:poll="clearMessage"
                    class="bg-indigo-100 border-t-4 border-indigo-500 rounded-b text-indigo-900 px-4 py-3 shadow-md text-sm fixed bottom-4 right-4"
                    role="alert">
                    {{ session('message') }}
                </div>
            @endif
            @if ($todos->count() > 0)
                @foreach ($todos as $todo)
                    <livewire:todos.each-todo :todo="$todo" :wire:key="'each-todo-'.$todo->id">
                @endforeach
            @else
                <div class="text-center">Nothing found</div>
            @endif
        </div>
    </div>
</div>