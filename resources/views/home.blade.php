@extends('master')


@section('content')
  <div class="col-md-12"> 
    <h3> Wedstrijden deze week </h3>
    <table class="table table-striped table-bordered">
      <colgroup>
        <col class="col-xs-2">
        <col class="col-xs-4">
        <col class="col-xs-2"> 
        <col class="col-xs-4">
      </colgroup>
      @foreach($this_week_matches as $match)
        <tr onClick="showDetails(this, '{{ $match->extraDetailHTML }}')" data-collapsed="1">
          <td style="text-align:center;">
            {{ $match->datumString }} <br>
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
          </td>

          <td
            @if($match->draw)
              style="text-align:center">
            @elseif($match->victory)
              style="text-align:center; background-color: #47a35a; color: white;">
            @else
              style="text-align:center; background-color: #ea6262; color: white;">
            @endif
            {{ $match->uitslag}}
          </td>

          <td>
            @if (!($match->homeGame))
              <b><a href="/ploeg/{{$match->siteid}}">
            @endif
            {{$match->tUNaam}}

            @if(!($match->homeGame))
              </a></b>
            @endif
            <span class="menu pull-right glyphicon glyphicon-menu-left" aria-hidden="true" style="cursor:pointer">

            </span>
          </td>
        </tr>

      @endforeach
    </table>
  </div>
  <div class="col-md-6"> 
    <h3> Wedstrijden volgende week </h3>
        <table class="table table-striped table-bordered table-hover" id="futurMatches" >
                    <colgroup>
                        <col class="col-xs-2">
                        <col class="col-xs-5">
                        <col class="col-xs-5">
                      </colgroup>
                @foreach($next_week_matches as $match)
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
  </div>
  <div class="col-md-6"> 
    <h3> Wedstrijden vorige week </h3>
    @printPastMatchesTable($prev_week_matches)
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
      var list = caller.getElementsByClassName("menu");
      for(var i = 0; i<list.length; i++){
        list[i].classList.remove("glyphicon-menu-left");
        list[i].classList.add("glyphicon-menu-down");
      }
		} else {
			table.deleteRow(rowIndex + 1);
			caller.setAttribute("data-collapsed", "1");
      var list = caller.getElementsByClassName("menu");
      for(var i = 0; i<list.length; i++){
        list[i].classList.remove("glyphicon-menu-down");
        list[i].classList.add("glyphicon-menu-left");
      }
		}
	}
</script>
@endsection
