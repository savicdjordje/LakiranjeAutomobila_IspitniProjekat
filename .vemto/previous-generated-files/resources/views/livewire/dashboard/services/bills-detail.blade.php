<div>
    <div class="flex justify-between align-top py-4">
        <x-ui.input
            wire:model.live="detailBillsSearch"
            type="text"
            placeholder="Search {{ __('crud.bills.collectionTitle') }}..."
        />

        @can('create', App\Models\Bill::class)
        <a wire:click="newBill()">
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
                        <x-ui.label for="price"
                            >{{ __('crud.bills.inputs.price.label')
                            }}</x-ui.label
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
    <x-ui.modal.confirm wire:model="confirmingBillDeletion">
        <x-slot name="title"> {{ __('Delete') }} </x-slot>

        <x-slot name="content"> {{ __('Are you sure?') }} </x-slot>

        <x-slot name="footer">
            <x-ui.button
                wire:click="$toggle('confirmingBillDeletion')"
                wire:loading.attr="disabled"
            >
                {{ __('Cancel') }}
            </x-ui.button>

            <x-ui.button.danger
                class="ml-3"
                wire:click="deleteBill({{ $deletingBill }})"
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
                <x-ui.table.header for-detailCrud wire:click="sortBy('price')"
                    >{{ __('crud.bills.inputs.price.label')
                    }}</x-ui.table.header
                >
                <x-ui.table.action-header>Actions</x-ui.table.action-header>
            </x-slot>

            <x-slot name="body">
                @forelse ($detailBills as $bill)
                <x-ui.table.row wire:loading.class.delay="opacity-75">
                    <x-ui.table.column for-detailCrud
                        >{{ $bill->price }}</x-ui.table.column
                    >
                    <x-ui.table.action-column>
                        @can('update', $bill)
                        <x-ui.action wire:click="editBill({{ $bill->id }})"
                            >Edit</x-ui.action
                        >
                        @endcan @can('delete', $bill)
                        <x-ui.action.danger
                            wire:click="confirmBillDeletion({{ $bill->id }})"
                            >Delete</x-ui.action.danger
                        >
                        @endcan
                    </x-ui.table.action-column>
                </x-ui.table.row>
                @empty
                <x-ui.table.row>
                    <x-ui.table.column colspan="2"
                        >No {{ __('crud.bills.collectionTitle') }} found.</x-ui.table.column
                    >
                </x-ui.table.row>
                @endforelse
            </x-slot>
        </x-ui.table>

        <div class="mt-2">{{ $detailBills->links() }}</div>
    </x-ui.container.table>
</div>
