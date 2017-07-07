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
			p.appendChild(txt);
			p.appendChild(a);

			document.getElementById("central").appendChild(p);
		}
		
	});
}