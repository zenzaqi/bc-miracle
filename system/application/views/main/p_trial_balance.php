<?php /* These code was generated using phpCIGen v 0.1.b (24/06/2009)#zaqi zaqi.smart@gmail.com,http:#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id+ Module : tbl_t_buku_besar Print+ Description: For Print View+ Filename : p_tbl_t_buku_besar.php + Author : + Created on 27/May/2010 16:40:49*/ ?><?php if(@$type!=="excel") { ?><!DOCTYPE html PUBLIC "-//W3C<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Laporan Trial Balance</title><link rel='stylesheet' type='text/css' href='../assets/modules/main/css/printstyle.css'/></head><body onload="window.print();"><?php } ?><table summary='Laporan Neraca Percobaan'><thead> <tr> <td colspan="9" nowrap="nowrap"> <div style="float:left; margin-left:10px; margin-top:5px;" ><center><b> <h1>Laporan Neraca Percobaan</h1></b></center> </div> </td> </tr> <tr> <th rowspan="2" scope='col'>No</th> <th rowspan="2" scope='col'>Kode</th> <th rowspan="2" scope='col'>Nama Rekening</th><th rowspan="2" scope='col'>CR/DB</th><th rowspan="2" scope='col'>Beginning</th><th colspan="2" scope='col'>Total Transaction</th> <th rowspan="2" scope='col'>Ending</th> </tr> <tr> <th scope='col'>Debet</th> <th scope='col'>Kredit</th> </tr> </thead><tbody><?php $total_awal=0;$total_kredit=0;$total_debet=0;$total_saldo=0;$i=0;if(count($data_print)>0){foreach($data_print as $print_list){if($print_list->akun_nama!=='TOTAL'){$i++; ?><tr> <td><?php echo $i; ?></td> <td><?php echo $print_list->akun_kode; ?></td> <td><?php echo $print_list->akun_nama; ?></td><td><?php echo $print_list->akun_awal_jenis; ?></td><td align="right" class="numeric"><?php if(@$type!=="excel") { ?><?php echo number_format($print_list->akun_awal); ?><?php }else{ echo $print_list->akun_awal; } ?> </td><td align="right" class="numeric"><?php if(@$type!=="excel") { ?><?php echo number_format($print_list->akun_debet); ?><?php }else{ echo $print_list->akun_debet; } ?></td> <td align="right" class="numeric"><?php if(@$type!=="excel") { ?><?php echo number_format($print_list->akun_kredit); ?><?php }else{ echo $print_list->akun_kredit; } ?></td> <td align="right" class="numeric"><b><?php if(@$type!=="excel") { ?><?php echo ($print_list->akun_akhir<0?"(".number_format(abs($print_list->akun_akhir)).")":number_format($print_list->akun_akhir)); ?><?php }else{ echo ($print_list->akun_akhir<0?"(".abs($print_list->akun_akhir).")":$print_list->akun_akhir) ; } ?></b></td></tr><?php $total_awal+=($print_list->akun_awal_jenis=='DB'?$print_list->akun_awal:-$print_list->akun_awal);$total_debet+=$print_list->akun_debet;$total_kredit+=$print_list->akun_kredit; $total_saldo+=($print_list->akun_awal_jenis=='DB'?$print_list->akun_akhir:-$print_list->akun_akhir);}}} ?> </tbody> <tfoot> <tr> <td colspan="3"><b>TOTAL</b></td>  <td>&nbsp; </td> <td align="right" class="numeric"><b><?php echo number_format($total_awal); ?></b></td><td align="right" class="numeric"><b><?php echo number_format($total_debet); ?></b></td> <td align="right" class="numeric"><b><?php echo number_format($total_kredit); ?></b></td> <td align="right" class="numeric"><b><?php echo ($total_saldo<0?"(".number_format(abs($total_saldo)).")":number_format($total_saldo)); ?></b></td></tr></tfoot></table><?php if(@$type!=="excel") { ?></body></html><?php } ?>