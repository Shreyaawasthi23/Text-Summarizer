function validateEmail(value,label) {

	    var re = /^[a-zA-Z0-9._%+-]+@(gmail|yahoo|hotmail|outlook|aol|icloud|banasthali|du)\.(com|org|net|info|biz|io|me|co|edu|gov|mil|co\.uk|ac\.in|\.in|\.org)$/;
	    if (re.test(value)) {
	        document.getElementById(label).innerHTML = "";
	        // return true;
	    }
	    else {
	        document.getElementById(label).innerHTML = "Invalid Format!!";
	        // return false;
	    }
    }

    function validatePassword(value,label) {

	    var re = /^[a-zA-Z@0-9']{8}$/;
	    if (re.test(value)) {
	        document.getElementById(label).innerHTML = "";
	        // return true;
	    }
	    else {
	        document.getElementById(label).innerHTML = "Invalid Format!! Should be of length 8 and may consist of uppercase, lowercase letters, digits and @";
	        // return false;
	    }
    }

    function validateText(value,label) {

	    var re = /^[a-zA-Z ']+$/;
	    if (re.test(value)) {
	        document.getElementById(label).innerHTML = "";
	        // return true;
	    }
	    else {
	        document.getElementById(label).innerHTML = "Invalid Format!! May consist of uppercase or lowercase letters only";
	        // return false;
	    }
    }