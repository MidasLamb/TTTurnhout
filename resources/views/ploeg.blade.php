@extends('master')

@section('content')
	<div class="hidden-xs" style="position: fixed; top:0px;left:0px; width:225px; height:52px;background-color: #f8f8f8; border: 1px solid #e7e7e7; z-index:-1">

	</div>
	<div class="container-fluid" style=" margin-top: 50px;">
	  <div class="row">
	    <div class="col-sm-3 col-lg-2">
	      <nav class="navbar navbar-default navbar-fixed-side">
	        <div class="container">
              <div class="navbar-header">
                <button class="navbar-toggle" data-target="#sidebar" data-toggle="collapse">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#team">{{ $team_name}}</a>
              </div>
              <div class="collapse navbar-collapse"  id="sidebar">
                <ul class="nav navbar-nav">
                  <li class = "linky" id="team">
                    <a href="#team">Team</a>
                  </li>
                  <li class = "linky" id="kalender">
                    <a href="#kalender">Kalender</a>
                  </li>
                  <li class = "linky" id="uitslagen">
                    <a href="#uitslagen">Uitslagen</a>
                  </li>
                  <li class = "linky" id="rangschikking">
                    <a href="#rangschikking">Rangschikking</a>
                  </li>
                  <li class = "linky" id="statistieken">
                    <a href="#statistieken">Statistieken</a>
                  </li>
                </ul>
                
              </div>
            </div>
	      </nav>
	    </div>
	    <div class="col-sm-9 col-lg-10">
        <div class="hid_div" id="team_div" style="display:none">
          <h2>Team</h2>
        </div>

        <div class="hid_div" id="kalender_div" style="display:none">
          <h2>Kalender</h2>
            <div class="col-md-12"> 
              @foreach($future_matches as $week => $matches)
                <table class="table table-striped table-bordered">
                  <colgroup>
                    <col class="col-xs-2">
                    <col class="col-xs-5">
                    <col class="col-xs-5">
                  </colgroup>
                  @foreach($matches as $match)
                    <tr>
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
                    <tr class="details-row">
                      <td style="text-align:center;">
                        <div class="match-extra-details">
                          Adres: <br>{{ $match->extraDetails->adress}}
                        </div>
                      </td>
                      <td colspan="3" style="text-align:center;padding:0px;">
                        <div class="match-extra-details" style="margin:8px">
                          @if($match->hasComplementaryMatch)
                            {{ $match->complementaryMatch->tTNaam }}
                            {{ $match->complementaryMatch->uitslag }}
                            {{ $match->complementaryMatch->tUNaam }}
                          @endif
                          Onze plaats: {{ $match->extraDetails->ownRanking}} <br>
                          Plaats tegenstander: {{ $match->extraDetails->otherRanking}} <br>
                          Kleuren tegenstander: {{ $match->extraDetails->otherTeamColors}} <br>
                        </div>
                        <div style="width:100%;cursor:pointer;" onclick="toggleDetails(this)" >
                          <span class="menu glyphicon glyphicon-menu-down" aria-hidden="true">
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </table>
              @endforeach
            </div>
        </div>
        <div class="hid_div" id="uitslagen_div" style="display:none">
          <h2>Uitslagen</h2>
            <div class="col-md-12"> 
              @foreach($past_matches as $week => $matches)
                <table class="table table-striped table-bordered">
                  <colgroup>
                    <col class="col-xs-2">
                    <col class="col-xs-4">
                    <col class="col-xs-2"> 
                    <col class="col-xs-4">
                  </colgroup>
                  <tbody>
                  @foreach($matches as $match)
                    <tr>
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
                        </span>
                      </td>
                    </tr>
                    <tr class="details-row">
                      <td style="text-align:center;">
                        <div class="match-extra-details">
                          Adres: <br>{{ $match->extraDetails->adress}}
                        </div>
                      </td>
                      <td colspan="3" style="text-align:center;padding:0px;">
                        <div class="match-extra-details" style="margin:8px">
                          @if($match->hasComplementaryMatch)
                            {{ $match->complementaryMatch->tTNaam }}
                            {{ $match->complementaryMatch->uitslag }}
                            {{ $match->complementaryMatch->tUNaam }}
                          @endif
                          Onze plaats: {{ $match->extraDetails->ownRanking}} <br>
                          Plaats tegenstander: {{ $match->extraDetails->otherRanking}} <br>
                          Kleuren tegenstander: {{ $match->extraDetails->otherTeamColors}} <br>
                        </div>
                        <div style="width:100%;cursor:pointer;" onclick="toggleDetails(this)" >
                          <span class="menu glyphicon glyphicon-menu-down" aria-hidden="true">
                        </div>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              @endforeach
            </div>
        </div>
        <div class="hid_div" id="rangschikking_div" style="display:none">
          <h2>Rangschikking</h2>
          

          @foreach($rangschikking->poules as $poule)
            <h3> {{ $poule->naam }} </h3>
            <table class= "table table-bordered table-hover table-striped">
              <tr>
                <th>
                  Plaats
                </th>
                <th>
                  Ploegnaam
                </th>
                <th>
                  # Wedstrijden
                </th>
                <th>
                  Punten
                </th>
              </tr>
            @foreach($poule->teams as $team)
         
              
              <tr>
                <td>
                {{ $team->rangNr}}
                </td>
                <td>
                {{ $team->naam}}
                </td>
                <td>
                {{ $team->wedAant}}
                </td>
                <td>
                {{ $team->wedPunt}}
                </td>
              </tr>
              
            @endforeach
            </table>
          @endforeach
            
        </div>
        <div class="hid_div" id="statistieken_div" style="display:none">
          <h2>Statistieken</h2>
            @foreach($rangschikking->poules as $poule)
            <h3> {{ $poule->naam }} </h3>
            <table class= "table table-bordered table-hover table-striped">
              <tr>
                <th>
                  Ploegnaam
                </th>
                <th>
                  # Wedstrijden gewonnen 
                </th>
                <th>
                  # Wedstrijden gelijk gespeeld
                </th>
                <th>
                  # Wedstrijden verloren
                </th>
                <th>
                  # Punten voor
                </th>
                <th>
                  # Punten tegen
                </th>
              </tr>
            @foreach($poule->teams as $team)
         
              
              <tr>
                <td>
                {{ $team->naam}}
                </td>
                <td>
                {{ $team->wedWinst}}
                </td>
                <td>
                {{ $team->wedGelijk}}
                </td>
                <td>
                {{ $team->wedVerloren}}
                </td>
                <td>
                {{ $team->ptVoor}}
                </td>
                <td>
                {{ $team->ptTegen}}
                </td>
              </tr>
              
            @endforeach
            </table>
          @endforeach
        </div>
        
	    </div>
	  </div>
	</div>


  
