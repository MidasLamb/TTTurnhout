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
      <thead>
        <tr >
          <th style="text-align:center">Datum</th>
          <th style="text-align:right">Thuisploeg</th>
          <th style="text-align:center">Score</th>
          <th style="text-align:left">Uitploeg</th>
        </tr>
      <thead>
      <tbody>
      @foreach($this_week_matches as $match)
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
          <td style="text-align:justify;word-break:keep-all">
            <div class="match-extra-details">
               Adres: {{ $match->extraDetails->adress}}
            </div>
          </td>
          <td colspan="3" style="text-align:center;padding-top:0;">
            <div style="width:100%;cursor:pointer;" onclick="toggleDetails(this)">
              <span class="menu glyphicon glyphicon-menu-down" aria-hidden="true">
            </div>
            
            <div class="match-extra-details">
              @if($match->hasComplementaryMatch)
                {{ $match->complementaryMatch->tTNaam }}
                {{ $match->complementaryMatch->uitslag }}
                {{ $match->complementaryMatch->tUNaam }}
              @endif
              Onze plaats: {{ $match->extraDetails->ownRanking}} <br>
              Plaats tegenstander: {{ $match->extraDetails->otherRanking}} <br>
              Kleuren tegenstander: {{ $match->extraDetails->otherTeamColors}} <br>
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
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

@endsection

@section('scripts')

<script>
  function toggleDetails(caller){
    var row = $(caller).closest(".details-row");
    row.find(".match-extra-details").each(function(){
      if($(this).is(":visible")){
        $(this).slideUp();
      } else {
        $(this).slideDown();
      }
    });
  }

  $(document).ready(function(){
    $(".match-extra-details").each(function(){
      $(this).slideUp();
    });
  });
</script>
@endsection
