function sponsor_register(form)
{
	fail = validateName(form.contact_name.value);
	fail+= validateCompany(form.company.value);
	fail+= validateEmail(form.email.value);
	fail+= validatePhoneNumber(form.phonenumber.value);

	if(fail == ""){ return true;}
	else{ alert(fail); return false;}
}

function Validation_contact_form(form)
{
	fail = validateName(form.name.value);
	fail+= validateEmail(form.email.value);
	fail+= validateComment(form.comment.value);

	if(fail == ""){ return true;}
	else{ alert(fail); return false;}
}

function AutoValidation_sponsor_register(form)
{
	$("#phnumber").keyup(function()
	{
		$("#phnumber").val(function(i, num)
		{
			num = num.replace("(","");
			num = num.replace(")","");
			num = num.replace("-","");
			num = num.replace(" ","");	
			if(num.length == 10)
				return "(" + num.substring(0,3) + ") " + num.substring(3,6) + "-" + num.substring(6,10);
			else
				return num;
		});
	});
}

function validateName(field)
{
	if(field == "") return "No name was entered.\n";
	else return "";
}

function validateCompany(field)
{
	if(field == "") return "No company name was entered.\n";
	else return "";
}

function validateEmail(field)
{
	if(field == "") 
		return "No email was entered.\n";
	else if(!((field.indexOf(".") > 0) && (field.indexOf("@") > 0)) || /[^a-zA-Z0-9.@-]/.test(field))
		return "The email address is invalid.";
	else return "";
}

function validatePhoneNumber(field)
{
	if(field == "") 
		return "No phone number was entered.\n";

	if(field.length < 10)
		return "Please enter the acceptable lenth of phone number.";
	else if(!/[0-9]/.test(num))
		return "Please enter only numbers of your phone number.";
	else
		return "";
}

function validateComment(field)
{
	if(field == "") 
		return "No comment was entered.\n";
	else
		return "";
}