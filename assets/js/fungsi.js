//window.history.forward(1);

function checkNumber(e)
{
	var whichCode = (window.Event) ? e.which : e.keyCode;
	var IsnoSpecialChar = true;

	if ((whichCode == 0) || (whichCode == 13) ||(whichCode == 8) || (whichCode == 32) || (whichCode >= 48 && whichCode <= 57))
	{
		IsnoSpecialChar = true
	}
	else
	{
		IsnoSpecialChar = false
	}

	return IsnoSpecialChar;
}

function textCounter(field,cntfield,maxlimit)
{
	if (field.value.length > maxlimit) // if too long...trim it! 
		field.value = field.value.substring(0, maxlimit); 
	else 
		cntfield.value = maxlimit - field.value.length; 
}



function upperCase(x)
{
	var y=document.getElementById(x).value
	document.getElementById(x).value=y.toUcwords()
}

function ignoreSpaces(string)
{
	var temp = "";
	string = '' + string;
	splitstring = string.split(" ");
	for(i = 0; i < splitstring.length; i++)
		temp += splitstring[i];
	return temp;
}

function NumOnly(e)
{
	var whichCode = (window.Event) ? e.which : e.keyCode;
	var IsnoSpecialChar = true;
	if (
            (whichCode == 123) ||
            (whichCode == 124) ||
            (whichCode == 125) ||
            (whichCode == 126) ||
            (whichCode == 44) ||
            (whichCode == 45) ||
            (whichCode == 46) || (whichCode == 64) || (whichCode == 59) ||
            (whichCode > 32 && whichCode < 48) || (whichCode > 57 && whichCode < 65) || (whichCode > 64 && whichCode < 97) || (whichCode > 96 && whichCode < 123))
	{
		IsnoSpecialChar = false
	}
	return IsnoSpecialChar;
}

function DateFormat(e)
{
	// allow dash (-)
	var whichCode = (window.Event) ? e.which : e.keyCode;
	var IsnoSpecialChar = true;
	//alert(whichCode);
	if (
            (whichCode == 123) ||
            (whichCode == 124) ||
            (whichCode == 125) ||
            (whichCode == 126) ||
            (whichCode == 44) ||
            (whichCode == 47) ||
            (whichCode == 46) || (whichCode == 64) || (whichCode == 59) ||
            (whichCode > 32 && whichCode < 43) || (whichCode > 57 && whichCode < 65) || (whichCode > 64 && whichCode < 97) || (whichCode > 96 && whichCode < 123))
	{
		IsnoSpecialChar = false
	}
	return IsnoSpecialChar;
}

function AlfaOnly(e)
{	
	// allow comma(,) and period(.)
	var whichCode = (window.Event) ? e.which : e.keyCode;
	var IsnoSpecialChar = true;
        //alert(whichCode);
	if (
            (whichCode == 123) ||
		(whichCode == 124) ||
		(whichCode == 125) ||
		(whichCode == 126) ||
		(whichCode == 44) ||
		(whichCode == 45) ||
		(whichCode == 46) ||
		(whichCode == 91) || (whichCode == 92) || (whichCode == 93) || (whichCode == 94) || (whichCode == 95) || (whichCode == 96) || (whichCode == 64) ||
            whichCode == 61 || whichCode == 47 || whichCode == 63 || (whichCode > 32 && whichCode < 44) || (whichCode > 47 && whichCode < 60) || (whichCode > 122 && whichCode < 223))
	{
		IsnoSpecialChar = false
	}
	return IsnoSpecialChar;
}


function Alfa1(e)
{	
	// allow dash (-)
	var whichCode = (window.Event) ? e.which : e.keyCode;
	var IsnoSpecialChar = true;
     //  alert(whichCode);
	if (
        (whichCode == 123) ||
		(whichCode == 124) ||
		(whichCode == 125) ||
		(whichCode == 126) ||
		(whichCode == 44) ||
		(whichCode == 46) ||
		(whichCode == 91) || (whichCode == 92) || (whichCode == 93) || (whichCode == 94) || (whichCode == 95) || (whichCode == 96) || (whichCode == 64) ||
            whichCode == 61 || whichCode == 47 || whichCode == 63 || (whichCode > 32 && whichCode < 44) || (whichCode > 47 && whichCode < 60) || (whichCode > 122 && whichCode < 223))
	{
		IsnoSpecialChar = false
	}
	return IsnoSpecialChar;
}


function AlfaNum(e)
{	
	// Alfanumerik Only
	var whichCode = (window.Event) ? e.which : e.keyCode;
	var IsnoSpecialChar = true;
	//alert(whichCode);
	if (

		(whichCode == 123) ||
		(whichCode == 124) ||
		(whichCode == 125) ||
		(whichCode == 126) ||
		(whichCode == 44) ||
		(whichCode == 45) ||
		(whichCode == 46) ||
		(whichCode == 91) || (whichCode == 92) || (whichCode == 93) || (whichCode == 94) || (whichCode == 95) || (whichCode == 96) ||
		(whichCode > 32 && whichCode < 44) || 
		(whichCode > 46 && whichCode < 48) || 
		(whichCode > 57 && whichCode < 65) //|| 
//		(whichCode >= 65 && whichCode <= 122)
		)
	{
		IsnoSpecialChar = false
	}
	return IsnoSpecialChar;
}

