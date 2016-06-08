function getXMLHTTPRequest() {
   var req =  false;
   try {
      /* for Firefox */
      req = new XMLHttpRequest(); 
   } catch (err) {
      try {
         /* for some versions of IE */
         req = new ActiveXObject("Msxml2.XMLHTTP");
      } catch (err) {
         try {
            /* for some other versions of IE */
            req = new ActiveXObject("Microsoft.XMLHTTP");
         } catch (err) {
            req = false;
         }
     }
   }
   return req;
}

function login(){
	var url = "log_in.php";
	var params = "name=" + encodeURI(document.getElementById("username").value) + "&passwd=" + encodeURI(document.getElementById("password").value) + "&yzm=" + encodeURI(document.getElementById("yanzhengma").value);
	myReq.open("POST",url,true);
	myReq.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	myReq.setRequestHeader("Content-length", params.length*2);
	myReq.setRequestHeader("Connection", "close");
	myReq.onreadystatechange = login_success;
	myReq.send(params);
}

function login_success(){
	if(myReq.readyState == 4){
		if(myReq.status == 200){
			window.location.href = 'main_page.php';
		}else{
			var text = myReq.responseText;
			console.log(text);
			tub.alert(text);
		}
	}
}