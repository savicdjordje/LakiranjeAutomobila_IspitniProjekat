<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 space-y-4">
    <x-ui.breadcrumbs>
        <x-ui.breadcrumbs.link href="/dashboard"
            >Dashboard</x-ui.breadcrumbs.link
        >
        <x-ui.breadcrumbs.separator />
        <x-ui.breadcrumbs.link active
            >{{ __('crud.vehicles.collectionTitle') }}</x-ui.breadcrumbs.link
        >
    </x-ui.breadcrumbs>

    <div class="flex justify-between align-top py-4">
        <x-ui.input
            wire:model.live="search"
            type="text"
            placeholder="Search {{ __('crud.vehicles.collectionTitle') }}..."
        />

        @can('create', App\Models\Vehicle::class)
        <a wire:navigate href="{{ route('dashboard.vehicles.create') }}">
            <x-ui.button>New</x-ui.button>
        </a>
        @endcan
    </div>

    {{-- Delete Modal --}}
    <x-ui.modal.confirm wire:model="confirmingDeletion">
        <x-slot name="title"> {{ __('Delete') }} </x-slot>

        <x-slot name="content"> {{ __('Are you sure?') }} </x-slot>

        <x-slot name="footer">
            <x-ui.button
                wire:click="$toggle('confirmingDeletion')"
                wire:loading.attr="disabled"
            >
                {{ __('Cancel') }}
            </x-ui.button>

            <x-ui.button.danger
                class="ml-3"
                wire:click="delete({{ $deletingVehicle }})"
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
                <x-ui.table.header for-crud wire:click="sortBy('licence_plate')"
                    >{{ __('crud.vehicles.inputs.licence_plate.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header for-crud wire:click="sortBy('make')"
                    >{{ __('crud.vehicles.inputs.make.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header for-crud wire:click="sortBy('model')"
                    >{{ __('crud.vehicles.inputs.model.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header for-crud wire:click="sortBy('year')"
                    >{{ __('crud.vehicles.inputs.year.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header for-crud wire:click="sortBy('client_id')"
                    >{{ __('crud.vehicles.inputs.client_id.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.action-header>Actions</x-ui.table.action-header>
            </x-slot>

            <x-slot name="body">
                @forelse ($vehicles as $vehicle)
                <x-ui.table.row wire:loading.class.delay="opacity-75">
                    <x-ui.table.column for-crud
                        >{{ $vehicle->licence_plate }}</x-ui.table.column
                    >
                    <x-ui.table.column for-crud
                        >{{ $vehicle->make }}</x-ui.table.column
                    >
                    <x-ui.table.column for-crud
                        >{{ $vehicle->model }}</x-ui.table.column
                    >
                    <x-ui.table.column for-crud
                        >{{ $vehicle->year }}</x-ui.table.column
                    >
                    <x-ui.table.column for-crud
                        >{{ $vehicle->client_id }}</x-ui.table.column
                    >
                    <x-ui.table.action-column>
                        @can('update', $vehicle)
                        <x-ui.action
                            wire:navigate
                            href="{{ route('dashboard.vehicles.edit', $vehicle) }}"
                            >Edit</x-ui.action
                        >
                        @endcan @can('delete', $vehicle)
                        <x-ui.action.danger
                            wire:click="confirmDeletion({{ $vehicle->id }})"
                            >Delete</x-ui.action.danger
                        >
                        @endcan
                    </x-ui.table.action-column>
                </x-ui.table.row>
                @empty
                <x-ui.table.row>
                    <x-ui.table.column colspan="6"
                        >No {{ __('crud.vehicles.collectionTitle') }} found.</x-ui.table.column
                    >
                </x-ui.table.row>
                @endforelse
            </x-slot>
        </x-ui.table>

        <div class="mt-2">{{ $vehicles->links() }}</div>
    </x-ui.container.table>
</div>
