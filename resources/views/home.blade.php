@extends('layouts.app')


@section('content')
  <div class="container">
    <h1>KBBC T&T Turnhout</h1>
    <div class="col-md-12"> 
      <h3> Wedstrijden deze week </h3>
      @include('includecomponents.pastgametable', ["matches" => $this_week_matches])
    </div>
    <!-- Volgende week -->
    <div class="col-md-6"> 
      <h3> Wedstrijden volgende week </h3>
      @include('includecomponents.futuregametable', ["matches" => $next_week_matches])
    </div>
    <!-- Vorige week -->
    <div class="col-md-6"> 
      <h3> Wedstrijden vorige week</h3>
      @include('includecomponents.pastgametable', ["matches" => $prev_week_matches])
    </div>
  </div>
@endsection

@section('scripts')

  @foreach($this_week_matches as $match)
    @php
      $dt = date_create_from_format("d-m-Y G.i", $match->datumString." ".$match->beginTijd);
      $startDate = date_format($dt, DateTime::ATOM)
    @endphp
    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Event",
      "name": "{{ $match->tTNaam}} VS {{ $match->tUNaam }}",
      "location": {
        "@type": "Place",
        "name": "{{ $match->extraDetails->adress }}",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "{{ $match->extraDetails->adress }}"
        }
      },
      "startDate": "{{ $startDate }}"
    }
    </script>
  @endforeach

@endsection
