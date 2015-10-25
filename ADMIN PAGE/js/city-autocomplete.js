<?php

$(function(){

  var cities = [

	{ value: 'Abricots'},
	{ value: 'Acul du Nord'},
	{ value: 'Anse a Foleur'},
	{ value: 'Anse a Galets'},
	{ value: 'Anse a Veau'},
	{ value: 'Anse a Pitres'},
	{ value: 'Anse Rouge'},
	{ value: 'Aquin'},
	{ value: 'Arcahaie'},
	{ value: 'Arnaud '},
	{ value: 'Baie de Henne'},
	{ value: 'Bainet '},
	{ value: 'Bas Limbe'},
	{ value: 'Bassin-Bleu'},
	{ value: 'Bombardopolis'},
	{ value: 'Cabaret'},
	{ value: 'Camp-Perrin'},
	{ value: 'Cap-Haïtien'},
	{ value: 'Capotille'},
	{ value: 'Carice'},
	{ value: 'Carrefour'},
	{ value: 'Cerca la Source'},
	{ value: 'Corail'},
	{ value: 'Delmas'},
	{ value: 'Desdunes'},
	{ value: 'Dessalines'},
	{ value: 'Dondon'},
	{ value: 'Ennery'},
	{ value: 'Ferrier'},
	{ value: 'Fonds-des-Negres'},
	{ value: 'Fonds-Verrettes'},
	{ value: 'Gonaïves'},
	{ value: 'Grand Boucan'},
	{ value: 'Grand-Gosier'},
	{ value: 'Gros Morne'},
	{ value: 'Hinche'},
	{ value: 'Ile de la Tortue'},
	{ value: 'Jérémie'},
	{ value: 'La Vallee'},
	{ value: 'Léogâne'},
	{ value: 'Les Cayes'},
	{ value: 'Limbe'},
	{ value: 'Maissade'},
	{ value: 'Mont-Organise'},
	{ value: 'Ouanaminthe'},
	{ value: 'Pétionville'},
	{ value: 'Petite Riviere de Nippes'},
	{ value: 'Petit Goâve'},
	{ value: 'Pilate'},
	{ value: 'Plaisance du Sud'},
	{ value: 'Port-au-Prince'},
	{ value: 'Port-de-Paix'},
	{ value: 'Port-Salut'},
	{ value: 'Roche-a-Bateaux'},
	{ value: 'Saint Jean du Sud'},
	{ value: 'Saint-Marc'},
	{ value: 'Sainte-Suzanne'},
	{ value: 'Terre Neuve'},
	{ value: 'Thiotte'},
	{ value: 'Thomonde'},
	{ value: 'Torbeck'},
	{ value: 'Vallieres'},
	{ value: 'Verrettes'}


	];






  // setup autocomplete function pulling from cities[] array
  $('#autocomplete').autocomplete({
	lookup: cities,
    onSelect: function (suggestion) {
	  var thehtml = '<strong>City Name:</strong> ' + suggestion.value;
      $('#outputcontent').html(thehtml);
    }
  });



});
?>
