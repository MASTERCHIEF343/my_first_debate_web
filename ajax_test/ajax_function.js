function getXMLHTTPRequest(){
	var req = false;
	try{
		//for firefox
		req = new XMLHttpRequest();
	}catch(err){
		try{
			//for ie
			req = new ActiveXObject("Msxm12.XMLHTTP");
		}catch(err){
			try{
				//for other ie
				req = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(err){
				req = false;
			}	
		}
	}
	return req;
}

function getServerTime(){
	var thePage = 'time.php';
	myRand = parseInt(Math.random()*9999999);
	var URL = thePage+"?rand="+myRand;
	myReq.open("GET",URL,true);
	myReq.onreadystatechange = theHTTPResponse;
	myReq.send(null);
}

function theHTTPResponse(){
	if(myReq.readyState == 4){
		if(myReq.status == 200){
			var timestring = myReq.responseXML.getElementsByTagName("timestring")[0];
			document.getElementById("showtime").innerHTML = timestring.childNodes[0].nodeValue;
		}
	}else{
		document.getElementById("showtime").innerHTML = '<img src="ajax-loader.gif"/>';
	}
}