<div>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Categories') }}
            </h2>
        </x-slot>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <x-table>
                <div class="px-6 py-4 flex items-center">

                    <div class="flex items-center">
                        <span>Mostrar</span>
                        <select wire:model="cant" class="mx-2 form-control">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span>Categorias</span>
                    </div>

                    <x-jet-input class="flex-1 mx-4" type="text" placeholder="Buscar..." wire:model="search"></x-jet-input>
                    @livewire('create-category')
                </div>
                @if(count($categories))
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('id')"
                            >
                                Id
                                @if($sort == 'id')
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
                                wire:click="order('name')"
                            >
                                Name
                                @if($sort == 'name')
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
                            >
                                Created_At
                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Updated_at
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($categories as $category)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500">
                                        {{ $category->id }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500">
                                        {{ $category->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500">
                                        {{ $category->created_at }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500">
                                        {{ $category->updated_at }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a class="btn btn-green">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a class="btn btn-red ml-2">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        <!-- More people... -->
                        </tbody>
                    </table>

                    @if($categories->hasPages())
                        <div class="px-6 py-4">
                            {{ $categories->links() }}
                        </div>
                    @endif

                @else
                    <div class="px-6 py-4">
                        No matching record exists
                    </div>
                @endif

            </x-table>
        </div>
    </div>
</div>