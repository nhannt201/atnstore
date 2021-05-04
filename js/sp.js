$(document).ready(function () {
	$(window).scroll(function () {
		if ($(this).scrollTop() > 50) {
			 $('#benphaimenu').fadeIn();
		} else {
			 $('#benphaimenu').fadeOut();
		}
			});				
});

function clickGioHang(mahang) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		
	  if (this.readyState == 4 && this.status == 200) {
		document.getElementById("danhsachhang").innerHTML = 'Cart (' + this.responseText + ')';
		alert("Added product to cart!");
	  }
	};
	xhttp.open("GET", "/giohang.php?id=" + mahang, true);
	xhttp.send();
}

function clickCancel(mahang) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		
	  if (this.readyState == 4 && this.status == 200) {
		location.reload()
	  }
	};
	xhttp.open("GET", "/remove_giohang.php?id_or=" + mahang, true);
	xhttp.send();
}



function clickXoaGioHang(mahang) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		
	  if (this.readyState == 4 && this.status == 200) {
		location.reload()
	  }
	};
	xhttp.open("GET", "/remove_giohang.php?id=" + mahang, true);
	xhttp.send();
}

function clickSearch() {
		document.getElementById("search_form").innerHTML = '<form action="search" method="get"><input class="form-control" name="q" type="text" placeholder="Search"></form>';
}

function chooseBranch() {
	var idd = document.getElementById("chooBB").value;
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			
		  if (this.readyState == 4 && this.status == 200) {
			location.reload()
			//alert(idd);
		  }
		};
		xhttp.open("GET", "/option_advance.php?id=" + idd, true);
		xhttp.send();
	
}