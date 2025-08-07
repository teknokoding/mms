<?php
foreach ($sjrekanan as $itemsingle) {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Surat Jalan SJ-RKN-<?php echo date('my')."-".$itemsingle->id_lain;?></title>
  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="<?= base_url();?>assets/printpaper/normalize.min.css">
  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="<?= base_url();?>assets/printpaper/paper.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/dist/css/table.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/dist/css/floatingbutton.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>@page { size: A4 }</style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body id="cetak" class="A4 font-letter">
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section id="printarea" class="sheet padding-10mm">
<table class="table">
<tbody>
		<tr>
			<td style="width:10%">
			<img src="<?=base_url();?>assets/dist/img/logo.jpg" width="75px">
			</td>
			<td class="kiri" style="width:60%">
				<b>PT. Gramedia Printing - Bandung Plant</b><br>
				<small>Kawasan Industri Dwi Papuri Abadi Kav D3-D5, Cimanggung, Sumedang<br>
				Phone (022) 7780049 Fax (022) 7780050</small>
			</td>
			<td  style="width:30%" class="kanan">
			<b>SURAT JALAN<br>
				No. SJ/RKN/<?php echo date('my',strtotime($itemsingle->tgl_kirim))."-".$itemsingle->id_lain;?></b>
			</td>
		</tr>
		<tr>
			<td class="border-bawah" colspan="3"></td>
		</tr>
</tbody>
	</table>
	<br>
	<table class="table">
		<tbody>
		<tr>
			<td style="width:70%" class="kiri">
			Kepada Yth:</td>
			<td style="width:30%" class="kanan">
			Sumedang, 
			<?=date('d-M-y',strtotime($itemsingle->tgl_kirim));?>
			</td>
			<tr>
			<td>
				<b><?php $itemsingle->pic_relasi!=''?$pic=$itemsingle->pic_relasi:$pic='';
				$itemsingle->jabatan_relasi!=''?$jabatan=" - ".$itemsingle->jabatan_relasi:$jabatan='';
				echo $pic.$jabatan;?>
				<?php if($itemsingle->pic_relasi!='' || $itemsingle->jabatan_relasi!=''){echo "<br>";}?>
				<?=$itemsingle->nama_relasi;?><br></b>
				<?=$itemsingle->alamat_relasi;?><br><br>
				Mohon diterima barang / part sebagai berikut:
			</td>
			<td></td>
			
		</tr>
		</tbody>
	</table>
	<table class="table table-sm table-bordered">
	<thead class="table-primary">
	<tr>
		<th style="width:5%">No</th>
		<th style="width:21%">Nama Barang</th>
		<th style="width:15%">Mesin</th>
		<th style="width:10%">Qty</th>
		<th style="width:21%">Keterangan</th>
	</tr>
	</thead>
	<tbody>
  <?php
  $no=0;
  foreach ($sjrekanan as $item) {
    $no++;
    echo"
    <tr>
    <td>$no</td>
		<td>$item->nama_barang</td>
		<td>$item->nama_mesin</td>
		<td>$item->qty_kirim $item->kode_satuan</td>
		<td>$item->note</td>
    </tr>
    ";
  }
  ?>
	</tbody>
	</table>
  Atas bantuan dan kerjasamanya kami ucapkan terimakasih.
	<br><br><br>

	<table class="table table-bordered table-sign">
		<tr>
			<td style="width:25%" class="tengah">
			Pengirim<br><br><br>
				<?=$itemsingle->namalengkap?>
			</td>
			<td style="width:25%" class="tengah">
			Expeditur<br><br><br>
			( _________________ )
			</td>
			<td style="width:25%" class="tengah">
			Security<br><br><br>
			( _________________ )
			</td>
			<td style="width:25%" class="tengah">
			Penerima<br><br><br>
			( _________________ )
			</td>
		</tr>
	</table>
  </body> 
<div id="menu">
<a href="#" class="float" id="menu-share">
<i class="fa fa-compass my-float"></i>
</a>
<ul>
<li onclick="cetakpdf();"><a  href="#">
<i class="fa fa-file-pdf my-float"></i>
</a></li>
<li onclick="cetak();"><a href="#">
<i class="fa fa-print my-float"></i>
</a></li>
</ul>
</div>
  <script src="<?= base_url();?>assets/plugins/jquery/jquery.min.js"></script>
  <script src="<?=base_url('assets/dist/js/html2pdf/html2pdf.bundle.js');?>"></script>

  <script>
function cetakpdf(){
	$("#menu").empty();
	 
	var element = document.getElementById('printarea');
var opt = {
  filename:     'SJ-RKN-<?=$item->id_lain;?>',
  html2canvas:  { scale: 3 }
};

// New Promise-based usage:
html2pdf().set(opt).from(element).save();
setTimeout(window.close, 1000);

  }

  function cetak() {
	  $("#menu").hide();
	  window.print();
	  setTimeout(window.close, 1000);

  }
  </script>
  </html>