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
  @foreach($matches as $match)
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
      @include('includecomponents.extradetails', ["match" => $match])
        <div class="extra-details-toggle" onclick="toggleDetails(this)" >
          <span class="menu glyphicon glyphicon-menu-down" aria-hidden="true">
        </div>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>