<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 space-y-4">
    <x-ui.breadcrumbs>
        <x-ui.breadcrumbs.link href="/dashboard"
            >Dashboard</x-ui.breadcrumbs.link
        >
        <x-ui.breadcrumbs.separator />
        <x-ui.breadcrumbs.link href="{{ route('dashboard.services.index') }}"
            >{{ __('crud.services.collectionTitle') }}</x-ui.breadcrumbs.link
        >
        <x-ui.breadcrumbs.separator />
        <x-ui.breadcrumbs.link active
            >Edit {{ __('crud.services.itemTitle') }}</x-ui.breadcrumbs.link
        >
    </x-ui.breadcrumbs>

    <x-ui.toast on="saved"> Service saved successfully. </x-ui.toast>

    <div class="w-full text-gray-500 text-lg font-semibold py-4 uppercase">
        <h1>Edit {{ __('crud.services.itemTitle') }}</h1>
    </div>

    <div class="overflow-hidden border rounded-lg bg-white">
        <form class="w-full mb-0" wire:submit.prevent="save">
            <div class="p-6 space-y-3">
                <div class="w-full">
                    <x-ui.label for="vehicle_id"
                        >{{ __('crud.services.inputs.vehicle_id.label')
                        }}</x-ui.label
                    >
                    <x-ui.input.select
                        wire:model="form.vehicle_id"
                        name="vehicle_id"
                        id="vehicle_id"
                        class="w-full"
                    >
                        <option value="">Select data</option>
                        @foreach ($vehicles as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </x-ui.input.select>
                    <x-ui.input.error for="form.vehicle_id" />
                </div>

                <div class="w-full">
                    <x-ui.label for="employee_id"
                        >{{ __('crud.services.inputs.employee_id.label')
                        }}</x-ui.label
                    >
                    <x-ui.input.select
                        wire:model="form.employee_id"
                        name="employee_id"
                        id="employee_id"
                        class="w-full"
                    >
                        <option value="">Select data</option>
                        @foreach ($employees as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </x-ui.input.select>
                    <x-ui.input.error for="form.employee_id" />
                </div>

                <div class="w-full">
                    <x-ui.label for="status_id"
                        >{{ __('crud.services.inputs.status_id.label')
                        }}</x-ui.label
                    >
                    <x-ui.input.select
                        wire:model="form.status_id"
                        name="status_id"
                        id="status_id"
                        class="w-full"
                    >
                        <option value="">Select data</option>
                        @foreach ($statuses as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </x-ui.input.select>
                    <x-ui.input.error for="form.status_id" />
                </div>

                <div class="w-full">
                    <x-ui.label for="name"
                        >{{ __('crud.services.inputs.name.label') }}</x-ui.label
                    >
                    <x-ui.input.text
                        class="w-full"
                        wire:model="form.name"
                        name="name"
                        id="name"
                        placeholder="{{ __('crud.services.inputs.name.placeholder') }}"
                    />
                    <x-ui.input.error for="form.name" />
                </div>

                <div class="w-full">
                    <x-ui.label for="description"
                        >{{ __('crud.services.inputs.description.label')
                        }}</x-ui.label
                    >
                    <x-ui.input.textarea
                        class="w-full"
                        wire:model="form.description"
                        rows="6"
                        name="description"
                        id="description"
                        placeholder="{{ __('crud.services.inputs.description.placeholder') }}"
                    />
                    <x-ui.input.error for="form.description" />
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

    @can('view-any', App\Models\Bill::class)
    <div class="overflow-hidden border rounded-lg bg-white">
        <div class="w-full mb-0">
            <div class="p-6 space-y-3">
                <div
                    class="w-full text-gray-500 text-lg font-semibold py-4 uppercase"
                >
                    <h2>{{ __('crud.bills.collectionTitle') }}</h2>
                </div>

                <livewire:dashboard.service-bills-detail :service="$service" />
            </div>
        </div>
    </div>
    @endcan
</div>
