<div>
    <div class="flex justify-between align-top py-4">
        <x-ui.input
            wire:model.live="detailVehiclesSearch"
            type="text"
            placeholder="Search {{ __('crud.vehicles.collectionTitle') }}..."
        />

        @can('create', App\Models\Vehicle::class)
        <a wire:click="newVehicle()">
            <x-ui.button>New</x-ui.button>
        </a>
        @endcan
    </div>

    {{-- Modal --}}
    <x-ui.modal wire:model="showingModal">
        <div class="overflow-hidden border rounded-lg bg-white">
            <form class="w-full mb-0" wire:submit.prevent="save">
                <div class="p-6 space-y-3">
                    <div class="w-full">
                        <x-ui.label for="licence_plate"
                            >{{ __('crud.vehicles.inputs.licence_plate.label')
                            }}</x-ui.label
                        >
                        <x-ui.input.text
                            class="w-full"
                            wire:model="form.licence_plate"
                            name="licence_plate"
                            id="licence_plate"
                            placeholder="{{ __('crud.vehicles.inputs.licence_plate.placeholder') }}"
                        />
                        <x-ui.input.error for="form.licence_plate" />
                    </div>

                    <div class="w-full">
                        <x-ui.label for="make"
                            >{{ __('crud.vehicles.inputs.make.label')
                            }}</x-ui.label
                        >
                        <x-ui.input.text
                            class="w-full"
                            wire:model="form.make"
                            name="make"
                            id="make"
                            placeholder="{{ __('crud.vehicles.inputs.make.placeholder') }}"
                        />
                        <x-ui.input.error for="form.make" />
                    </div>

                    <div class="w-full">
                        <x-ui.label for="model"
                            >{{ __('crud.vehicles.inputs.model.label')
                            }}</x-ui.label
                        >
                        <x-ui.input.text
                            class="w-full"
                            wire:model="form.model"
                            name="model"
                            id="model"
                            placeholder="{{ __('crud.vehicles.inputs.model.placeholder') }}"
                        />
                        <x-ui.input.error for="form.model" />
                    </div>

                    <div class="w-full">
                        <x-ui.label for="year"
                            >{{ __('crud.vehicles.inputs.year.label')
                            }}</x-ui.label
                        >
                        <x-ui.input.date
                            class="w-full"
                            wire:model="form.year"
                            name="year"
                            id="year"
                        />
                        <x-ui.input.error for="form.year" />
                    </div>
                </div>

                <div
                    class="flex justify-between mt-4 border-t border-gray-50 bg-gray-50 p-4"
                >
                    <div>
                        <!-- Other buttons here -->
                    </div>
                    <div>
                        <x-ui.button type="submit">Save</x-ui.button>
                    </div>
                </div>
            </form>
        </div>
    </x-ui.modal>

    {{-- Delete Modal --}}
    <x-ui.modal.confirm wire:model="confirmingVehicleDeletion">
        <x-slot name="title"> {{ __('Delete') }} </x-slot>

        <x-slot name="content"> {{ __('Are you sure?') }} </x-slot>

        <x-slot name="footer">
            <x-ui.button
                wire:click="$toggle('confirmingVehicleDeletion')"
                wire:loading.attr="disabled"
            >
                {{ __('Cancel') }}
            </x-ui.button>

            <x-ui.button.danger
                class="ml-3"
                wire:click="deleteVehicle({{ $deletingVehicle }})"
                wire:loading.attr="disabled"
            >
                {{ __('Delete') }}
            </x-ui.button.danger>
        </x-slot>
    </x-ui.modal.confirm>

    {{-- Index Table --}}
    <x-ui.container.table>
        <x-ui.table>
            <x-slot name="head">
                <x-ui.table.header
                    for-detailCrud
                    wire:click="sortBy('licence_plate')"
                    >{{ __('crud.vehicles.inputs.licence_plate.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header for-detailCrud wire:click="sortBy('make')"
                    >{{ __('crud.vehicles.inputs.make.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header for-detailCrud wire:click="sortBy('model')"
                    >{{ __('crud.vehicles.inputs.model.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header for-detailCrud wire:click="sortBy('year')"
                    >{{ __('crud.vehicles.inputs.year.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.action-header>Actions</x-ui.table.action-header>
            </x-slot>

            <x-slot name="body">
                @forelse ($detailVehicles as $vehicle)
                <x-ui.table.row wire:loading.class.delay="opacity-75">
                    <x-ui.table.column for-detailCrud
                        >{{ $vehicle->licence_plate }}</x-ui.table.column
                    >
                    <x-ui.table.column for-detailCrud
                        >{{ $vehicle->make }}</x-ui.table.column
                    >
                    <x-ui.table.column for-detailCrud
                        >{{ $vehicle->model }}</x-ui.table.column
                    >
                    <x-ui.table.column for-detailCrud
                        >{{ $vehicle->year }}</x-ui.table.column
                    >
                    <x-ui.table.action-column>
                        @can('update', $vehicle)
                        <x-ui.action
                            wire:click="editVehicle({{ $vehicle->id }})"
                            >Edit</x-ui.action
                        >
                        @endcan @can('delete', $vehicle)
                        <x-ui.action.danger
                            wire:click="confirmVehicleDeletion({{ $vehicle->id }})"
                            >Delete</x-ui.action.danger
                        >
                        @endcan
                    </x-ui.table.action-column>
                </x-ui.table.row>
                @empty
                <x-ui.table.row>
                    <x-ui.table.column colspan="5"
                        >No {{ __('crud.vehicles.collectionTitle') }} found.</x-ui.table.column
                    >
                </x-ui.table.row>
                @endforelse
            </x-slot>
        </x-ui.table>

        <div class="mt-2">{{ $detailVehicles->links() }}</div>
    </x-ui.container.table>
</div>
