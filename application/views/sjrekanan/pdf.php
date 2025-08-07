<?php
foreach ($sjrekanan as $itemsingle) {
}
?>
<html>
<head>
  <!-- Theme style -->
 <link rel="stylesheet" href="<?= base_url();?>assets/dist/css/letter.css">
 <title>SJ/REKANAN/<?=$itemsingle->id_lain;?></title>
</head>

<body class="body">
<table style="width:100%">
<thead>
		<tr class="">
			<th style="width:10%">
			<img src="<?=base_url();?>assets/dist/img/logo.jpg" width="75px">
			</th>
			<th class="kiri" style="width:60%">
				<font size="14px">PT. Gramedia Printing - Bandung Plant</font><br>
				<font size="10px"><p>Kawasan Industri Dwi Papuri Abadi Kav D3-D5, Cimanggung, Sumedang<br>
				Phone (022) 7780049 Fax (022) 7780050</p></font>
			</th>
			<th  style="width:30%" class="kanan">
			<font size="15px">SURAT JALAN<br>
				No. SJ/RKN/<?=$itemsingle->id_lain;?></font>
			</th>
		</tr>
		<tr>
			<td class="border-bawah" colspan="3"></td>
		</tr>
		</thead>
	</table>
	<br>
	<div class="font-letter">
	<table style="width:100%" class="">
		<tbody>
		<tr bgcolor="#fff">
			<td style="width:70%" class="kiri">
			Kepada Yth:</td>
			<td style="width:30%" class="kanan">
			<font size="14px">	Sumedang, 
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
<br>
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

	<table style="width:100%" align="center" border="1" cellpadding="4">
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
	</div>
  </body>
  </html>