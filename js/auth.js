function validate()
{
        var reg_name = /^[A-Za-z0-9]*$/;
	var name=$("#name").val().trim();
	var email=$("#email").val().trim();
	var mobile=$("#mobile").val().trim();
	var username=$("#username").val().trim();
	var userclass=$("#class").val().trim();
	var mob_no = /^[0-9]{10}$/;
	if(name=="")
	{
		$("#name").focus();
		$("#status").html('<p class="alert alert-warning alert-dismissible"><b>Enter your name</b></p>');
	}

	else if(mob_no=="")
	{
		$("#mobile").focus();
		$("#status").html('<p class="alert alert-warning alert-dismissible"><b>Enter your mobile number</b></p>');
	}
	else if(!mobile.match(mob_no))
	{
		$("#mobile").focus();
		$("#status").html('<p class="alert alert-warning alert-dismissible"><b>Enter valid mobile number</b></p>');
	}
	else if(username=="")
	{
		$("#username").focus();
		$("#status").html('<p class="alert alert-warning alert-dismissible"><b>Enter your username</b></p>');
	}
        else if(!username.match(reg_name))
	{
		$("#username").focus();
		$("#status").html('<p class="alert alert-warning alert-dismissible"><b>Enter valid username</b></p>');
	}
	else if(userclass=="Select")
	{
		$("#class").focus();
		$("#status").html('<p class="alert alert-warning alert-dismissible"><b>Select your class</b></p>');
	}
	else
	{
		var dataString="name="+name+"&email="+email+"&mobile="+mobile+"&username="+username+"&userclass="+userclass+"&page=data_registration";
		$.ajax({
			type:'POST',
			cache:false,
			data:dataString,
			url:'save_details.php',
			beforeSend:function(){
				$("#status").html('<p class="alert alert-info><b><i class="fa fa-spinner fa-pulse" aria-hidden="true"></i>&nbsp;Verifying...</b></p>"')
			},
			success:function(response)
			{
				if(response.indexOf('successful')!=-1)
				{
					location.reload();
				}
				else
				{
					$("#status").html('<p class="alert alert-warning alert-dismissible"><b>'+response+'</b></p>');
				}
			}
		});
	}
	return false;
}

function update()
{ 
	var ans = $("#ans").val().trim().toString();
	dataString = 'ans='+ans;
	// alert(dataString);
	$.ajax({
		type : 'post',
		url : 'update_details.php',
		data : dataString,
		cache: false,
		success : function(response){
			if(String(response) == 'Successful')
			{
                                alert('Right Answer');
				location.reload();
			}
			else
			{
				// alert(response);
			}
		}
	});
}

function logout()
{
	$.ajax({
		url : 'logout.php',
		cache: false,
		success : function(response){
			if(String(response) == 'successful')
			{
				location.reload();
			}
			else
			{
				// alert(response);
			}
		}
	});
}


