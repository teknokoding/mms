<?php
foreach ($spk as $itemsingle) {
}
?>
<html>
<head>
  <!-- Theme style -->
 <link rel="stylesheet" href="<?= base_url();?>assets/dist/css/letter.css">
 <title>SPK/CWTD/<?=$itemsingle->id_spkbk;?></title>
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
			<font size="15px">SURAT PERINTAH KERJA<br>
				No. SPK/CWTD/<?=$itemsingle->id_spkbk;?></font>
			</th>
		</tr>
		<tr>
			<td class="border-bawah" colspan="3"></td>
		</tr>
		</thead>
	</table>
	<br>
	<div class="font-letter">
	<table class="">
		<tbody>
		<tr bgcolor="#fff">
			<td style="width:70%" class="kiri">
			Kepada Yth:</td>
			<td style="width:30%" class="kanan">
			<font size="14px">	Sumedang, 
			<?=date('d-M-y',strtotime($itemsingle->tgl_spk));?>
			</td>
			<tr>
			<td>
				<b>Technical Development Superintendent</b><br>
				Maintenance & M/E Department<br>
				Jl. Palmerah Selatan No. 22-28, Jakarta Pusat<br><br>
				Mohon untuk membuat/memodifikasi/memperbaiki part sesuai dengan permintaan kami sebagai berikut:
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
		<th style="width:16%">Spesifikasi</th>
		<th style="width:15%">Mesin</th>
		<th style="width:21%">Instruksi</th>
		<th style="width:10%">Qty</th>
		<th style="width:10%">Target</th>
	</tr>
	</thead>
	<tbody>
  <?php
  $no=0;
  foreach ($spk as $item) {
    $no++;
    echo"
    <tr>
    <td>$no</td>
		<td>$item->nama_barang</td>
		<td>$item->spesifikasi</td>
		<td>$item->nama_mesin</td>
		<td>$item->note</td>
		<td>$item->qty_minta $item->kode_satuan</td>
		<td>".date('d/m/y',strtotime($item->status_pesan))."</td>
    </tr>
    ";
  }
  ?>
	</tbody>
	</table>
  Atas bantuan dan kerjasamanya kami ucapkan terimakasih.
	<br><br><br>

	<table style="width:100%" align="center" border="0" cellpadding="4">
		<tr>
			<td style="width:75%">
				
			</td>
			<td style="width:25%" class="tengah">
			<?php if($itemsingle->acc!=''){$ttd=$itemsingle->acc.'.jpg';}else{$ttd='mme-stamp.png';}?>
				Hormat kami,<br><img src="<?=base_url('assets/dist/img/ttd/'.$ttd);?>" width="100px"><br>
				<u><?=$itemsingle->namalengkap?></u><br>MME Department
			</td>	
		</tr>
	</table>
	</div>
  </body>
  </html>