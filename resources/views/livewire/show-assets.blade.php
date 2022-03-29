<div>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Assets') }}
            </h2>
        </x-slot>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- This example requires Tailwind CSS v2.0+ -->
            <x-table>
                <div class="px-6 py-4 flex items-center">
                    <x-jet-input class="flex-1 mr-4" type="text" placeholder="search..." wire:model="search"></x-jet-input>
                    @livewire('create-asset')
                </div>
                @if($assets->count())
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('serial_number')"
                            >
                                Serial
                                @if($sort == 'serial_number')
                                    @if($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fa fa-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('brand')"
                            >
                                Brand
                                @if($sort == 'brand')
                                    @if($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fa fa-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('model')"
                            >
                                Model
                                @if($sort == 'model')
                                    @if($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fa fa-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Type
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Category
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date of entry
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                quantity
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($assets as $asset)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500">
                                        {{ $asset->serial_number }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500">
                                        {{ $asset->brand }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500">
                                        {{ $asset->model }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500">
                                        {{ $asset->type }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500">
                                        {{ $asset->category->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500">
                                        {{ $asset->status->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500">
                                        {{ $asset->date_of_entry }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500">
                                        {{ $asset->quantity }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a class="btn btn-green" wire:click="edit({{$asset}})">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        <!-- More people... -->
                        </tbody>
                    </table>
                @else
                    <div class="px-6 py-4">
                        No matching record exists
                    </div>
                @endif

                @if($assets->hasPages())
                    <div class="px-6 py-4">
                        {{ $assets->links() }}
                    </div>
                @endif


            </x-table>
        </div>

        @if($asset != null)
            <x-jet-dialog-modal wire:model="open_edit">
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
                    <x-jet-secondary-button wire:click="$set('open_edit', false)" class="mr-4">
                        Cancel
                    </x-jet-secondary-button>

                    <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update" class="disable:opacity-25">
                        Update asset
                    </x-jet-danger-button>
                </x-slot>
            </x-jet-dialog-modal>
        @endif

    </div>
</div>
