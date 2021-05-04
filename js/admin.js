function clickHandle(mahang) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		
	  if (this.readyState == 4 && this.status == 200) {
		location.reload()
	  }
	};
	xhttp.open("GET", "/xuly_pending.php?id=" + mahang, true);
	xhttp.send();
}

function clickFinish(mahang) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		
	  if (this.readyState == 4 && this.status == 200) {
		location.reload()
	  }
	};
	xhttp.open("GET", "/xuly_pending.php?idd=" + mahang, true);
	xhttp.send();
}

function clickDeleteOrder(mahang) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		
	  if (this.readyState == 4 && this.status == 200) {
		window.location.replace("/admin.html");
	  }
	};
	xhttp.open("GET", "/xuly_pending.php?del=" + mahang, true);
	xhttp.send();
}

function clickDeleteProduct(mahang) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		
	  if (this.readyState == 4 && this.status == 200) {
		location.reload()
	  }
	};
	xhttp.open("GET", "/xuly_pending.php?del_product=" + mahang, true);
	xhttp.send();
}
function clickFilterOrder() {
	var num = document.getElementById("chinhanhST").value;
	var chinhanh_id = document.getElementById("chinhanhCH").value;
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		
	  if (this.readyState == 4 && this.status == 200) {
		document.getElementById("content_order").innerHTML = this.responseText;
	  }
	};
	xhttp.open("GET", "/filter_a.php?order=" + num + "&type=" + chinhanh_id, true);
	xhttp.send();			
}

function changeReportFollowWeek() {
	var num = document.getElementById("typeReport").value;
	var chinhanh_id = document.getElementById("typeCNNN").value;
	if (num == 4) {
		setTimeout(REALTIME, 1000);
	} else if (num == -1) {
		document.getElementById("content_rp").innerHTML = "";
	} else {
		clearTimeout(REALTIME);
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			
		  if (this.readyState == 4 && this.status == 200) {
			document.getElementById("content_rp").innerHTML = this.responseText;
		  }
		};
		xhttp.open("GET", "/filter_a.php?rp_wk=" + num + "&type=" + chinhanh_id, true);
		xhttp.send();	
	}
			
}

function REALTIME() {
	var num = document.getElementById("typeReport").value;
	var chinhanh_id = document.getElementById("typeCNNN").value;
	if (num == 4) {
					var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
						
					  if (this.readyState == 4 && this.status == 200) {
						document.getElementById("content_rp").innerHTML = this.responseText;
						 myVar = setTimeout(REALTIME, 2000);
					  }
					};
					xhttp.open("GET", "/filter_a.php?rp_wk=" + num + "&type=" + chinhanh_id, true);
					xhttp.send();
	}
	}