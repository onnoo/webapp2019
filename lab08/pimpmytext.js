function myAlert() {
	alert("Hello, World!");
}

function bigger() {
	var text = document.getElementById("text");
  if (!text.style.fontSize) {
    text.style.fontSize = '12pt';
  }
  text.style.fontSize = parseInt(text.style.fontSize) + 2 + 'pt';
}

function timer() {
  setInterval(bigger, 500);
}

function bling() {
	var blingCheckBox = document.getElementById("blingCheck");
	var text = document.getElementById("text");

	if (blingCheckBox.checked == true) {
		text.style.fontWeight = "bold";
		text.style.color = "green";
    text.style.textDecoration = "underline";
    
    var body = document.getElementsByTagName("body");
    body[0].style.backgroundImage = `url("https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/8/hundred.jpg")`;
	} else {
		text.style.fontWeight = "normal";
		text.style.color = "black";
    text.style.textDecoration = "none";
    
    var body = document.getElementsByTagName("body");
    body[0].style.backgroundImage = "none";
	}	
}

function snoopify() {
	var text = document.getElementById("text");
	text.value = text.value.toUpperCase();
	sentences = text.value.split(".");
	text.value = sentences.join("-izzle.");
}

function pigLatin() {
  var text = document.getElementById("text");
  var re = /[b-df-hj-np-tv-z]+[aeiou]+[\w]*/g;
  text.value = text.value.replace(re, function (x) {
    var consonants = /[b-df-hj-np-tv-z]+/g;
    var con = consonants.exec(x);
    return x.substr(con[0].length) + con + 'ay';
  });
}

function replaceMalkovirch() {
  var text = document.getElementById("text");
  var re = /(\w){5,}/g;
  re.compile(re);
  var str = "Malkovirch";
  text.value = text.value.replace(re, str);
}

window.onload = function() {
  var biggerBtn = document.getElementById("biggerBtn");
  biggerBtn.onclick = timer;
  var blingCheckBox = document.getElementById("blingCheck");
  blingCheckBox.onchange = bling;
  var snoopifyBtn = document.getElementById("SnoopifyBtn");
  snoopifyBtn.onclick = snoopify;
  var igpayAtinlay = document.getElementById("igpayAtinlay");
  igpayAtinlay.onclick = pigLatin;
  var malkovitch = document.getElementById("malkovitch");
  malkovitch.onclick = replaceMalkovirch;
};