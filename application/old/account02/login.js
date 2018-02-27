// JavaScript Document
function fnLogin() {
	var objId = document.getElementById("loginId");
	var objPwd = document.getElementById("loginPwd");
	
	if(objId.value == "") {
		/* no login id */
		objId.focus();
		return;
	} else if (objPwd.value == "") {
		/* no login password */
		objPwd.focus();
		return;
	}
	
	// If login completed
	
}