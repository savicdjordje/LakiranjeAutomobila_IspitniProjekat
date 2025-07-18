@extends('layouts.public')

@section('title', 'Usluga #' . $service->id)

@section('content')
    <h2>Detalji usluge #{{ $service->id }}</h2>

    <p><strong>Klijent:</strong> {{ $service->vehicle->client->firstname . " " . $service->vehicle->client->lastname ?? 'Nepoznato' }}</p>
    <p><strong>Vozilo:</strong> {{ $service->vehicle->licence_plate }} - {{ $service->vehicle->make }} {{ $service->vehicle->model }}</p>
    <p><strong>Usluga:</strong> {{ $service->name }}</p>
    <p><strong>Opis:</strong> {{ $service->description }}</p>
    <p><strong>Status:</strong> {{ $service->status->name }}</p>

    <form method="POST" action="{{ route('employee.services.status', $service) }}" class="w3-margin-top">
        @csrf
        <label for="status_id">Izmeni status:</label>
        <select name="status_id" id="status_id" class="w3-select">
            @foreach ($statuses as $status)
                <option value="{{ $status->id }}" {{ $status->id === $service->status_id ? 'selected' : '' }}>
                    {{ $status->name }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="w3-button w3-blue w3-margin-top">Sačuvaj</button>
    </form>

    @if ($service->status->name === 'Završeno')
        @if ($service->bills)
            <p class="w3-panel w3-light-grey w3-margin-top"><strong>Račun:</strong> {{ $service->bills[0]->price }} RSD</p>
        @else
            <form method="POST" action="{{ route('employee.services.bill', $service) }}" class="w3-margin-top">
                @csrf
                <label for="price">Unesite cenu:</label>
                <input type="number" name="price" class="w3-input" step="0.01" required>
                <button type="submit" class="w3-button w3-green w3-margin-top">Dodaj račun</button>
            </form>
        @endif
    @endif
@endsection
