@extends('layouts.app')


@section('content')
  <div class="container">
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
