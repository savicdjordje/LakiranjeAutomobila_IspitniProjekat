@extends('layouts.public')

@section('title', 'Račun za uslugu')

@section('content')
    <h2>Račun za uslugu</h2>

    <p><strong>Usluga:</strong> {{ $service->name }}</p>
    <p><strong>Opis:</strong> {{ $service->description }}</p>
    <p><strong>Vozilo:</strong> {{ $service->vehicle->registarski_broj }}</p>
    <p><strong>Status:</strong> {{ $service->status->name }}</p>

    @if ($bill)
        <p><strong>Iznos za naplatu:</strong> {{ number_format($bill->price, 2) }} RSD</p>
    @else
        <p style="color: red">Račun još nije generisan.</p>
    @endif
@endsection
