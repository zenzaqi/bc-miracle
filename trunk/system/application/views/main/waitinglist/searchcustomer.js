we// JavaScript Document

var winsearch;

function showsearch(namacustomer)
{

winsearch=window.open("searchcustomer.php?cust_nama="+namacustomer,"Search Customer","width=800,height=800,left=500,top=500,toolbar=no,titlebar=no,menubar=0,scrollbars=1");

}
function selectcustomer(nama,id)
{

	opener.document.getElementById("txtcustomer").value=nama;
	opener.document.getElementById("txtcustomer2").value=id;
	window.close();
}
				   