//bisa pake carakter titik dan koma
function AlfaNum2(e)
{	
	// Allow Dash, dot, comma
	var whichCode = (window.Event) ? e.which : e.keyCode;
	var IsnoSpecialChar = true;
	// alert(whichCode);
	if (

		(whichCode == 123) ||
		(whichCode == 124) ||
		(whichCode == 125) ||
		(whichCode == 126) ||
//		(whichCode == 44) ||
//		(whichCode == 45) ||
//		(whichCode == 46) ||
		(whichCode == 91) || (whichCode == 92) || (whichCode == 93) || (whichCode == 94) || (whichCode == 95) || (whichCode == 96) ||
		(whichCode > 32 && whichCode < 44) || 
		(whichCode > 46 && whichCode < 48) || 
		(whichCode > 57 && whichCode < 65) //|| 
//		(whichCode >= 65 && whichCode <= 122)
		)
	{
		IsnoSpecialChar = false
	}
	return IsnoSpecialChar;
}

function AddRess(e)
{	
	// Alamat cek
	var whichCode = (window.Event) ? e.which : e.keyCode;
	var IsnoSpecialChar = true;
	//alert(whichCode);
	if (
		(whichCode == 123) ||
		(whichCode == 124) ||
		(whichCode == 125) ||
		(whichCode == 126) ||
		(whichCode == 91) || (whichCode == 93) || (whichCode == 94) || (whichCode == 95) || (whichCode == 96) ||
		(whichCode > 32 && whichCode < 44) || 
		(whichCode > 46 && whichCode < 47) || 
		(whichCode > 57 && whichCode < 65) 
		)
	{
		IsnoSpecialChar = false
	}
	return IsnoSpecialChar;
}

function Email(e)
{	
	// Alamat cek
	var whichCode = (window.Event) ? e.which : e.keyCode;
	var IsnoSpecialChar = true;
	//alert(whichCode);
	if (
		(whichCode == 123) ||
		(whichCode == 124) ||
		(whichCode == 125) ||
		(whichCode == 126) ||
		(whichCode == 91) || (whichCode == 93) || (whichCode == 94) || (whichCode == 96) ||
		(whichCode > 32 && whichCode < 44) || 
		(whichCode > 46 && whichCode < 47) || 
		(whichCode > 57 && whichCode < 64) 
		)
	{
		IsnoSpecialChar = false
	}
	return IsnoSpecialChar;
}



/* ----------------------------- begin currency format ----------------------------- */
function CcyFormat(amount)
{
	if (amount.length > 14) { amount = 0 }
	var i = parseFloat(amount);
	if(isNaN(i)) { i = 0.00; }
	var minus = '';
	if(i < 0) { minus = '-'; }
	i = Math.abs(i);
	i = parseInt((i + .005) * 100);
	i = i / 100;
	s = new String(i);	
	if(s.indexOf('.') < 0) { s += '.00'; }
	if(s.indexOf('.') == (s.length - 2)) { s += '0'; }
	s = minus + s;
	return s;
} // function CurrencyFormatted()

function ComaFormat(amount)
{
	var delimiter = ",";
	var a = amount.split('.',2)
	var d = a[1];
	var i = parseInt(a[0]);
	if(isNaN(i)) { return ''; }
	var minus = '';
	if(i < 0) { minus = '-'; }
	i = Math.abs(i);
	var n = new String(i);
	var a = [];
	while(n.length > 3)
	{
		var nn = n.substr(n.length-3);
		a.unshift(nn);
		n = n.substr(0,n.length-3);
	}
	if(n.length > 0) { a.unshift(n); }
	n = a.join(delimiter);
	if(d.length < 1) { amount = n; }
	else { amount = n + '.' + d; }
	amount = minus + amount;
	return amount;
} // function CommaFormatted()

function CcyUpdate(amount)
{
	var s = new String();
	s = CurrencyFormatted(amount);
	s = CommaFormatted(s);
	return s;
}

function decimals(evt,id)
{
	try{
        var charCode = (evt.which) ? evt.which : event.keyCode;
  
        if(charCode==46){
            var txt=document.getElementById(id).value;
            if(!(txt.indexOf(".") > -1)){
	
                return true;
            }
        }
        if (charCode > 31 && (charCode < 48 || charCode > 57) )
            return false;

        return true;
	}catch(w){
		//alert(w);
	}
};
function formatPrice(number) {

    var decimalSeparator = ".";
    var thousandSeparator = ".";

    // make sure we have a string
    var result = number + "";

    // split the number in the integer and decimals, if any
    var parts = result.split(decimalSeparator);

    // if we don't have decimals, add .00
    if (!parts[1]) {
      parts[1] = "00";     
    }
  
    // reverse the string (1719 becomes 9171)
    result = parts[0].split("").reverse().join("");

    // add thousand separator each 3 characters, except at the end of the string
    result = result.replace(/(\d{3}(?!$))/g, "$1" + thousandSeparator);

    // reverse back the integer and replace the original integer
    parts[0] = result.split("").reverse().join("");

    // recombine integer with decimals
    //return parts.join(decimalSeparator);
    return  parts[0];
}

function awbformat(value){
	var sub1 = value.substring(0,3);//get 3 angka didepan
	var midle = value.substring(3);//get angka setelah 3 angka didepan
	var sub2 = midle.substring(0,4);//get 4 angka dari mid
	var sub3 = value.substring(7);//get angka setelah 7 angka didepan	
	if (sub2.length > 0 && sub3.length < 1){
		return sub1+'-'+sub2;
	}else if (sub3.length > 0){
		return sub1+'-'+sub2+' '+sub3;
	}else{
		return '';
	}
	
}
