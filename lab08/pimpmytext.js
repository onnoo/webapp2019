
function myAlert() {
	alert("Hello, World!");
}

function bigger() {
	text = document.getElementById("text");
	text.style.fontSize = "24pt";
}

function bling() {
	blingCheckBox = document.getElementById("blingCheck");
	text = document.getElementById("text");

	if (blingCheckBox.checked == true) {
		text.style.fontWeight = "bold";
		text.style.color = "green";
		text.style.textDecoration = "underline";
	} else {
		text.style.fontWeight = "normal";
		text.style.color = "black";
		text.style.textDecoration = "none";
	}	
}

function snoopify() {
	text = document.getElementById("text");
	text.value = text.value.toUpperCase();
	sentences = text.value.split(".");
	text.value = sentences.join("-izzle.");
}