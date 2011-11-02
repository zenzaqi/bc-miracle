<?php
/* 	These code was generated using phpCIGen v 0.1.b (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	
	+ Module  		: jual_bank Controller
	+ Description	: For record controller process back-end
	+ Filename 		: C_lap_netsales.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

//class of jual_bank
class C_lap_netsales extends Controller {

	//constructor
	function C_lap_netsales(){
		parent::Controller();
		$this->load->model('m_lap_netsales', '', TRUE);
		//$this->load->plugin('to_excel');
		$this->load->helper('url');
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
		$this->load->view('main/v_lap_netsales');
	}
	
	function get_action(){
		$task = $_POST['task'];
		switch($task){
			case "LIST":
				$this->laporan_netsales_list();
				break;
			case "LISTTOTAL":
				$this->laporan_netsalestotal_list();
				break;
			case "RECALC":
				$this->laporan_netsales_recalc();
				break;
			case "RECALC2":
				$this->laporan_netsales_search2();
				break;
			case "SEARCH":
				$this->laporan_netsales_search();
				break;
			case "SEARCH2":
				$this->laporan_netsales_search2();
				break;
			case "PRINT":
				$this->tindakan_print();
				break;
			case "EXCEL":
				$this->tindakan_export_excel();
				break;
			case "CHART":
				$this->laporan_netsales_chart();
				break;
			default:
				echo "{failure:true}";
				break;
		}
	}
	
	function laporan_netsales_recalc(){
		$tgl_awal=(isset($_POST['tgl_awal']) ? @$_POST['tgl_awal'] : @$_GET['tgl_awal']);
		$tgl_akhir=(isset($_POST['tgl_akhir']) ? @$_POST['tgl_akhir'] : @$_GET['tgl_akhir']);
		$bulan=(isset($_POST['bulan']) ? @$_POST['bulan'] : @$_GET['bulan']);
		$tahun=(isset($_POST['tahun']) ? @$_POST['tahun'] : @$_GET['tahun']);
		$periode=(isset($_POST['periode']) ? @$_POST['periode'] : @$_GET['periode']);

		$result=$this->m_lap_netsales->get_laporan_netsales_recalc($tgl_awal, $tgl_akhir, $periode, $bulan, $tahun);
		
		echo $result; 
	}
	
	function laporan_netsales_search(){
		$tgl_awal=(isset($_POST['tgl_awal']) ? @$_POST['tgl_awal'] : @$_GET['tgl_awal']);
		$tgl_akhir=(isset($_POST['tgl_akhir']) ? @$_POST['tgl_akhir'] : @$_GET['tgl_akhir']);
		$bulan=(isset($_POST['bulan']) ? @$_POST['bulan'] : @$_GET['bulan']);
		$tahun=(isset($_POST['tahun']) ? @$_POST['tahun'] : @$_GET['tahun']);
		$periode=(isset($_POST['periode']) ? @$_POST['periode'] : @$_GET['periode']);
		
		$result=$this->m_lap_netsales->get_laporan_netsales($tgl_awal, $tgl_akhir, $periode, $bulan, $tahun);
		
		echo $result; 
	}
	
	function laporan_netsales_list(){
		$tgl_awal="";
		$tgl_akhir="";
		$bulan=date("m");
		$tahun=date("Y");
		$periode="bulan";
		
		$result=$this->m_lap_netsales->get_laporan_netsales($tgl_awal, $tgl_akhir, $periode, $bulan, $tahun);
		
		echo $result; 
	}
	
	function laporan_netsales_search2(){
		$tgl_awal=(isset($_POST['tgl_awal']) ? @$_POST['tgl_awal'] : @$_GET['tgl_awal']);
		$tgl_akhir=(isset($_POST['tgl_akhir']) ? @$_POST['tgl_akhir'] : @$_GET['tgl_akhir']);
		$bulan=(isset($_POST['bulan']) ? @$_POST['bulan'] : @$_GET['bulan']);
		$tahun=(isset($_POST['tahun']) ? @$_POST['tahun'] : @$_GET['tahun']);
		$periode=(isset($_POST['periode']) ? @$_POST['periode'] : @$_GET['periode']);
		
		$result=$this->m_lap_netsales->get_laporan_netsalestotal($tgl_awal, $tgl_akhir, $periode, $bulan, $tahun);
		
		echo $result; 
	}

	function laporan_netsalestotal_list(){
		$tgl_awal="";
		$tgl_akhir="";
		$bulan=date("m");
		$tahun=date("Y");
		$periode="bulan";
		
		
		$result=$this->m_lap_netsales->get_laporan_netsalestotal($tgl_awal, $tgl_akhir, $periode, $bulan, $tahun);
		
		echo $result; 
	}
	
	function laporan_netsales_chart()
	{	/*	
	    $tgl_awal=(isset($_POST['tgl_awal']) ? @$_POST['tgl_awal'] : @$_GET['tgl_awal']);
		$tgl_akhir=(isset($_POST['tgl_akhir']) ? @$_POST['tgl_akhir'] : @$_GET['tgl_akhir']);
		$bulan=(isset($_POST['bulan']) ? @$_POST['bulan'] : @$_GET['bulan']);
		$tahun=(isset($_POST['tahun']) ? @$_POST['tahun'] : @$_GET['tahun']);
		$periode=(isset($_POST['periode']) ? @$_POST['periode'] : @$_GET['periode']); */
		
		/**
		 * We are going to use these statements until we have figured the update method out in view section.
		 * These statements force to grab a month netsales data whatever date condition met.
		 */
		 /*
        if ($periode == "bulan")
		{
		  $tgl =  strtotime("01-".$bulan."-".$tahun);
		}
		else if ($periode == "tanggal")
		{
		  $tmp = explode("-",$tgl_awal);
		  $tgl = strtotime($tmp[2]."-".$tmp[1]."-".$tmp[0]);
		  $bulan = $tmp[1];
		  $tahun = $tmp[0];
		  $periode = "bulan";
		} */
		$tgl_awal="";
		$tgl_akhir="";
		$tahun=date("Y");
		$bulan=date("m")-1;
		//echo "01".$bulan."-".$tahun;
		$bulan_title = date("M",strtotime("01-".$bulan."-".$tahun));
		
		$periode="bulan";

		$title = "Laporan Net Sales Bulan ".$bulan_title;
		$subtitle = "Trial version. Chart only shows net sales data for previous one month.";
		
		$netsales_type = array("tns_tanggal" => "Tanggal",
							   "tns_medis" => "Medis",
							   "tns_nonmedis" => "Non Medis",
							   "tns_surgery" => "Surgery",
							   "tns_antiaging" => "Anti Aging",
							   "tns_produk" => "Produk",
							   "tns_lainlain" => "Lain-Lain",
							   "tns_total" => "Total");
		
		$result=$this->m_lap_netsales->get_laporan_netsales($tgl_awal, $tgl_akhir, $periode, $bulan, $tahun,$chart='true');
		//print_r($result);
		
		$this->load->library('highcharts');
		
		$this->highcharts->set_type('line'); // chart type
		$this->highcharts->set_title($title, $subtitle); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('Bulan', 'Nominal'); // axis titles: x axis,  y axis
		
		
		$data_axis['categories'] = array();
		
		//for($x=0; $x<count($netsales_type); $x++)
		$x=0;
		foreach($netsales_type as $type_idx => $type_name)
		{
		    $data["'".$type_idx."'"]['data'] = array();
			$data["'".$type_idx."'"]['name'] = $type_idx;

				

			$i = 0;
			foreach($result as $row_data) {
				$value = 0;
				if ($type_idx == 'tns_tanggal')
				{
				  
		          $data_axis['categories'][$i] = $row_data->$type_idx;
			    }
				else
				{
				  $data["'".$type_idx."'"]['data'][$i] = (int) $row_data->$type_idx;
				}
	
				$i++;

			}
			if ($type_idx != 'tns_tanggal') 
			{
				$this->highcharts->set_serie($data["'".$type_idx."'"],$type_name);
			}
		}
		
		$data['axis']['categories'] = array();

		for ($y=0; $y<count($data_axis['categories']); $y++)
		{
			$tmp_date = $data_axis['categories'][$y];
		    $data['axis']['categories'][$y] = date('d M', strtotime($tmp_date));
		}
		
		$this->highcharts->set_xAxis($data['axis']);
		$this->highcharts->set_dimensions(1170,380);
		$graph_data = $this->highcharts->render();
		
		$data['charts'] = $graph_data;
		
		$print_view=$this->load->view("main/template_chart.php",$data,TRUE);
	
		if(!file_exists("print")){
			mkdir("print");
		}
		$filename = "print/lap_netsales_graph.php";
		if(file_exists($filename)){
			unlink($filename);
			$this->clearBrowserCache();
		}
	
		$print_file=fopen("print/lap_netsales_graph.php","w+");
		fwrite($print_file, $print_view);
		echo '1';
	}
	
	function clearBrowserCache() {
		header("Cache-Control: no-cache, must-revalidate");
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Content-Type: application/xml; charset=utf-8");
	}
	
}
?>