function postNewUrlAJAX() {

	var url = document.getElementById('originalUrl').value;
	//alert("url inside js post function is: " + url);

	$.post("post_url.php", 
	{
		original_url: url
	}, 
	function (data, status) {
		//document.write("data: " + data);
		var title = $("#mainTitle");

		var form = $("#form");

		var central = $("#central");

		if(isNaN(data) || Number(data) == 0) {
			updateWindow(false);
		} else {
			updateWindow(true);
			var shortUrl = "http://localhost/urlshortener/public?u=" + data;
			var a = $("<a></a>");
			a.attr('href',shortUrl);
			a.text(shortUrl);
			var p = $("#resultPara")
			p.append(a);
			p.insertAfter(title);
		}

		

	});
}

function backToMainPage() {
	$('body').load( "index.php" );
}

function updateWindow(worked) {
	var title = $("#mainTitle");
	//console.log(title);
	var form = $("#form");
	var central = $("#central");

	if(worked) {
		title.html("Sucess");
		var p = $("#resultPara");
		if(p.length > 0) {
			p.text("Your shortened URL is: ");
		} else {
			p = $("<p></p>").text("Your shortened URL is: ");
			p.attr("id", "resultPara");
			p.insertAfter(title);
		}

	} else {
		title.html("Fail");
		var p = $("#resultPara");
		if(p.length > 0) {
			p.text("Try inserting again or try another URL");
			console.log(p);
			p.insertAfter(title);
		} else {
			p = $("p").text("Try inserting again or try another URL");
			p.attr("id", "resultPara");
			console.log(p);
			p.insertAfter(title);
		}
	}
}