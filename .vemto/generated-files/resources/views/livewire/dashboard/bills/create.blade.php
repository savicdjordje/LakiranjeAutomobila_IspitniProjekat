<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 space-y-4">
    <x-ui.breadcrumbs>
        <x-ui.breadcrumbs.link href="/dashboard"
            >Dashboard</x-ui.breadcrumbs.link
        >
        <x-ui.breadcrumbs.separator />
        <x-ui.breadcrumbs.link href="{{ route('dashboard.bills.index') }}"
            >{{ __('crud.bills.collectionTitle') }}</x-ui.breadcrumbs.link
        >
        <x-ui.breadcrumbs.separator />
        <x-ui.breadcrumbs.link active
            >Create {{ __('crud.bills.itemTitle') }}</x-ui.breadcrumbs.link
        >
    </x-ui.breadcrumbs>

    <div class="w-full text-gray-500 text-lg font-semibold py-4 uppercase">
        <h1>Create {{ __('crud.bills.itemTitle') }}</h1>
    </div>

    <div class="overflow-hidden border rounded-lg bg-white">
        <form class="w-full mb-0" wire:submit.prevent="save">
            <div class="p-6 space-y-3">
                <div class="w-full">
                    <x-ui.label for="service_id"
                        >{{ __('crud.bills.inputs.service_id.label')
                        }}</x-ui.label
                    >
                    <x-ui.input.select
                        wire:model="form.service_id"
                        name="service_id"
                        id="service_id"
                        class="w-full"
                    >
                        <option value="">Select data</option>
                        @foreach ($services as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </x-ui.input.select>
                    <x-ui.input.error for="form.service_id" />
                </div>

                <div class="w-full">
                    <x-ui.label for="price"
                        >{{ __('crud.bills.inputs.price.label') }}</x-ui.label
                    >
                    <x-ui.input.number
                        class="w-full"
                        wire:model="form.price"
                        name="price"
                        id="price"
                        placeholder="{{ __('crud.bills.inputs.price.placeholder') }}"
                        step="1"
                    />
                    <x-ui.input.error for="form.price" />
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
</div>
