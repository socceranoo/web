$(document).ready(function(){
	var myPlaylist = new jPlayerPlaylist({
		jPlayer: "#jquery_jplayer_1",
		cssSelectorAncestor: "#jp_container_1"
		}, [ ], {
			playlistOptions: {
				autoPlay: false,
				loopOnPrevious: false,
				shuffleOnLoop: true,
				enableRemoveControls: false,
				displayTime: 'slow',
				addTime: 'fast',
				removeTime: 'fast',
				shuffleTime: 'slow'
			},
		swfPath: "swf",
		supplied: "ogv, m4v, oga, mp3",
		smoothPlayBar: true,
		keyEnabled: true,
		audioFullScreen: true // Allows the audio poster to go full screen via keyboard
	});
	
	/*
	myPlaylist.setPlaylist([
		{
			title:"Cro Magnon Man",
			artist:"The Stark Palace",
			mp3:"http://www.jplayer.org/audio/mp3/TSP-01-Cro_magnon_man.mp3",
		},
		{
			title:"Hidden",
			artist:"Miaow",
			mp3:"../external/linkhdd/Audio/English/Poets of the Fall/Carnival of Rust.mp3",
		}
	]);

	*/
	var title_val="Carnival of Rust";
	var artist_val="POTF";
	var song_path="../external/linkhdd/Audio/English/Poets of the Fall/Carnival of Rust.mp3";
	for (i = 0 ; i < 20 ; i++) {
		myPlaylist.add({
			title:title_val,
			artist:artist_val,
			mp3:song_path,
		});
	}
});
