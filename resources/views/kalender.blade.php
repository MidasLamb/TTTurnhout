@extends('master')

@section('content')
	<div class="col-md-6"> 
	    <h3> Toekomstige wedstijden </h3>
	    @foreach($future_matches as $week => $matches)
	    	<h4> Week: {{ $week }} </h4>
	    	<table class="table table-striped table-bordered table-hover" id="futurMatches" >
                    <colgroup>
                        <col class="col-xs-2">
                        <col class="col-xs-5">
                        <col class="col-xs-5">
                      </colgroup>
                @foreach($matches as $match)
                    <tr onClick="showDetails(this, '{{ $match->extraDetailHTML }}')" data-collapsed="1">
                      <td style="font-size:small; text-align:center">
                        {{ $match->datumString }}
                        <br>                 
                        {{ $match->beginTijd }}

                      </td>
                      <td style="text-align:right">
                        @if ($match->homeGame)
                          <b><a href="/ploeg/{{$match->siteid}}">
                        @endif
                        {{$match->tTNaam}}

                        @if($match->homeGame)
                          </a></b>
                        @endif

						@if($match->hasComplementaryMatch)
                          
                        @endif
                      </td>
                      <td style="text-align:left">
                        @if(!($match->homeGame))
                          <b><a href="/ploeg/{{$match->siteid}}">
                        @endif
                        {{$match->tUNaam}}

                        @if(!($match->homeGame))
                          </a></b>
                        @endif
                      </td>
                    </tr>
                @endforeach
              </table>
	    	
	    @endforeach
  	</div>
	<div class="col-md-6"> 
    <h3> Voorbije wedstijden </h3>
	    @foreach($past_matches as $week => $matches)
	    	<h4> Week: {{ $week }} </h4>
    		@printPastMatchesTable($matches)
    	@endforeach
  </div>



<script>
	function showDetails(caller, content){
		var rowIndex = caller.rowIndex;
		var table = caller.parentElement.parentElement; // 2 levels because 1 level is tbody!
		if (caller.getAttribute("data-collapsed") == "1"){
			var row = table.insertRow(rowIndex  + 1);
			var cell = row.insertCell(0);
			cell.setAttribute("colspan", "4");
			cell.innerHTML = content;
			caller.setAttribute("data-collapsed", "0");
		} else {
			table.deleteRow(rowIndex + 1);
			caller.setAttribute("data-collapsed", "1");
		}
	}
</script>
@stop