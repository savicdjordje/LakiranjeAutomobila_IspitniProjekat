<div>
    <div class="flex justify-between align-top py-4">
        <x-ui.input
            wire:model.live="detailServicesSearch"
            type="text"
            placeholder="Search {{ __('crud.services.collectionTitle') }}..."
        />

        @can('create', App\Models\Service::class)
        <a wire:click="newService()">
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
                            @foreach ($users as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </x-ui.input.select>
                        <x-ui.input.error for="form.employee_id" />
                    </div>

                    <div class="w-full">
                        <x-ui.label for="admin_id"
                            >{{ __('crud.services.inputs.admin_id.label')
                            }}</x-ui.label
                        >
                        <x-ui.input.select
                            wire:model="form.admin_id"
                            name="admin_id"
                            id="admin_id"
                            class="w-full"
                        >
                            <option value="">Select data</option>
                            @foreach ($users as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </x-ui.input.select>
                        <x-ui.input.error for="form.admin_id" />
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
                            >{{ __('crud.services.inputs.name.label')
                            }}</x-ui.label
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
    <x-ui.modal.confirm wire:model="confirmingServiceDeletion">
        <x-slot name="title"> {{ __('Delete') }} </x-slot>

        <x-slot name="content"> {{ __('Are you sure?') }} </x-slot>

        <x-slot name="footer">
            <x-ui.button
                wire:click="$toggle('confirmingServiceDeletion')"
                wire:loading.attr="disabled"
            >
                {{ __('Cancel') }}
            </x-ui.button>

            <x-ui.button.danger
                class="ml-3"
                wire:click="deleteService({{ $deletingService }})"
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
                    wire:click="sortBy('employee_id')"
                    >{{ __('crud.services.inputs.employee_id.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header
                    for-detailCrud
                    wire:click="sortBy('admin_id')"
                    >{{ __('crud.services.inputs.admin_id.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header
                    for-detailCrud
                    wire:click="sortBy('status_id')"
                    >{{ __('crud.services.inputs.status_id.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header for-detailCrud wire:click="sortBy('name')"
                    >{{ __('crud.services.inputs.name.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.header
                    for-detailCrud
                    wire:click="sortBy('description')"
                    >{{ __('crud.services.inputs.description.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.action-header>Actions</x-ui.table.action-header>
            </x-slot>

            <x-slot name="body">
                @forelse ($detailServices as $service)
                <x-ui.table.row wire:loading.class.delay="opacity-75">
                    <x-ui.table.column for-detailCrud
                        >{{ $service->employee_id }}</x-ui.table.column
                    >
                    <x-ui.table.column for-detailCrud
                        >{{ $service->admin_id }}</x-ui.table.column
                    >
                    <x-ui.table.column for-detailCrud
                        >{{ $service->status_id }}</x-ui.table.column
                    >
                    <x-ui.table.column for-detailCrud
                        >{{ $service->name }}</x-ui.table.column
                    >
                    <x-ui.table.column for-detailCrud
                        >{{ $service->description }}</x-ui.table.column
                    >
                    <x-ui.table.action-column>
                        @can('update', $service)
                        <x-ui.action
                            wire:click="editService({{ $service->id }})"
                            >Edit</x-ui.action
                        >
                        @endcan @can('delete', $service)
                        <x-ui.action.danger
                            wire:click="confirmServiceDeletion({{ $service->id }})"
                            >Delete</x-ui.action.danger
                        >
                        @endcan
                    </x-ui.table.action-column>
                </x-ui.table.row>
                @empty
                <x-ui.table.row>
                    <x-ui.table.column colspan="6"
                        >No {{ __('crud.services.collectionTitle') }} found.</x-ui.table.column
                    >
                </x-ui.table.row>
                @endforelse
            </x-slot>
        </x-ui.table>

        <div class="mt-2">{{ $detailServices->links() }}</div>
    </x-ui.container.table>
</div>
