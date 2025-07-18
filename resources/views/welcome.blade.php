@extends('layouts.public')

@section('title', 'Početna')

@section('content')
    <div class="w3-container w3-padding-64 w3-center">
        <h1 class="w3-jumbo">Dobrodošli u sistem za lakiranje automobila</h1>
        <p class="w3-large w3-padding-16">
            Naš sistem omogućava brzo zakazivanje, praćenje statusa usluge i automatsko generisanje računa. Sve što Vam treba – na jednom mestu.
        </p>
        <p class="w3-large">
            Bez stresa, bez čekanja – samo profesionalno lakiranje sa transparentnim informacijama o napretku svakog vozila.
        </p>

        @auth
            @if(auth()->user()->role === 'client')
                <a href="{{ route('client.services.create') }}" class="w3-button w3-red w3-padding-large w3-margin-top">Zakaži termin</a>
            @endif
        @else
            <a href="{{ route('login') }}" class="w3-button w3-blue w3-padding-large w3-margin-top">Prijavi se</a>
        @endauth
    </div>

    <div class="w3-container w3-padding-32">
        <h2 class="w3-center">Zašto baš mi?</h2>
        <div class="w3-row-padding w3-margin-top">
            <div class="w3-third">
                <div class="w3-card w3-padding w3-center">
                    <h3>Online zakazivanje</h3>
                    <p>Bez poziva, bez čekanja – samo kliknite i rezervišite svoj termin.</p>
                </div>
            </div>
            <div class="w3-third">
                <div class="w3-card w3-padding w3-center">
                    <h3>Status u realnom vremenu</h3>
                    <p>Pratite gde je vaše vozilo u svakom trenutku procesa lakiranja.</p>
                </div>
            </div>
            <div class="w3-third">
                <div class="w3-card w3-padding w3-center">
                    <h3>Transparentna naplata</h3>
                    <p>Račun se automatski generiše nakon završene usluge, bez skrivenih troškova.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
