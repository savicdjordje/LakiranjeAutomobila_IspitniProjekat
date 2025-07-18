@extends('layouts.public')

@section('title', 'Moje usluge')

@section('content')
    <h2>Moje usluge</h2>

    @if($services->isEmpty())
        <p>Nemate dodeljenih usluga trenutno.</p>
    @else
        <table class="w3-table w3-striped w3-bordered w3-margin-top">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Klijent</th>
                    <th>Vozilo</th>
                    <th>Usluga</th>
                    <th>Status</th>
                    <th>Akcija</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->vehicle->client->firstname . " " . $service->vehicle->client->lastname ?? 'Nepoznato' }}</td>
                        <td>{{ $service->vehicle->licence_plate }}</td>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->status->name }}</td>
                        <td>
                            <a href="{{ route('employee.services.edit', $service) }}" class="w3-button w3-blue">Detalji</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
