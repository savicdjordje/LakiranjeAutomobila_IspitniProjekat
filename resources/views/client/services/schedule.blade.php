@extends('layouts.public')

@section('title', 'Zakazivanje usluge')

@section('content')
<h2>Zakazivanje usluge</h2>

<div class="w3-margin-bottom">
    <button type="button" class="w3-button w3-blue toggle-btn" data-target="existing">Izaberi postojeće vozilo</button>
    <button type="button" class="w3-button w3-blue toggle-btn" data-target="new">Dodaj novo vozilo</button>
</div>

<form method="POST" action="{{ route('client.services.store') }}" class="w3-container">
    @csrf

    {{-- POSTOJEĆE VOZILO --}}
    <div id="existing-vehicle-section" style="display: none;">
        <label for="vehicle_id">Vozilo</label>
        <select name="vehicle_id" id="vehicle_id" class="w3-select">
            <option value="">-- Izaberi vozilo --</option>
            @foreach ($vehicles as $vehicle)
                <option value="{{ $vehicle->id }}">
                    {{ $vehicle->licence_plate }} - {{ $vehicle->make }} {{ $vehicle->model }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- NOVO VOZILO --}}
    <div id="new-vehicle-section" style="display: none;" class="w3-row-padding w3-margin-top w3-light-grey w3-round">
        <div class="w3-col m6">
            <label for="new_licence_plate">Registarski broj</label>
            <input type="text" name="new_licence_plate" class="w3-input">
        </div>
        <div class="w3-col m6">
            <label for="new_make">Marka</label>
            <input type="text" name="new_make" class="w3-input">
        </div>
        <div class="w3-col m6">
            <label for="new_model">Model</label>
            <input type="text" name="new_model" class="w3-input">
        </div>
        <div class="w3-col m6">
            <label for="new_year">Datum proizvodnje</label>
            <input type="date" name="new_year" class="w3-input">
        </div>
    </div>

    <label for="name" class="w3-margin-top">Zahtev</label>
    <input type="text" name="name" class="w3-input" required>

    <label for="description">Opis</label>
    <textarea name="description" class="w3-input"></textarea>

    <button type="submit" class="w3-button w3-green w3-margin-top">Zakaži</button>
</form>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('.toggle-btn').on('click', function () {
        const target = $(this).data('target');
        $('#existing-vehicle-section').hide();
        $('#new-vehicle-section').hide();

        if (target === 'existing') {
            $('#existing-vehicle-section').show();
        } else if (target === 'new') {
            $('#new-vehicle-section').show();
        }
    });
</script>
@endpush
