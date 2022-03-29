<div>
    <a class="btn btn-green" wire:click="$set('open', true)">
        <i class="fa fa-edit"></i>
    </a>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Edit asset: {{ $asset->serial_number }}
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <x-jet-label value="Serial number" />
                <x-jet-input type="text" class="w-full" wire:model.defer="asset.serial_number"/>

                <x-jet-input-error for="serial_number" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Brand" />
                <x-jet-input type="text" class="w-full" wire:model.defer="asset.brand"/>

                <x-jet-input-error for="brand" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Model" />
                <x-jet-input type="text" class="w-full" wire:model.defer="asset.model"/>

                <x-jet-input-error for="model" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Type" />
                <x-jet-input type="text" class="w-full" wire:model.defer="asset.type"/>

                <x-jet-input-error for="type" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Category" />
                <select wire:model.defer="asset.category_id" class="form-control w-full">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <x-jet-input-error for="category_id" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Status" />
                <select wire:model.defer="asset.status_id" class="form-control w-full">
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}">
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>

                <x-jet-input-error for="status_id" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Explanation" />
                <textarea wire:model.defer="asset.explanation" class="form-control w-full" rows="6"></textarea>

                <x-jet-input-error for="explanation" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Date of entry" />
                <x-jet-input wire:model.defer="asset.date_of_entry" type="datetime-local" class="w-full"/>

                <x-jet-input-error for="date_of_entry" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Quantity" />
                <x-jet-input wire:model.defer="asset.quantity" type="number" class="w-full"/>

                <x-jet-input-error for="quantity" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)" class="mr-4">
                Cancel
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update" class="disable:opacity-25">
                Update asset
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