@stop

@section('scripts')


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

  var subsections = ["team", "kalender", "uitslagen", "rangschikking", "statistieken"];

  function checkHash(){
    var hash = window.location.hash;
    var hashNoTag = window.location.hash.substr(1);
    if (subsections.indexOf(hashNoTag) != -1){
      $(".hid_div").css('display', 'none');
      $(hash+"_div").css('display', 'block');
    } else {
      window.location.hash = "#team";
    }
  }

  function toggleDetails(caller){
    var row = $(caller).closest(".details-row");
    var menu = row.find(".menu");
    row.find(".match-extra-details").each(function(){
      if($(this).is(":visible")){
        $(this).slideUp();
        menu.fadeOut(400, function(){
          menu.removeClass("glyphicon-menu-up");
          menu.addClass("glyphicon-menu-down")
          menu.fadeIn(400); 
        });
        
      } else {
        $(this).slideDown();
        menu.fadeOut(400, function(){
          menu.removeClass("glyphicon-menu-down");
          menu.addClass("glyphicon-menu-up")
          menu.fadeIn(400); 
        });
      }
    });
  }

  checkHash();

  


  $( document ).ready( function() {
    checkHash();
    setActive();
    setTeamLinks();
    $(".match-extra-details").each(function(){
      $(this).slideUp();
    });
  });

  

  function setActive(){
    var hash = window.location.hash;

    $(".linky").removeClass("active");

    $(hash).addClass("active");
  }

  function hashChanged() {
    checkHash();
    setActive();
    setTeamLinks();
    $('#sidebar').collapse('hide');
  }

  function setTeamLinks() {

    $(".teamlink").each(function() {
        var hash = window.location.hash;
        cur_link = $( this ).attr("href").split("#")[0].concat(hash);
        $( this ).attr("href", cur_link);


      });
  }

  window.onhashchange = hashChanged;

  </script>
@stop

