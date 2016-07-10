function validateForm()
	{
		var fullname=document.forms["fields"]["name"].value;
		var name=document.forms["fields"]["uname"].value;
		var email=document.forms["fields"]["email"].value;
		var phno=document.forms["fields"]["phno"].value.toString();
		var gender=document.forms["fields"]["gender"].value;
		var password=document.forms["fields"]["pass"].value;
		var letternumber=/^[a-zA-Z0-9]+$/;
		var renumber=/[0-9]/;
		var relower=/[a-z]/;
		var reupper=/[A-Z]/;
		var regex_symbols= /[-!$%^&*()_+|~=`{}[]:/;
		var error=0;
		if(!name.match(letternumber))
		{
			alert("Username can contain only letters and numbers");
			error=1;
			document.forms["fields"]["uname"].focus();
		}
		else if(!(/^[A-Za-z\s]+$/.test(fullname)))
		{
			alert("Name can only contain letters and spaces");
			error=1;
			document.forms["fields"]["name"].focus();
		}
		else if(name.length<5 || name.length>15)
		{
			alert("Username must contain 5-15 characters");
			error=1;
			document.forms["fields"]["uname"].focus();
		}
		else if(phno.length<8)
		{
			alert("Enter valid phone number");
			error=1;
			document.forms["fields"]["phno"].focus();
		}
		else if(gender!="M" && gender!="F")
		{
			alert("Gender has to be M or F");
			error=1;
			document.forms["fields"]["gender"].focus();
		}
		else if(password.length<5)
		{
			alert("Password must contain atleast 5 characters");
			error=1;
			document.forms["fields"]["pass"].focus();
		}
		else if(password.match(name))
		{
			alert("Username Should be different from password");
			error=1;
			document.forms["fields"]["pass"].focus();
		}
		else if(!renumber.test(password) || !relower.test(password) || !reupper.test(password))
		{
			alert("Password must contain atleast 1 number,1 lowercase alphabet,1 upper case alphabet");
			error=1;
			document.forms["fields"]["pass"].focus();
		}
	if(error==1)
		return false;
	else {$err=0;return true;}
	}
document.getElementById('fields').addEventListener("submit",function(e){

    e.preventDefault();
    var f = e.target;
    var form1 = new FormData(f);
    var xhttp = new XMLHttpRequest();
	
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4  && xhttp.status == 200 ) {
				
				if (xhttp.responseText.search("Success")>=0) {
                alert("Successfully registered");
                window.location.href = 'profile.php';
			}
            else
                document.getElementById("errorstatus").innerHTML=xhttp.responseText;
        }
    };
    xhttp.open("POST", "registeruser.php", true);
    xhttp.send(form1);
});
