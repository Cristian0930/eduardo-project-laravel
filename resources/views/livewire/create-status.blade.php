<div>
    <x-jet-danger-button wire:click="$set('open', true)">
        Create new status
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Create new status
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <x-jet-label value="Name" />
                <x-jet-input type="text" class="w-full" wire:model.defer="name"/>

                <x-jet-input-error for="name" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)" class="mr-4">
                Cancel
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disable:opacity-25">
                Create status
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>


