@extends('layouts.app')

@section('content')
	<div class="col-md-6"> 
    <h3> Toekomstige wedstijden </h3>
    @foreach($future_matches as $week => $matches)
      <h4> Week: {{ $week }} </h4>
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
                  <br>
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

	<div class="col-md-6"> 
    <h3> Voorbije wedstijden </h3>
	    @foreach($past_matches as $week => $matches)
	    	<h4> Week: {{ $week }} </h4>
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
                    <br>
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
    $(".match-extra-details").each(function(){
      $(this).slideUp();
    });
  });
</script>
@endsection