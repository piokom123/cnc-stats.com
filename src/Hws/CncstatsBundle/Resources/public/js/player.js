jQuery(document).ready(function() {
    enableAutocomplete('compareAllianceId', 'compareAlliance', 'alliances');
    enableCompare('allianceId', 'allianceName', 'compareAllianceId', 'compareAlliance', 'compareAlliances', 'alliances');

    enableAutocomplete('comparePlayerId', 'comparePlayer', 'players');
    enableCompare('playerId', 'playerName', 'comparePlayerId', 'comparePlayer', 'comparePlayers', 'players');
});