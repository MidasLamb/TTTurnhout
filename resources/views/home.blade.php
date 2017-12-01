@extends('layouts.app')


@section('content')
  <div class="col-md-12"> 
    <h3> Wedstrijden deze week </h3>
    <table class="table table-striped table-bordered past-score-table">
      <colgroup>
        <col class="col-xs-2 date-column">
        <col class="col-xs-4 hometeam-column">
        <col class="col-xs-2 score-column"> 
        <col class="col-xs-4 awayteam-column">
      </colgroup>
      <thead>
        <tr >
          <th>Datum</th>
          <th>Thuisploeg</th>
          <th>Score</th>
          <th>Uitploeg</th>
        </tr>
      </thead>
      <tbody>
      @foreach($this_week_matches as $match)
        <tr>
          <td>
            {{ $match->datumString }} <br>
            {{ $match->beginTijd }}
          </td>
          <td>
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
              >
            @elseif($match->victory)
              style="background-color: #47a35a; color: white;">
            @else
              style="background-color: #ea6262; color: white;">
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
          <td class="td-match-extra-details-date">
            <div class="hidden-for-width">
              Adres: <br>{{ $match->extraDetails->adress}}
            </div>
            <div class="match-extra-details match-extra-details-adres">
              Adres: <br>{{ $match->extraDetails->adress}}
            </div>
          </td>
          <td colspan="3" class="td-match-extra-details">
            <div class="match-extra-details">
              @if($match->hasComplementaryMatch)
                {{ $match->complementaryMatch->tTNaam }}
                {{ $match->complementaryMatch->uitslag }}
                {{ $match->complementaryMatch->tUNaam }}
                <br>
              @endif
              Onze plaats: {{ $match->extraDetails->ownRanking}} <br>
              Plaats tegenstander: {{ $match->extraDetails->otherRanking}} <br>
              Kleuren tegenstander: {{ $match->extraDetails->otherTeamColors}} <br>
            </div>
            <div class="extra-details-toggle" onclick="toggleDetails(this)" >
              <span class="menu glyphicon glyphicon-menu-down" aria-hidden="true">
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
  <!-- Volgende week -->
  <div class="col-md-6"> 
    <h3> Wedstrijden volgende week </h3>
    <table class="table table-striped table-bordered future-score-table" id="futurMatches" >
      <colgroup>
        <col class="col-xs-2">
        <col class="col-xs-5">
        <col class="col-xs-5">
      </colgroup>
      <thead>
        <tr >
          <th>Datum</th>
          <th>Thuisploeg</th>
          <th>Uitploeg</th>
        </tr>
      </thead>
      <tbody>
      @foreach($next_week_matches as $match)
        <tr>
          <td>
            {{ $match->datumString }}
            <br>                 
            {{ $match->beginTijd }}

          </td>
          <td>
            @if ($match->homeGame)
              <b><a href="/ploeg/{{$match->siteid}}">
            @endif
            {{$match->tTNaam}}

            @if($match->homeGame)
              </a></b>
            @endif
          </td>
          <td>
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
          <td class="td-match-extra-details-date">
            <div class="match-extra-details  match-extra-details-adres">
              Adres: <br>{{ $match->extraDetails->adress}}
            </div>
          </td>
          <td colspan="3" class="td-match-extra-details">
            <div class="match-extra-details">
              @if($match->hasComplementaryMatch)
                {{ $match->complementaryMatch->tTNaam }}
                {{ $match->complementaryMatch->uitslag }}
                {{ $match->complementaryMatch->tUNaam }}
                <br>
              @endif
              Onze plaats: {{ $match->extraDetails->ownRanking}} <br>
              Plaats tegenstander: {{ $match->extraDetails->otherRanking}} <br>
              Kleuren tegenstander: {{ $match->extraDetails->otherTeamColors}} <br>
            </div>
            <div class="extra-details-toggle" onclick="toggleDetails(this)" >
              <span class="menu glyphicon glyphicon-menu-down" aria-hidden="true">
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
  <!-- Vorige week -->
  <div class="col-md-6"> 
    <h3> Wedstrijden vorige week</h3>
    <table class="table table-striped table-bordered past-score-table">
      <colgroup>
        <col class="col-xs-2">
        <col class="col-xs-4">
        <col class="col-xs-2"> 
        <col class="col-xs-4">
      </colgroup>
      <thead>
        <tr >
          <th>Datum</th>
          <th>Thuisploeg</th>
          <th>Score</th>
          <th>Uitploeg</th>
        </tr>
      </thead>
      <tbody>
      @foreach($prev_week_matches as $match)
        <tr>
          <td>
            {{ $match->datumString }} <br>
            {{ $match->beginTijd }}
          </td>
          <td>
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
              >
            @elseif($match->victory)
              style="background-color: #47a35a; color: white;">
            @else
              style="background-color: #ea6262; color: white;">
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
          <td class="td-match-extra-details-date">
            <div class="hidden-for-width">
              Adres: <br>{{ $match->extraDetails->adress}}
            </div>
            <div class="match-extra-details match-extra-details-adres">
              Adres: <br>{{ $match->extraDetails->adress}}
            </div>
          </td>
          <td colspan="3" class="td-match-extra-details">
            <div class="match-extra-details">
              @if($match->hasComplementaryMatch)
                {{ $match->complementaryMatch->tTNaam }}
                {{ $match->complementaryMatch->uitslag }}
                {{ $match->complementaryMatch->tUNaam }}
                <br>
              @endif
              Onze plaats: {{ $match->extraDetails->ownRanking}} <br>
              Plaats tegenstander: {{ $match->extraDetails->otherRanking}} <br>
              Kleuren tegenstander: {{ $match->extraDetails->otherTeamColors}} <br>
            </div>
            <div class="extra-details-toggle" onclick="toggleDetails(this)" >
              <span class="menu glyphicon glyphicon-menu-down" aria-hidden="true">
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>

@endsection

@section('scripts')

<script>
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

  $(document).ready(function(){
    setTimeout(() => {
      $(".match-extra-details").each(function(){
      $(this).slideUp();
    });
    }, 1000);
    
  });
</script>
@endsection
