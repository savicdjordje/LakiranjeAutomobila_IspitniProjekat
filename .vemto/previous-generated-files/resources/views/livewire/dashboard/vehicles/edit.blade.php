<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 space-y-4">
    <x-ui.breadcrumbs>
        <x-ui.breadcrumbs.link href="/dashboard"
            >Dashboard</x-ui.breadcrumbs.link
        >
        <x-ui.breadcrumbs.separator />
        <x-ui.breadcrumbs.link href="{{ route('dashboard.vehicles.index') }}"
            >{{ __('crud.vehicles.collectionTitle') }}</x-ui.breadcrumbs.link
        >
        <x-ui.breadcrumbs.separator />
        <x-ui.breadcrumbs.link active
            >Edit {{ __('crud.vehicles.itemTitle') }}</x-ui.breadcrumbs.link
        >
    </x-ui.breadcrumbs>

    <x-ui.toast on="saved"> Vehicle saved successfully. </x-ui.toast>

    <div class="w-full text-gray-500 text-lg font-semibold py-4 uppercase">
        <h1>Edit {{ __('crud.vehicles.itemTitle') }}</h1>
    </div>

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
                        >{{ __('crud.vehicles.inputs.make.label') }}</x-ui.label
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
                        >{{ __('crud.vehicles.inputs.year.label') }}</x-ui.label
                    >
                    <x-ui.input.date
                        class="w-full"
                        wire:model="form.year"
                        name="year"
                        id="year"
                    />
                    <x-ui.input.error for="form.year" />
                </div>

                <div class="w-full">
                    <x-ui.label for="client_id"
                        >{{ __('crud.vehicles.inputs.client_id.label')
                        }}</x-ui.label
                    >
                    <x-ui.input.select
                        wire:model="form.client_id"
                        name="client_id"
                        id="client_id"
                        class="w-full"
                    >
                        <option value="">Select data</option>
                        @foreach ($users as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </x-ui.input.select>
                    <x-ui.input.error for="form.client_id" />
                </div>
            </div>

            <div class="flex justify-between mt-4 border-t border-gray-50 p-4">
                <div>
                    <!-- Other buttons here -->
                </div>
                <div>
                    <x-ui.button type="submit">Save</x-ui.button>
                </div>
            </div>
        </form>
    </div>

    @can('view-any', App\Models\Service::class)
    <div class="overflow-hidden border rounded-lg bg-white">
        <div class="w-full mb-0">
            <div class="p-6 space-y-3">
                <div
                    class="w-full text-gray-500 text-lg font-semibold py-4 uppercase"
                >
                    <h2>{{ __('crud.services.collectionTitle') }}</h2>
                </div>

                <livewire:dashboard.vehicle-services-detail
                    :vehicle="$vehicle"
                />
            </div>
        </div>
    </div>
    @endcan
</div>
