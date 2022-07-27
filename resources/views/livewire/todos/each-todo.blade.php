<div
    class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4  flex px-5 py-4 items-center cursor-pointer justify-between">
    <div class="flex items-center">
        <input wire:change="changeStatus({{ $todo->id }})" @if ($todo->status) checked @endif
            type="checkbox" name="status"
            class="mr-4 text-indigo-600 bg-gray-100 rounded border-gray-300 focus:ring-indigo-500 focus:ring-2" />
        <div wire:click="changeStatus({{ $todo->id }})" class="select-none">{{ $todo->title }}
        </div>
    </div>
    <div class="flex space-x-4 text-sm">
        <button wire:click="$set('editModal', true)">Edit</button>
        <button wire:click="$set('deleteModal', true)" class="text-red-600">Delete</button>
    </div>

    <x-jet-dialog-modal wire:model="editModal">
        <x-slot name="title">
            Edit Todo
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
            <x-jet-secondary-button wire:click="$toggle('editModal')" wire:loading.attr="disabled">
                Cancel
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                Submit
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>


    <x-jet-dialog-modal wire:model="deleteModal">
        <x-slot name="title">
            Delete Modal
        </x-slot>

        <x-slot name="content">
            <div>Are you sure you want to delete <strong>{{$todo->title}}</strong>? </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('deleteModal')" wire:loading.attr="disabled">
                Cancel
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                Delete Todo
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>