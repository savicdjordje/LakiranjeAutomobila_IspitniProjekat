@extends('layouts.public')

@section('title', 'Moje usluge')

@section('content')
    <h2>Moje usluge</h2>

    @foreach ($services as $service)
        <div class="w3-card w3-padding w3-margin-bottom">
            <h3>{{ $service->name }}</h3>
            <p><strong>Vozilo:</strong> {{ $service->vehicle->licence_plate }} - {{ $service->vehicle->make }} {{ $service->vehicle->model }}</p>
            <p><strong>Status:</strong> {{ $service->status->name }}</p>
            @if ($service->status->name === 'Završeno')
                <a href="{{ route('client.services.invoice', $service) }}" class="w3-button w3-blue">Pregledaj račun</a>
            @endif
        </div>
    @endforeach
@endsection
