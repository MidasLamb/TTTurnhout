<div class="match-extra-details">
    @if($match->hasComplementaryMatch)
        <table class="table table-striped table-bordered detail-score-table table-condensed">
        <thead>
            <tr>
            <td colspan=3>
                <b>Vorige score:</b>
            </td>
            </tr>
        </thead>
        <tr>
            <td>
                {{ $match->complementaryMatch->tTNaam }}
            </td>
            <td 
                @if($match->complementaryMatch->draw)
                        >
                @else
                    style="box-shadow: inset 0px 0px 5px 2px
                    @if($match->complementaryMatch->victory)
                         #47a35a;">
                    @else
                         #ea6262;">
                    @endif
                @endif
                {{ $match->complementaryMatch->uitslag }}
            </td>
            <td>
                {{ $match->complementaryMatch->tUNaam }}
            </td>
        </tr>
        </table>
        <br>
    @endif
    Onze plaats: {{ $match->extraDetails->ownRanking}} <br>
    Plaats tegenstander: {{ $match->extraDetails->otherRanking}} <br>
    Kleuren tegenstander: {{ $match->extraDetails->otherTeamColors}} <br>
</div>