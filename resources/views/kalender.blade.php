@extends('layouts.app')

@section('content')
	<div class="col-md-6"> 
    <h3> Toekomstige wedstijden </h3>
    
    @foreach($future_matches as $week => $matches)
      <h4> Week: {{ $week }} </h4>
      @include('includecomponents.futuregametable', ["matches" => $matches])
    @endforeach
  </div>

	<div class="col-md-6"> 
    <h3> Voorbije wedstijden </h3>
	    @foreach($past_matches as $week => $matches)
	    	<h4> Week: {{ $week }} </h4>
    		@include('includecomponents.pastgametable', ["matches" => $matches])
    	@endforeach
  </div>

@endsection

