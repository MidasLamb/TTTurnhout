@extends('master')

@section('content')
  <div class="col-md-12"> 
    <h3> Wedstrijden deze week </h3>
    @printPastMatchesTable($this_week_matches)
  </div>
  <div class="col-md-6"> 
    <h3> Wedstrijden volgende week </h3>
    @printFutureMatchesTable($next_week_matches)
  </div>
  <div class="col-md-6"> 
    <h3> Wedstrijden vorige week </h3>
    @printPastMatchesTable($prev_week_matches)
  </div>
@stop
