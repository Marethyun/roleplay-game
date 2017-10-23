
var user_id = $("#userid").attr("value");
var user_name = $("#username").attr("value");
var user_master = $("#usermaster").attr("value");

$.fn.scrollBottom = function() { 
  return $(document).height() - this.scrollTop() - this.height(); 
};

var fire = function() {
	var faces = parseInt($('#faces').val());
	if (!faces == "NaN" || faces > 1){
		var face = dice(faces);
		var hidden = $("#hidden").is(':checked') ? 1 : 0;

		sendChat("{NAME} a lancé un dé à " + faces + " faces, résultat: " + face, hidden);
		if (hidden == 0) {
			$("#result").val('Face: ' + face);
		} else {
			$("#result").val('Face: ' + face + " (caché)");
		}
		updateChat();
	} else {
		alert("Entrez un nombre de faces valide");
	}
};	

$("body").keypress()

$('#run').click(fire);

$('#run').on('touchstart', '#run', fire);

$(document).keypress(function(event) {
	if (event.which == 13){
		event.preventDefault();
		fire();
	}
});

function dice(max) {
	return Math.floor((Math.random() * max) + 1);
}

function updateChat(){
	var chat = $("#chat");
	chat.html('');

	$.get("chat.php", function(data){

		data = JSON.parse(data);
		data = data.data;

		for (var i = 0; i < data.length; i++) {
			var curr = data[i];

			var entry = $("<p>" + curr.message + "</p>");

			chat.append(entry);

			entry.css('color', curr.color);

			if (curr.hidden == 1){
				entry.css('font-style', 'italic');
				entry.css('color', 'grey');
				var content = entry.html();
				entry.html('(c) ' + content);
			} else {
				entry.css('color', curr.color);
			}
		}
	});
}

function sendChat(message, hidden){
	$.post("chat.php",
	{
		message: message,
		sender: user_id,
		hidden: hidden
	},
	function(data){
		data = JSON.parse(data);
		if (data.success == false){
			alert(data);
		}
	});
}


function changeColor(color){
	var name = $(color).prev();
	var playerid = name.attr('id');

	if (user_master == 1){

		var formated = '#' + color.value.toLowerCase();

		$.post("color.php",
		{
			color: formated,
			playerid: playerid
		},
		function(data){
			data = JSON.parse(data);
			if (data.success == false){
				alert(data);
			} else {
				name.css('background-color', formated);
				updateChat();
			}
		});
	}
}

var userTemplate = '<p><span id="{PLAYERID}">{PLAYERNAME}</span> <input class="form-control picker" onchange="changeColor(this)" /></p>'

//var picker = new jscolor($('#players').children().children().next()[0], {valueElement: null, styleElement: $('#players').children().children()[0]})
//<p><span id="{PLAYERID}">{PLAYERNAME}</span> <a href="#">Changer la couleur</a></p>

function updateUsers(){
	$.get("users.php", function(data){

		$("#players").html('');

		data = JSON.parse(data);
		data = data.data;
		for (var i = 0; i < data.length; i++) {
			var curr = data[i];

			var formated = userTemplate.replace("{PLAYERID}", curr.id).replace("{PLAYERNAME}", curr.name);
			var user = $(formated);

			if (user_master == 0){
				user.children().next().css("display", "none");
			}

			$("#players").append(user);

			var picker = new jscolor(user.children().next()[0], {
				//valueElement: user.children().next()[0],
				styleElement: user.children()[0],
				value: curr.color.substring(1,7)
			});
		}
	});
	$("#player").scrollBottom();
}

function update(){
	updateUsers();
	updateChat();
	setTimeout('update', 1000);
}

update();
 