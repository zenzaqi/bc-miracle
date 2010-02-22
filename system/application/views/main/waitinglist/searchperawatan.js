we// JavaScript Document

var winsearch;

function showsearchperawatan(namaperawatan)
{

winsearch=window.open("searchperawatan.php?rawat_nama="+namaperawatan,"Search Perawatan","width=600,height=500,left=100,top=100,toolbar=no,titlebar=no,menubar=0,scrollbars=1");

}
function selectperawatan(nama,id)
{

	opener.document.getElementById("txtperawatan").value=nama;
	opener.document.getElementById("txtperawatan2").value=id;
	window.close();
}
				   