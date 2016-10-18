<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Music</title>
<link id="icon" type="image/jpeg" rel="shortcut icon" href="/cover.jpg">
<link href="/style.css" rel="stylesheet" type="text/css" />
</head> 

<body>
<script src="/jquery-2.1.1.min.js" type="text/javascript"></script>

<audio id="player" autoplay="true" loop="true" controls>
  <source id="player_src" src="" type="audio/mpeg">
</audio>
<div id="placeholder">&nbsp;</div>
<div id="art">&nbsp;</div>
<div id="list">

</div>
<script type="text/javascript">
var updatecover = function() {
   $("#art").css("background-image", "url('"+window.location.pathname+"cover.jpg')");
   $("#icon").attr("href", "cover.jpg");
};

var getListing = function(){
	$.ajax({
		url: "/ajax.php?path="+encodeURIComponent(window.location.pathname)
	}).done(function(data){
		$("#list").html(data);
		$("#art").css("background-image", "url('/cover.jpg')");
   		$("#icon").attr("href", "/cover.jpg");
		$(".cover").each(updatecover);
		$(".folder").mouseup(navfolder);
		$(".folder a").click(function(event){if(event.which == 1){event.preventDefault();}});
		$(".file").mouseup(playfile);
		$(".file a").click(function(event){if(event.which == 1){event.preventDefault();}});
	});
}
getListing();
var navfolder = function(event){
	if(event.which == 1){
		history.pushState(null, null, window.location.pathname+$(this).text()+'/');
		getListing();
	}
};
window.onpopstate = function(event) {
	getListing();
};

var playfile = function(event){
	if(event.which == 1){
		$(".file").removeClass("highlight");
		$(this).addClass("highlight");
		$("#player_src").attr("src", ''+window.location.pathname+$(this).text()+'.mp3');
		$("#player").load();
		$("#art").addClass("active");
		document.title = $(this).text();
	}
};

var playpause = function() {
	if(document.getElementById("player").paused){
		$("#player").trigger("play");
	}
	else{
		$("#player").trigger("pause");
	}
};

$("#art").click(playpause);

$("html").keyup(function(event){
	var player = document.getElementById("player");
	var seek = 5;
	if(event.ctrlKey)
		seek = 30;
	if(event.which == 32) //space
		playpause();
	if(event.which == 37) //left
		player.currentTime = player.currentTime < seek ? 0 : player.currentTime - seek;
	if(event.which == 39) //right
		player.currentTime = player.duration - player.currentTime < seek ? player.duration : player.currentTime + seek;
	if(event.which == 38) //up
		player.volume = player.volume > 0.9 ? 1 : player.volume + 0.1;
	if(event.which == 40) //down
		player.volume = player.volume < 0.1 ? 0 : player.volume - 0.1;
}).keydown(function(event){
	if(event.which >= 37 && event.which <= 40)
		event.preventDefault();
	if(event.which == 32)
		event.preventDefault();
});

$(".cover").each(updatecover);
$(".folder").mouseup(navfolder);
$(".folder a").click(function(event){if(event.which == 1){event.preventDefault();}});
$(".file").mouseup(playfile);
$(".file a").click(function(event){if(event.which == 1){event.preventDefault();}});
</script>
</body>
</html>
