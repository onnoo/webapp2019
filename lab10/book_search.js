window.onload = function() {
  $("b_xml").onclick=function(){
    //construct a Prototype Ajax.request object
    var radioBtn = $$("div#category label input");
    var categoryOpt = undefined;
    for (var i = 0; i < radioBtn.length; i++) {
      if (radioBtn[i].checked) {
        categoryOpt = radioBtn[i].value;
      }
    }

    new Ajax.Request("books.php", {
      method: "get",
      parameters: {category: categoryOpt},
      onSuccess: showBooks_XML,
      onFailure: ajaxFailed,
      onException: ajaxFailed
    });
  };
  $("b_json").onclick=function(){
    //construct a Prototype Ajax.request object
    var radioBtn = $$("div#category label input");
    var categoryOpt = getCheckedRadio(radioBtn);

    new Ajax.Request("books_json.php", {
      method: "get",
      parameters: {category: categoryOpt},
      onSuccess: showBooks_JSON,
      onFailure: ajaxFailed,
      onException: ajaxFailed
    });
  };
};

function getCheckedRadio(radio_button){
	for (var i = 0; i < radio_button.length; i++) {
		if(radio_button[i].checked){
			return radio_button[i].value;
		}
	}
	return undefined;
}

function showBooks_XML(ajax) {
  // alert(ajax.responseText);
  var books = ajax.responseXML.getElementsByTagName("book");
  var bookList = $("books");

  bookList.innerHTML = "";
  
  for (var i = 0; i < books.length; i++) {
    var title = books[i].getElementsByTagName("title")[0].firstChild.nodeValue;
    var author = books[i].getElementsByTagName("author")[0].firstChild.nodeValue;
    var year = books[i].getElementsByTagName("year")[0].firstChild.nodeValue;
    
    var li = document.createElement("li");
    li.innerText = title + ", by " + author + " (" + year +")";
    bookList.appendChild(li);
  }
}

function showBooks_JSON(ajax) {
  // alert(ajax.responseText);
  var bookList = $("books");
  bookList.innerHTML = "";

  var books = JSON.parse(ajax.responseText).books;
  for (var i = 0; i < books.length; i++) {
    var title = books[i].title;
    var author = books[i].author;
    var year = books[i].year;

    var li = document.createElement("li");
    li.innerText = title + ", by " + author + " (" + year +")";
    bookList.appendChild(li);
  }
}

function ajaxFailed(ajax, exception) {
	var errorMessage = "Error making Ajax request:\n\n";
	if (exception) {
		errorMessage += "Exception: " + exception.message;
	} else {
		errorMessage += "Server status:\n" + ajax.status + " " + ajax.statusText + 
		                "\n\nServer response text:\n" + ajax.responseText;
	}
	alert(errorMessage);
}
