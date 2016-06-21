var CHARCODE_SHADDA = 1617;
var CHARCODE_SUKOON = 1618;
var CHARCODE_SUPERSCRIPT_ALIF = 1648;
var CHARCODE_TATWEEL = 1600;
var CHARCODE_ALIF = 1575;

function isCharTashkeel(letter)
{
  if (typeof(letter) == "undefined" || letter == null)
    return false;

  var code = letter.charCodeAt(0);
  //1648 - superscript alif
  //1619 - madd: ~
  return (code == CHARCODE_TATWEEL || code == CHARCODE_SUPERSCRIPT_ALIF || code >= 1612 && code <= 1631); //tashkeel
}

function stripTashkeel(input)
{
  var output = "";
  //todo consider using a stringbuilder to improve performance
  for (var i = 0; i < input.length; i++)
  {
  var letter = input.charAt(i);
  if (!isCharTashkeel(letter)) //tashkeel
    output += letter;
  }
  return output;
}

function validateForm()
{
  document.forms["searchform"]["searchedtext"].value = stripTashkeel(document.forms["searchform"]["searchedtext"].value);
  var a=document.forms["searchform"]["searchedtext"].value;

  if(a==null || a=="") {
    alert("Please fill the search box.");
    return false;
  }

  var a = document.getElementById("searchbox").value;

  if(a.toLowerCase().indexOf("a")>-1 || a.toLowerCase().indexOf("b")>-1 || a.toLowerCase().indexOf("c")>-1 || a.toLowerCase().indexOf("d")>-1 || a.toLowerCase().indexOf("e")>-1 || a.toLowerCase().indexOf("f")>-1 || a.toLowerCase().indexOf("g")>-1 || a.toLowerCase().indexOf("h")>-1 || a.toLowerCase().indexOf("i")>-1 || a.toLowerCase().indexOf("j")>-1 || a.toLowerCase().indexOf("k")>-1 || a.toLowerCase().indexOf("l")>-1 || a.toLowerCase().indexOf("m")>-1 || a.toLowerCase().indexOf("n")>-1 || a.toLowerCase().indexOf("o")>-1 || a.toLowerCase().indexOf("p")>-1 || a.toLowerCase().indexOf("q")>-1 || a.toLowerCase().indexOf("r")>-1 || a.toLowerCase().indexOf("s")>-1 || a.toLowerCase().indexOf("t")>-1 || a.toLowerCase().indexOf("u")>-1 || a.toLowerCase().indexOf("v")>-1 || a.toLowerCase().indexOf("w")>-1 || a.toLowerCase().indexOf("x")>-1 || a.toLowerCase().indexOf("y")>-1 || a.toLowerCase().indexOf("z")>-1) {
    document.getElementById("englishchars").style.display = "inline";
    return false;
  } else {
    document.getElementById("englishchars").style.display = "none";
    return true;
  }
}

function hideenglishchars() {
  document.getElementById("englishchars").style.display = "none";
}
