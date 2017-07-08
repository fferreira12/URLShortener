function postNewUrlAJAX() {

	var url = document.getElementById('originalUrl').value;
	//alert("url inside js post function is: " + url);

	$.post("post_url.php", 
	{
		original_url: url
	}, 
	function (data, status) {
		//document.write("data: " + data);
		var title = document.getElementById("mainTitle");
		var form = document.getElementById("form");

		var central = document.getElementById("central");

		if(isNaN(data) || Number(data) == 0) {
			title.innerHTML = "Fail";
			var txt = document.createTextNode("Try inserting again or try another URL");

			var p = document.createElement("p");
			p.setAttribute("id", "resultPara")

			p.appendChild(txt);

			central.insertBefore(p, central.childNodes[2]);

		} else {
			title.innerHTML = "Sucess";
			form.style.display = 'none';
			
			var shortUrl = "http://localhost/urlshortener/public?u=" + data;


			var a = document.createElement("a");
			a.setAttribute('href',shortUrl);
			a.innerHTML = shortUrl;
			
			var txt = document.createTextNode("Your shortened URL is: ");

			var p = document.createElement("p");
			p.setAttribute("id", "resultPara")
			p.appendChild(txt);
			p.appendChild(a);

			central.appendChild(p);

		}

		var lastUrl = $("#lastUrl");
		lastUrl.hide();
		//alert("none was called");

		var back = $('<input/>');
		back.attr({ class: "wideBtn", type: 'button', name:'backButton', value:'Back'});

		back.click(backToMainPage);
		
		$("#resultPara").after(back);

	});
}

function backToMainPage() {
	$('body').load( "index.php" );
}