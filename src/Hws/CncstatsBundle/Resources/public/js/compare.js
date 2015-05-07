jQuery(document).ready(function() {
    jQuery('#showCompareDivButtonAlliances').on('click', function() {
	showCompareDiv('compareDivAlliances');
    });

    jQuery('#showCompareDivButtonPlayers').on('click', function() {
	showCompareDiv('compareDivPlayers');
    });

    enableAutocomplete('itemFirstAllianceId', 'itemFirstAlliance', 'alliances');
    enableAutocomplete('itemSecondAllianceId', 'itemSecondAlliance', 'alliances');
    enableCompare('itemFirstAllianceId', 'itemFirstAlliance', 'itemSecondAllianceId', 'itemSecondAlliance', 'compareAlliances', 'alliances');

    enableAutocomplete('itemFirstPlayerId', 'itemFirstPlayer', 'players');
    enableAutocomplete('itemSecondPlayerId', 'itemSecondPlayer', 'players');
    enableCompare('itemFirstPlayerId', 'itemFirstPlayer', 'itemSecondPlayerId', 'itemSecondPlayer', 'comparePlayers', 'players');
});