<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<title>Cetak Printout</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets\bower_components\bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets\bower_components\jquery-ui\css\jquery-ui.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets\css\style-print.css" >

</head>
<body>
	<html lang="en">
	<head>
		<meta charset='UTF-8'>
		<title>Editable Invoice</title>
		<style type="text/css">
			.no-border {
				border-top: 0px solid !important;
			}
			.border-dotted {
				border-bottom: dotted 2px;
				    border-top: none;
    			border-left: none;
    			border-right: none;
			}
		</style>
	</head>
	<body>
		<div id="page-wrap">
			<? if($page == "invoice"){ ?>
				<div class="row">
					<table class="table" style="margin-bottom: 0;">
						<tr>
							<td style="border:none">
								<img src="<?= base_url(); ?>assets\images\cropped-logo-wml-180x180.png" style="height: 80px;width: 80px;" class="">
							</td>
							<td style="border:none">
								<h1 style="color: #1616a0;">PT.Wahana Multi Logistik</h1>
								<h4 style="font-size: 18px;color: #1616a0;">Head Office:<br>
								JL.Kemang Raya No.52 Jati Cempaka, Pondok Gede - Bekasi 17411<br>
								Telp: 021-8499 8777, Fax : 021-8497 4046
								</h4>
							</td>
						</tr>
					</table>
				</div>
				
				<div>
					
					<!---->
					<table style="margin-bottom: 0; width: 100%;">
                        <tr>
                            <td colspan="12">
                                <table style="width: 100%">
        							<tr>
        								<td class="no-border" style="font-weight: bold;vertical-align: top;">To :</td>
        								<td class="no-border" style="font-weight: bold;">
        									<?= empty($data) ? "" : nl2br($data['alamat_penagihan']) ?>
        								</td>
        								<td class="no-border">
        									<table id="meta">
        										<tr>
        											<td class="meta-head no-border">Invoice</td>
        											<td class="no-border"><?= empty($data) ? "" : $data['no_invoice']?></td>
        										</tr>
        										<tr>
        
        											<td class="meta-head no-border">Date</td>
        											<td class="no-border"><?= empty($data) ? "" : tgl_indo($data['tgl_invoice'])?></td>
        										</tr>
        									</table>
        								</td>
        							</tr>
        						</table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="12" style="padding:0">
                                <h1 class="header-inv" style="background-color: #1616a0;margin-bottom: 0;">INVOICE</h1>
                            </td>
                        </tr>
						<tr>
							<th>No</th>
							<th>Tgl Pickup</th>
							<th>Dari</th>
							<th>Tujuan</th>
							<th>No PO/NP</th>
							<th>Nama Barang</th>
							<th>Layanan</th>
							<th>Qty</th>
							<th>Satuan</th>
							<th>Berat / KG</th>
							<th>Harga</th>
							<th style="text-align: right;">Subtotal</th>
						</tr>

						<?php 
	                    $urut=1;
	                    foreach($data_detail as $row): ?>
						<tr class="item-row">
							<td><?=$urut?></td>
							<td class="item-name"><?= tgl_indo($row["pickup_date"]) ?></td>
							<td class="item-name"><?= $row["nama_pengirim"] ?></td>
							<td class="item-name"><?= $row["nama_penerima"] ?></td>
							<td class="item-name"><?= $row["spk"] ?></td>

							<td class="item-name" style="width:100px;"><?= $row["nama_barang"] ?></td>
							<td class="item-name"><?= $row["layanan"] ?></td>
							<td class="item-name"><?= $row["qty"] ?></td>
							<td class="item-name"><?= $row["satuan"] ?></td>
							<td class="item-name"><?= $row["kg"] ?></td>
							<td style="text-align: right;"><?= ($row["kg"]>0 ? number_format($row["price"]) : number_format($row["price_chartered"])) ?></td>
							<td style="text-align: right;"><?= number_format($row["subtotal"]) ?></td>						
						</tr>
						<?php $urut++?>
	                    <?php endforeach; ?>
	                    <tr class="item-row">
							<td colspan="11" style="text-align: right;">Subtotal</td>
							<td style="text-align: right;"><?= number_format($data["subtotal"]) ?></td>
						</tr>
						<?php if(intval($data["cost"]) > 0): ?>
	                    <tr>
							<th>No</th>
							<th colspan="10">Kegiatan</th>
							<th style="text-align: right;">Biaya</th>
						</tr>
						<?php endif; ?>
						<?php 
	                    $urut=1;
	                    foreach($data_biaya as $row): ?>
						<tr class="item-row">
							<td><?=$urut?></td>
							<td class="item-name" colspan="10"><?= $row["aktifitas"] ?></td>
							<td style="text-align: right;"><?= number_format($row["biaya"]) ?></td>					
						</tr>
						<?php $urut++?>
	                    <?php endforeach; ?>
						<?php if(intval($data["cost"]) > 0): ?>
						<tr class="item-row">
							<td colspan="11" style="text-align: right;">Charge</td>
							<td style="text-align: right;"><?= number_format($data["cost"]) ?></td>
						</tr>   
						<?php endif; ?>
						<tr>
							<td colspan="11" class="total-line" style="text-align: right;font-weight: bold;">Grand Total</td>
							<td class="total-value" style="text-align: right;font-weight: bold;"><?= number_format($data["cost"] + $data["subtotal"]) ?></td>
						</tr>
						<tr>
							<td colspan="11" class="total-line" style="text-align: right;font-weight: bold;">PPN <?= $data["tax_percent"] ?>%</td>
							<td class="total-value" style="text-align: right;font-weight: bold;"><?= number_format($data["tax"]) ?></td>
						</tr>
						<tr>
							<td colspan="11" class="total-line" style="text-align: right;font-weight: bold;border-bottom: 1px solid black;">Total</td>
							<td class="total-value" style="text-align: right;font-weight: bold;border-bottom: 1px solid black;"><?= number_format($data["total"]) ?></td>
						</tr>
						<tr class="item-row">
							<td colspan="12" style="text-align:left;font-weight: bold;font-style: italic;font-size: 17px;">The Sum Of :  &nbsp;&nbsp;"<?= terbilang($data["total"]) ?>"</td>
						</tr>
						<tr>
                            <td colspan="12" style="padding:0">
                                <table style="width: 360px;margin-bottom: 10px;margin-left: 10px;">
        							<tr>
        								<td colspan="2"style="text-align:left;font-size: 13px;border: none;">
        									<i><b>Please remit to our account of :</b></i><br>
        								</td>
        							</tr>
        							<tr>
        								<td class="p-0">Acc. Name</td>
        								<td class="p-0">: <?= empty($data) ? "" : $rekening['nama_rekening']?></td>
        							</tr>
        							<tr>
        								<td class="p-0">Acc Number</td>
        								<td class="p-0">: <?= empty($data) ? "" : $rekening['rekening']?></td>
        							</tr>
        							<tr>
        								<td class="p-0">Name of Bank</td>
        								<td class="p-0">: <?= empty($data) ? "" : $rekening['bank']?> </td>
        							</tr>
        						</table>
                            </td>
                        </tr>
					</table>
				</div>
				<table style="margin-bottom: 0;width: 100%">
					<tr>
						<td width="70%" class="no-border">
						</td>
						<td width="30%" style="border:none;padding-top: 30px;">
							<p style="margin-bottom: 0">BEKASI, <?= tgl_indo($data['tgl_invoice']) ?></p>
							<p style="font-weight: bold;">PT. WAHANA MULTI LOGISTIK</p>
							<br>
							<br>
							<br>
							<br>
							<br>
							<br>
							<p style="font-weight: bold;">Agus Setiawan, SE, MMTr</p>
						</td>
					</tr>
				</table>
				<div style="break-after:page"></div>
				<div style="clear: both;"></div>
				<div class="row">
					<table class="table" style="margin-bottom: 0;">
						<tr>
							<td style="border:none">
								<img src="<?= base_url(); ?>assets\images\cropped-logo-wml-180x180.png" style="height: 80px;width: 80px;" class="">
							</td>
							<td style="border:none">
								<h1 style="color: #1616a0;">PT.Wahana Multi Logistik</h1>
								<h4 style="font-size: 18px;color: #1616a0;">Head Office:<br>
								JL.Kemang Raya No.52 Jati Cempaka, Pondok Gede - Bekasi 17411<br>
								Telp: 021-8499 8777, Fax : 021-8497 4046
								</h4>
							</td>
						</tr>
					</table>
					<hr>
					<hr>
					<h1 style="text-align: center;width: 100%;font-size: 24px;font-weight: bold;margin-top: 10px;text-decoration: underline;">OFFICIAL RECEIPT</h1>
					<h1 style="text-align: center;width: 100%;font-size: 16px;font-weight: bold;margin-top: 10px;">Invoice No.: <?= empty($data) ? "" : $data['no_invoice']?>
					</h1>
					<table style="width: 100%">
						<tr>
							<td class="no-border" style="font-weight: 400;width: 200px;font-style: italic;font-size: 16px;">Received from</td>
							<td class="no-border" style="font-weight: bold;font-size: 16px;">
								: <?= empty($data) ? "" : explode(PHP_EOL, $data['alamat_penagihan'])[0] ?>
							</td>
						</tr>
						<tr>
							<td class="no-border" style="font-weight: 400;width: 200px;font-style: italic;font-size: 16px;">The Sum Of</td>
							<td class="no-border" style="font-weight: bold;font-size: 16px;">
								<div style="display: inline;position: absolute;padding-top: 16px;">:</div>
								<div class="jajargenjang">
									<p style="transform: skew(20deg);padding-top: 10px;padding-left: 12px;"><?= strtoupper(terbilang($data["total"])) ?></p>
								</div>

							</td>
						</tr>
						<tr>
							<td class="no-border" style="font-weight: 400;width: 200px;font-style: italic;font-size: 16px;vertical-align: top;padding-top: 10px;">Being payment of</td>
							<td class="no-border" style="font-weight: bold;font-size: 16px;">
								<table style="margin-bottom: 0; width: 100%;">
									<tr class="item-row">
										<td class="item-name no-border">: <?= empty($data) ? "" : $data['remark']?></td>
										<td style="text-align: right;width: 200px;" class="no-border">Rp <?= number_format($data["subtotal"] ) ?></td>					
									</tr>
									<?php 
				                    $urut=1;
				                    foreach($data_biaya as $row): ?>
									<tr class="item-row">
										<td class="item-name no-border"><?= $row["aktifitas"] ?></td>
										<td style="text-align: right;" class="no-border"><?= number_format($row["biaya"]) ?></td>					
									</tr>
									<?php $urut++?>
									<?php endforeach; ?>
									<tr>
										<td class="item-name no-border" style="text-align: right;font-weight: 400;">Subtotal</td>
										<td style="text-align: right;width: 200px;text-decoration: overline;" class="no-border">Rp <?= number_format($data["subtotal"] + $data["cost"]) ?>
										</td>
									</tr>
									<tr>
										<td class="item-name no-border" style="text-align: right;font-weight: 400;">PPN 1.1%</td>
										<td style="text-align: right;width: 200px;" class="no-border">Rp <?= number_format($data["tax"]) ?>
										</td>
									</tr>
									<tr>
										<td class="item-name no-border" style="text-align: right;">Grand Total</td>
										<td style="text-align: right;width: 200px;text-decoration: overline;" class="no-border">Rp <?= number_format($data["total"]) ?>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td class="no-border" style="font-weight: 400;width: 200px;font-style: italic;font-size: 16px;">Amount</td>
							<td class="no-border" style="font-weight: bold;font-size: 16px;">
								: Rp <?= number_format($data["total"]) ?>
							</td>
						</tr>
					</table>
					<table style="margin-bottom: 0;width: 100%">
						<tr>
							<td width="70%" class="no-border">
							</td>
							<td width="30%" style="border:none;padding-top: 30px;">
								<p style="margin-bottom: 0">BEKASI, <?= tgl_indo($data['tgl_invoice']) ?></p>
								<p style="font-weight: bold;">PT. WAHANA MULTI LOGISTIK</p>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<p style="font-weight: bold;">Agus Setiawan, SE, MMTr</p>
							</td>
						</tr>
					</table>
				</div>
			<? } elseif($page == "invoiceti"){ ?>
				<div class="row">
					<table class="table" style="margin-bottom: 0;">
						<tr>
							<td style="border:none">
								<img src="<?= base_url(); ?>assets\images\cropped-logo-wml-180x180.png" style="height: 80px;width: 80px;" class="">
							</td>
							<td style="border:none">
								<h1 style="color: #1616a0;margin-bottom: 0;">PT.Wahana Multi Logistik</h1>
								<h1 style="font-size: 28px;color: red;">Domestic & International Freight Forwarder</h1>
							</td>
							<td style="border:none">
								<img src="<?= base_url(); ?>assets\images\iso 9001.png" style="height: 80px;width: 120px;">
								<p style="margin-bottom: 0;font-weight: bold;">Cert no : SMM-0084-18</p>
							</td>
						</tr>
					</table>
				</div>
				<hr>
				<div class="row">
					<table style="width: 100%">
						<tr>
							<td class="no-border" style="width: 70%">
								
							</td>
							<td class="no-border" style="padding: 10px;">
								<b>PT. WAHANA MULTI LOGISTIK</b><br>
								JL.Kemang Raya No.52 Jati Cempaka, Pondok Gede - Bekasi 17411<br>
								Telp: 021-8499 8777
							</td>
						</tr>
					</table>
					
				</div>
				<div>
					<h1 class="header-inv" style="background-color: #1616a0;margin-bottom: 0;">INVOICE</h1>
					<div style="padding: 10px;padding-left: 0;padding-right: 0;">
						<table style="width: 100%">
							<tr>
								<td style="font-weight: bold;">
									Kepada Yth : <br>
									<?= empty($data) ? "" : nl2br($data['alamat_penagihan']) ?>
								</td>
								<td class="no-border" style="vertical-align: top;padding: 0;">
									<table id="meta" style="border: solid 1px;width: auto;" >
										<tr>
											<td class="no-border">No Invoice</td>
											<td class="no-border" style="width: 10px">:</td>
											<td class="no-border"><?= empty($data) ? "" : $data['no_invoice']?></td>
										</tr>
										<tr>
											<td class="no-border">Tanggal</td>
											<td class="no-border" style="width: 10px">:</td>
											<td class="no-border"><?= empty($data) ? "" : tgl_indo($data['tgl_invoice'])?></td>
										</tr>
										<tr>
											<td class="no-border">SP No.</td>
											<td class="no-border" style="width: 10px">:</td>
											<td class="no-border"><?= empty($data) ? "" : $data['sp_no']?></td>
										</tr>
										<tr>
											<td class="no-border">Tanggal</td>
											<td class="no-border" style="width: 10px">:</td>
											<td class="no-border"><?= empty($data) ? "" : tgl_indo($spk['tgl_spk'])?></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</div>
					<table style="margin-bottom: 0; width: 100%;">

						<tr>
							<th>No</th>
							<th>Keterangan</th>
							<th>Satuan</th>
							<th>Vol</th>
							<th>Harga Satuan</th>
							<th style="text-align: right;">Total</th>
						</tr>

						<?php 
	                    $urut=1;
	                    foreach($data_detail as $row): ?>
						<tr class="item-row">
							<td><?=$urut?></td>
							<td class="item-name"><?= $row["keterangan"] ?></td>
							<td class="item-name"><?= $row["satuan"] ?></td>
							<td class="item-name"><?= $row["kg"] ?></td>
							<td style="text-align: right;"><?= ($row["kg"]>0 ? number_format($row["price"]) : number_format($row["price_chartered"])) ?></td>
							<td style="text-align: right;"><?= number_format($row["subtotal"]) ?></td>						
						</tr>
						<?php $urut++?>
	                    <?php endforeach; ?>
	                    
						<tr>
							<td colspan="5" class="total-line" style="text-align: right;font-weight: bold;">SubTotal</td>
							<td class="total-value" style="text-align: right;font-weight: bold;"><?= number_format($data["cost"] + $data["subtotal"]) ?></td>
						</tr>
						<tr>
							<td colspan="5" class="total-line" style="text-align: right;font-weight: bold;">PPN <?= $data["tax_percent"] ?>%</td>
							<td class="total-value" style="text-align: right;font-weight: bold;"><?= number_format($data["tax"]) ?></td>
						</tr>
						<tr>
							<td colspan="5" class="total-line" style="text-align: right;font-weight: bold;border-bottom: 1px solid black;">Total</td>
							<td class="total-value" style="text-align: right;font-weight: bold;border-bottom: 1px solid black;"><?= number_format($data["total"]) ?></td>
						</tr>
						
					</table>
					<div style="margin-top: 10px;">
						<table style="border:solid 1px;width: 350px;margin-bottom: 10px;margin-left: 0px;">
							
							<tr>
								<td class="p-10" style="border:none;">Nama Rekening</td>
								<td class="p-10" style="border:none;">: <?= empty($data) ? "" : $rekening['nama_rekening']?></td>
							</tr>
							<tr>
								<td class="p-10" style="border:none;">No Rekening</td>
								<td class="p-10" style="border:none;">: <?= empty($data) ? "" : $rekening['rekening']?></td>
							</tr>
							<tr>
								<td class="p-10" style="border:none;">Nama Bank</td>
								<td class="p-10" style="border:none;">: <?= empty($data) ? "" : $rekening['bank']?> </td>
							</tr>
						</table>
					</div>
				</div>
				<table style="margin-bottom: 0;width: 100%">
					<tr>
						<td width="70%" class="no-border">
						</td>
						<td width="30%" style="border:none;padding-top: 30px;">
							<p style="margin-bottom: 0">BEKASI, <?= tgl_indo($data['tgl_invoice']) ?></p>
							<p style="font-weight: bold;">PT. WAHANA MULTI LOGISTIK</p>
							<br>
							<br>
							<br>
							<br>
							<br>
							<br>
							<p style="font-weight: bold;">Agus Setiawan, SE, MMTr</p>
						</td>
					</tr>
				</table>
				<div style="break-after:page"></div>
				<div style="clear: both;"></div>
				<div class="row">
					<table class="table" style="margin-bottom: 0;">
						<tr>
							<td style="border:none">
								<img src="<?= base_url(); ?>assets\images\cropped-logo-wml-180x180.png" style="height: 80px;width: 80px;" class="">
							</td>
							<td style="border:none">
								<h1 style="color: #1616a0;">PT.Wahana Multi Logistik</h1>
								<h4 style="font-size: 18px;color: #1616a0;">Head Office:<br>
								JL.Kemang Raya No.52 Jati Cempaka, Pondok Gede - Bekasi 17411<br>
								Telp: 021-8499 8777, Fax : 021-8497 4046
								</h4>
							</td>
						</tr>
					</table>
					<hr>
					<hr>
					<h1 style="text-align: center;width: 100%;font-size: 24px;font-weight: bold;margin-top: 10px;text-decoration: underline;">OFFICIAL RECEIPT</h1>
					<h1 style="text-align: center;width: 100%;font-size: 16px;font-weight: bold;margin-top: 10px;">Invoice No.: <?= empty($data) ? "" : $data['no_invoice']?>
					</h1>
					<table style="width: 100%">
						<tr>
							<td class="no-border" style="font-weight: 400;width: 200px;font-style: italic;font-size: 16px;">Received from</td>
							<td class="no-border" style="font-weight: bold;font-size: 16px;">
								: <?= empty($data) ? "" : explode(PHP_EOL, $data['penagihan_to'])[0] ?>
							</td>
						</tr>
						<tr>
							<td class="no-border" style="font-weight: 400;width: 200px;font-style: italic;font-size: 16px;">The Sum Of</td>
							<td class="no-border" style="font-weight: bold;font-size: 16px;">
								<div style="display: inline;position: absolute;padding-top: 16px;">:</div>
								<div class="jajargenjang">
									<p style="transform: skew(20deg);padding-top: 10px;padding-left: 12px;"><?= strtoupper(terbilang($data["total"])) ?></p>
								</div>

							</td>
						</tr>
						<tr>
							<td class="no-border" style="font-weight: 400;width: 200px;font-style: italic;font-size: 16px;vertical-align: top;padding-top: 10px;">Being payment of</td>
							<td class="no-border" style="font-weight: bold;font-size: 16px;">
								<table style="margin-bottom: 0; width: 100%;">
									<tr class="item-row">
										<td class="item-name no-border">: <?= empty($data) ? "" : $data['remark']?></td>
										<td style="text-align: right;width: 200px;" class="no-border">Rp <?= number_format($data["subtotal"] ) ?></td>					
									</tr>
									<?php 
				                    $urut=1;
				                    foreach($data_biaya as $row): ?>
									<tr class="item-row">
										<td class="item-name no-border"><?= $row["aktifitas"] ?></td>
										<td style="text-align: right;" class="no-border"><?= number_format($row["biaya"]) ?></td>					
									</tr>
									<?php $urut++?>
									<?php endforeach; ?>
									<tr>
										<td class="item-name no-border" style="text-align: right;font-weight: 400;">Subtotal</td>
										<td style="text-align: right;width: 200px;text-decoration: overline;" class="no-border">Rp <?= number_format($data["subtotal"] + $data["cost"]) ?>
										</td>
									</tr>
									<tr>
										<td class="item-name no-border" style="text-align: right;font-weight: 400;">PPN 1.1%</td>
										<td style="text-align: right;width: 200px;" class="no-border">Rp <?= number_format($data["tax"]) ?>
										</td>
									</tr>
									<tr>
										<td class="item-name no-border" style="text-align: right;">Grand Total</td>
										<td style="text-align: right;width: 200px;text-decoration: overline;" class="no-border">Rp <?= number_format($data["total"]) ?>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td class="no-border" style="font-weight: 400;width: 200px;font-style: italic;font-size: 16px;">Amount</td>
							<td class="no-border" style="font-weight: bold;font-size: 16px;">
								: Rp <?= number_format($data["total"]) ?>
							</td>
						</tr>
					</table>
					<table style="margin-bottom: 0;width: 100%">
						<tr>
							<td width="70%" class="no-border">
							</td>
							<td width="30%" style="border:none;padding-top: 30px;">
								<p style="margin-bottom: 0">BEKASI, <?= tgl_indo($data['tgl_invoice']) ?></p>
								<p style="font-weight: bold;">PT. WAHANA MULTI LOGISTIK</p>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<p style="font-weight: bold;">Agus Setiawan, SE, MMTr</p>
							</td>
						</tr>
					</table>
				</div>
			<? } elseif ($page == "payment") { ?>
				<div class="row">
					<table class="table" style="margin-bottom: 0;">
						<tr>
							<td style="border:none">
								<img src="<?= base_url(); ?>assets\images\cropped-logo-wml-180x180.png" style="height: 80px;width: 80px;" class="">
							</td>
							<td style="border:none">
								<h1 style="color: #1616a0;">PT.Wahana Multi Logistik</h1>
								<h4 style="font-size: 18px;color: #1616a0;">Head Office:<br>
								JL.Kemang Raya No.52 Jati Cempaka, Pondok Gede - Bekasi 17411<br>
								Telp: 021-8499 8777, Fax : 021-8497 4046
								</h4>
							</td>
						</tr>
					</table>
					<hr>
					<hr>
					<h1 style="text-align: center;width: 100%;font-size: 24px;font-weight: bold;margin-top: 10px;text-decoration: underline;">OFFICIAL RECEIPT</h1>
					<h1 style="text-align: center;width: 100%;font-size: 16px;font-weight: bold;margin-top: 10px;">Invoice No.: <?= empty($data) ? "" : $data['no_invoice']?>
					</h1>
					<table style="width: 100%">
						<tr>
							<td class="no-border" style="font-weight: 400;width: 200px;font-style: italic;font-size: 16px;">Received from</td>
							<td class="no-border" style="font-weight: bold;font-size: 16px;">
								: PT. Telkom Akses
							</td>
						</tr>
						<tr>
							<td class="no-border" style="font-weight: 400;width: 200px;font-style: italic;font-size: 16px;">The Sum Of</td>
							<td class="no-border" style="font-weight: bold;font-size: 16px;">
								<div style="display: inline;position: absolute;padding-top: 16px;">:</div>
								<div class="jajargenjang">
									<p style="transform: skew(20deg);padding-top: 10px;padding-left: 12px;"><?= strtoupper(terbilang($data["total_payment"])) ?></p>
								</div>

							</td>
						</tr>
						<tr>
							<td class="no-border" style="font-weight: 400;width: 200px;font-style: italic;font-size: 16px;vertical-align: top;padding-top: 10px;">Being payment of</td>
							<td class="no-border" style="font-weight: bold;font-size: 16px;">
								<table style="margin-bottom: 0; width: 100%;">
									<tr class="item-row">
										<td class="item-name no-border">: <?= empty($data) ? "Pembayaran Tagihan Invoice" : ($data['remark'] == "" ? "Pembayaran Tagihan Invoice" : $data['remark']) ?></td>
															
									</tr>
									
								</table>
							</td>
						</tr>
						<tr>
							<td class="no-border" style="font-weight: 400;width: 200px;font-style: italic;font-size: 16px;">Amount</td>
							<td class="no-border" style="font-weight: bold;font-size: 16px;">
								: Rp <?= number_format($data["total_payment"]) ?>
							</td>
						</tr>
					</table>
					<table style="margin-bottom: 0;width: 100%">
						<tr>
							<td width="70%" class="no-border">
							</td>
							<td width="30%" style="border:none;padding-top: 30px;">
								<p style="margin-bottom: 0">BEKASI, <?= tgl_indo(date('Y-m-d')) ?></p>
								<p style="font-weight: bold;">PT. WAHANA MULTI LOGISTIK</p>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								<p style="font-weight: bold;">Agus Setiawan, SE, MMTr</p>
							</td>
						</tr>
					</table>
				</div>			
			<? } elseif ($page == "routing") { ?>
				<div class="row">
					<table class="table" style="margin-bottom:10px;margin-top: 10px;">
						<tr>
							<td width="20%" height="100px;">
								ROUTING SLIP<br><br>
								<?= empty($data) ? "" : $data['no_routing'] ?>
							</td>
							<td style="border: none" width="50%">
								
							</td>
							<td width="30%">
								PROJECT NAME<br><br>
								<?= empty($data) ? "" : $data['nama_project'] ?>
							</td>
						</tr>
					</table>

					<h1 style="text-align: center;width: 100%;font-size: 24px;font-weight: bold;margin-top: 10px;margin-bottom: 20px;">ROUTING SLIP ORDER PT. WAHANA MULTI LOGISTIK</h1>
					</h1>
					<table style="width: 100%">
						<tr>
							<td width="50%" class="no-border" style="vertical-align: top;">
								<table style="width: 100%">
									<tr>
										<td style="font-weight: bold">TANGGAL DO</td>
										<td colspan="3"><?= empty($data) ? "" : tgl_indo(date("Y-m-d", strtotime($data['tgl_spk']))) ?></td>
										
									</tr>
									<tr>
										<td style="font-weight: bold">NOMOR DO</td>
										<td colspan="3"><?= empty($data) ? "" : $data['spk_no'] ?></td>
									</tr>
									<tr>
										<td style="font-weight: bold">COMBINE/MULTI</td>
										<td colspan="3">
											<?php 
												$urut=1;
		                                      foreach($multi as $row)
		                                      {
		                                      	echo $urut . ". " .$row->rute ."<br>";
		                                      	$urut++;
		                                      }
		                                    ?>
										</td>
									</tr>
									<tr>
										<td rowspan="2" style="font-weight: bold">JENIS PENGIRIMAN</td>
										<td style="font-weight: bold">DARAT</td>
										<td style="font-weight: bold">LAUT</td>
										<td style="font-weight: bold">UDARA</td>
									</tr>
									<tr>
										<td><?= empty($moda) ? "" : ($moda['moda_name'] == "DARAT" ? $data['moda_name'] : "") ?></td>
										<td><?= empty($moda) ? "" : ($moda['moda_name'] == "LAUT" ? $data['moda_name'] : "") ?></td>
										<td><?= empty($moda) ? "" : ($moda['moda_name'] == "UDARA" ? $data['moda_name'] : "") ?></td>
									</tr>
									<tr>
										<td colspan="4" class="no-border"></td>
									</tr>
									<tr>
										<td style="font-weight: bold">VENDOR NAME</td>
										<td colspan="3"><?= empty($data) ? "" : $data['agent'] ?></td>
									</tr>
									<tr>
										<td style="font-weight: bold">NO HP</td>
										<td colspan="3"><?= empty($data) ? "" : $data['agent_hp'] ?></td>
									</tr>
									<tr>
										<td style="font-weight: bold">JENIS ARMADA</td>
										<td colspan="3"><?= empty($data) ? "" : $data['armada'] ?></td>
									</tr>
								</table>
							</td>
							<td width="50%" class="no-border" style="vertical-align: top;">
								<table style="width: 100%;">
									<tr>
										<td  width="50%" style="font-weight: bold">PICKUP ADDRESS</td>
										<td  width="50%" style="font-weight: bold">DESTINATION</td>
									</tr>
									<tr>
										<td>
											<?= empty($data) ? "" : $data['nama_pengirim'] ?>
										</td>
										<td>
											<?= empty($data) ? "" : $data['nama_penerima'] ?>
										</td>
									</tr>
									<tr>
										<td colspan="2" class="no-border"></td>
									</tr>
									<tr>
										<td style="font-weight: bold">NO. TRUCKING</td>
										<td><?= empty($data) ? "" : $data['no_kendaraan'] ?></td>
									</tr>
									<tr>
										<td style="font-weight: bold">NO. CONTAINER / SHIPPING NAME</td>
										<td><?= empty($data) ? "" : $data['no_container'] ?></td>
									</tr>
									<tr>
										<td style="font-weight: bold">NO. SMU / AIRLINES</td>
										<td><?= empty($data) ? "" : (empty($data['no_pelayaran']) ? $data['flight_no']  : $data['no_pelayaran'])?></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2" class="no-border"></td>
						</tr>
						<tr>
							<td colspan="2" style="min-height: 100px;">
								<?php 
									$urut=1;
                                  	foreach($data_detail as $row)
                                  	{
                                  		echo $urut . ". " . $row['nama_barang'] ." " . $row['qty'] ." ". $row['satuan'] ."<br>";
                                  		$urut++;
                                  	}
                                ?>
							</td>
						</tr>
						<tr>
							<td class="no-border" style="font-weight: bold;">PAYMENT</td>
							<td class="no-border" style="font-weight: bold;">INVOICE</td>
						</tr>
						<tr>
							<td style="height: 100px;">
								<?php 
									$urut=1;
                                  	foreach($data_biaya as $row)
                                  	{
                                  		echo $urut . ". " . $row['aktifitas'] ." / Rp. " . number_format($row['biaya']) ."<br>";
                                  		$urut++;
                                  	}
                                ?>
							</td>
							<td style="height: 100px;"></td>
						</tr>
					</table>
					
				</div>
			<? } elseif ($page == "routing_new") { ?>
				<div class="row" style="padding: 10px;">
					<table class="table" style="margin-bottom:10px;margin-top: 10px;">
						<tr>
							<td width="50%" height="100px;" class="no-border">
								<table style="width: 100%">
									<tr>
										<td style="font-weight: bold;width: 70%" class="no-border">
											<div style="border: solid 1px grey;padding: 10px;">Reff: <?= empty($data) ? "" : $data['no_routing'] ?></div>
										</td>
										<td class="no-border" width="30%">
											<img src="<?= base_url(); ?>assets\images\cropped-logo-wml-180x180.png" style="height: 80px;width: 80px;" class="">
										</td>
									</tr>
									<tr>
										<td colspan="2" class="no-border">
											<h1 style="text-align: right;width: 100%;font-size: 16px;font-weight: bold;margin-top: 10px;margin-bottom: 20px;">ROUTING SLIP WAHANA - TELKOM IND</h1>
										</td>
									</tr>
								</table>
							</td>
							<td width="50%" class="no-border">
								<table style="width: 100%">
									<tr>
										<td style="font-weight: bold;width: 40%;font-size: 25px;" class="no-border">
											PROJECT
										</td>
										<td class="no-border" width="1%" style="padding: 20px 5px;">:</td>
										<td class="no-border" width="49%" style="font-size: 25px;color: red;font-weight: bold;">
											TELKOM IND
										</td>
									</tr>
									<tr>
										<td style="font-weight: bold;width: 40%;" class="no-border">
											Pickup Address	
										</td>
										<td class="no-border" width="1%" style="padding: 10px 5px;">:</td>
										<td class="no-border" width="49%" >
											<div style="border: solid 1px grey;padding: 10px;font-size: 12px;"><?= empty($data) ? "" : $data['nama_pengirim'] ?></div>
										</td>
									</tr>
									<tr>
										<td style="font-weight: bold;width: 40%;" class="no-border">
											Destination	
										</td>
										<td class="no-border" width="1%" style="padding: 10px 5px;">:</td>
										<td class="no-border" width="49%" >
											<div style="border: solid 1px grey;padding: 10px;font-size: 12px;"><?= empty($data) ? "" : $data['nama_penerima'] ?></div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>

					
					</h1>
					<table style="width: 100%">
						<tr>
							<td style="font-weight: bold" class="no-border">TGL TERIMA ORDER BY EMAIL</td>
							<td class="no-border" width="20px;">:</td>
							<td class="border-dotted"><?= empty($data) ? "" : tgl_indo(date("Y-m-d", strtotime($data['CreatedDate']))) ?></td>
						</tr>
						<tr>
							<td style="font-weight: bold" class="no-border">COMBINE/MULTI</td>
							<td class="no-border" width="20px;">:</td>
							<td class="border-dotted">
								<?php 
									$urut=1;
                                  foreach($multi as $row)
                                  {
                                  	echo $urut . ". " .$row->rute ."<br>";
                                  	$urut++;
                                  }
                                ?>
							</td>
						</tr>
						<tr>
							<td style="font-weight: bold" class="no-border" width="250px;">CARRIER / VEHICLE NO.</td>
							<td class="no-border" width="20px;">:</td>
							<td class="border-dotted"><?= empty($data) ? "" : $data['no_kendaraan'] ?></td>
						</tr>
						<tr>
							<td style="font-weight: bold" class="no-border">TANGGAL PICKUP</td>
							<td class="no-border" width="20px;">:</td>
							<td class="border-dotted"><?= empty($data) ? "" : tgl_indo(date("Y-m-d", strtotime($data['pickup_date']))) ?></td>
						</tr>
						<tr>
							<td style="font-weight: bold" class="no-border">ALAMAT PICKUP</td>
							<td class="no-border" width="20px;">:</td>
							<td class="border-dotted"><?= empty($data) ? "" : $data['pickup_address'] ?></td>
						</tr>
						<tr>
							<td style="font-weight: bold" class="no-border">VENDOR NAME</td>
							<td class="no-border" width="20px;">:</td>
							<td class="border-dotted"><?= empty($data) ? "" : $data['agent'] ?></td>
						</tr>
						<tr>
							<td style="font-weight: bold" class="no-border">NAMA BARANG</td>
							<td class="no-border" width="20px;">:</td>
							<td class="border-dotted">
								<?php 
									$urut=1;
                                  	foreach($data_detail as $row)
                                  	{
                                  		echo $urut . ". " . $row['nama_barang'] ."<br>";
                                  		$urut++;
                                  	}
                                ?>
							</td>
						</tr>
						<tr>
							<td style="font-weight: bold" class="no-border">JUMLAH BARANG</td>
							<td class="no-border" width="20px;">:</td>
							<td class="border-dotted">
								<?php 
									$urut=1;
                                  	foreach($data_detail as $row)
                                  	{
                                  		echo $urut . ". " . $row['qty'] ." ". $row['satuan'] ."<br>";
                                  		$urut++;
                                  	}
                                ?>
							</td>
						</tr>
						<tr>
							<td colspan="3" style="padding: 20px;" class="no-border"></td>
						</tr>
						
					</table>
					<table style="width: 100%">
						<tr>
							<td width="100px;" class="no-border"></td>
							<td style="font-weight: bold" width="100px">NO. SPK</td>
							<td style="text-align: center;"><?= empty($data) ? "" : $data['spk_no'] ?></td>
							<td width="100px;" class="no-border"></td>
						</tr>

						<tr>
							<td colspan="3" style="padding: 30px;" class="no-border"></td>
						</tr>

					</table>
					<table style="width: 100%">
						<tr>
							<td style="text-align: center;font-weight: bold;">DELIVERY</td>
						</tr>
						<tr>
							<td>
								<table style="width: 100%">
									<tr>
										<td style="font-weight: bold;width: 250px;" class="no-border">TANGGAL PENGIRIMAN</td>
										<td class="no-border" width="20px;">:</td>
										<td class="border-dotted"><?= empty($data) ? "" : tgl_indo(date("Y-m-d", strtotime($data['CreatedDate']))) ?></td>
									</tr>
									<tr>
										<td style="font-weight: bold;width: 250px;" class="no-border">ALAMAT PENERIMA</td>
										<td class="no-border" width="20px;">:</td>
										<td class="border-dotted"><?= empty($data) ? "" : $data['alamat_penerima'] ?></td>
									</tr>
									<tr>
										<td style="font-weight: bold;width: 250px;" class="no-border">TGL & NAMA PENERIMA BARANG</td>
										<td class="no-border" width="20px;">:</td>
										<td class="border-dotted"><?= empty($data) ? "" : ( $data['received_date'] == '' ? '' : tgl_indo(date("Y-m-d", strtotime($data['received_date'])))) . ' / '. $data['received_by'] ?></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>

					<table style="width: 100%;margin-top: 30px;">
						<tr>
							<td style="text-align: center;font-weight: bold;">DOKUMEN KEMBALI</td>
						</tr>
						<tr>
							<td>
								<table style="width: 100%">
									<tr>
										<td style="font-weight: bold;width: 250px;" class="no-border">TANGGAL TERIMA DOKUMEN</td>
										<td class="no-border" width="20px;">:</td>
										<td class="border-dotted"><?= empty($data) ? "" : ( $data['received_doc'] == '' ? '' : tgl_indo(date("Y-m-d", strtotime($data['received_doc'])))) . $data['received_doc'] ?></td>
									</tr>
									<tr>
										<td style="font-weight: bold;width: 250px;" class="no-border">DIPERIKSA OLEH</td>
										<td class="no-border" width="20px;">:</td>
										<td class="border-dotted"></td>
									</tr>
									<tr>
										<td style="font-weight: bold;width: 250px;" class="no-border">TGL. DISERAHKAN KE ACC</td>
										<td class="no-border" width="20px;">:</td>
										<td class="border-dotted"><?= empty($data) ? "" : ( $data['sent_acc'] == '' ? '' : tgl_indo(date("Y-m-d", strtotime($data['sent_acc'])))) . $data['sent_acc'] ?></td>
									</tr>

								</table>
							</td>
						</tr>
					</table>

					<table style="width: 100%">
						<tr>
							<td colspan="3" style="padding: 10px;" class="no-border"></td>
						</tr>
						<tr>
							<td style="font-weight: bold;width: 150px;" class="no-border">REMARK</td>
							<td class="no-border" width="20px;">:</td>
							<td class="border-dotted"></td>
						</tr>
						<tr>
							<td style="font-weight: bold;width: 150px;" class="no-border"></td>
							<td class="no-border" width="20px;">&nbsp;</td>
							<td class="border-dotted"></td>
						</tr>
						<tr>
							<td style="font-weight: bold;width: 150px;" class="no-border"></td>
							<td class="no-border" width="20px;">&nbsp;</td>
							<td class="border-dotted"></td>
						</tr>
						<tr>
							<td style="font-weight: bold;width: 150px;" class="no-border"></td>
							<td class="no-border" width="20px;">&nbsp;</td>
							<td class="border-dotted"></td>
						</tr>
						<tr>
							<td style="font-weight: bold;width: 150px;" class="no-border"></td>
							<td class="no-border" width="20px;">&nbsp;</td>
							<td class="border-dotted"></td>
						</tr>
						<tr>
							<td colspan="3" style="padding: 10px;" class="no-border">
								
							</td>
						</tr>
					</table>
					<table style="width: 100%;text-align: center;">
						<tr>
							<td>Prepare By</td>
							<td>Ori docs Prepare by</td>
							<td>Inv Prepare By</td>
							<td>Inv Submitr Date</td>
						</tr>
						<tr>
							<td>
								<br>
								<br>
								<br>
							</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						
					</table>
				</div>
			<? } elseif ($page == "sj") { ?>
				<style type="text/css">
					#page-wrap {
					    width: 1000px;
					}

				</style>
				<div class="row">
					<table style="width: 100%; margin-bottom: 10px">
						<tr>
							<td style="padding: 10px;border-bottom: none;padding-bottom: 0">
								<table class="table" style="margin-bottom:10px;margin-top: 10px;">
									<tr>
										<td width="35%" style="border-right: none;">
											<div style="font-weight: bold;font-size: 18px;border: solid 1px #000;padding: 10px;">
												Nomor Surat Jalan / Delivery Order (DO) : <?= empty($data) ? "" : $data['no_routing'] ?>
											</div> 
										</td>
										<td width="65%" style="text-align: right;border-left: none;font-weight: bold;">
											PT WAHANA MULTI LOGISTIK<br>
											Graha Setiawan - Jl Kemang Raya No. 52 Jati Cempaka, Pondok Gede - Bekasi 17411<br>
											Phone:02184998777 | Fax: 02184994046 | Email: herwinda_winda@wahanamulti.com | Website: www.wmlogistics.co.id
										</td>
									</tr>
									<tr>
										<td colspan="2" style="padding: 0">
											<table style="width: 100%">
												<tr>
													<td width="15%" >
														<img src="<?= base_url(); ?>assets\images\cropped-logo-wml-180x180.png" style="height: 120px;width: 150px;border: solid 1px;padding: 10px;">
													</td>
													<td width="85%" style="padding: 0">
														<table style="width: 100%">
															<tr>
																<td style="padding: 5px">
																	<h1 style="text-align: center;font-size: 24px;font-weight: bold;">SURAT JALAN / DELIVERY ORDER (DO)</h1>
																</td>
															</tr>
															<tr>
																<td class="no-border" style="padding: 0;">
																	<table style="width: 100%">
																		<tr>
																			<td style="border-left: none;border-bottom: none;border-top: none;">Penerima, Kepada Yth: <br>
																				<div style="font-weight: bold;font-size: 20px;">
																					<?= empty($data) ? "" : $data['nama_penerima'] ?>
																					<br>
																				</div>
																				<div style="font-weight: bold;font-size: 14px;">
																					<?= empty($data) ? "" : $data['alamat_penerima'] ?>	
																					<br>
																					<?= empty($data) ? "" : "PIC: ". $data['attn_penerima'] ?> 
																					<?= empty($data['hp_penerima']) ? "" : "/ ". $data['hp_penerima'] ?>
																				</div>
																			</td>
																			<td class="no-border" style="padding: 0">
																				<table style="width: 100%">
																					<tr>
																						<td style="text-align: center;padding: 5px;font-weight: bold;">Tanggal</td>
																					</tr>
																					<tr>
																						<td style="padding: 0" class="no-border">
																							<table style="width: 100%">
																								<tr>
																									<td style="text-align: center;" class="no-border">
																										<?= empty($data) ? "" : tgl_indo(date("Y-m-d", strtotime($data['tgl_spk']))) ?>
																									</td>
																								</tr>
																							</table>
																						</td>
																					</tr>
																				</table>
																			</td>
																		</tr>
																	</table>
																</td>
															</tr>
														</table>
													</td>
												</tr>
												<tr>
													<td colspan="2">
														<table style="width: 100%">
															<tr>
																<td style="width: 15%; height: 70px;font-weight: bold;">
																	Nota Pengadaan<br>
																	<div style="font-weight: bold;font-size: 16px;">
																		<?= empty($data) ? "" : $data['spk_no'] ?>
																		<br>
																		
																	</div>
																</td>
																<td style="width: 55%">Pengirim: <br>
																	<div style="font-weight: bold;font-size: 20px;">
																		<?= empty($data) ? "" : $data['nama_pengirim'] ?>
																		<br>
																		
																	</div>
																	<div style="font-weight: bold;font-size: 14px;">
																		<?= empty($data) ? "" : $data['alamat_pengirim'] ?>
																		<br>
																		<?= empty($data) ? "" : "PIC: ". $data['attn_pengirim'] ?>
																		<?= empty($data['hp_pengirim']) ? "" : "/ ". $data['hp_pengirim'] ?>
																	</div>
																</td>
																<td style="width: 30%;padding: 0">
																	<table width="100%" style="padding: 0">
																		<tr>
																			<td>Nopol Kendaraan: <?= empty($data) ? "" : $data['no_kendaraan'] ?></td>
																		</tr>
																		<tr>
																			<td>Nama Supir: <?= empty($data) ? "" : $data['driver'] ?></td>
																		</tr>
																		<tr>
																			<td>No Hp Supir: <?= empty($data) ? "" : $data['agent_hp'] ?></td>
																		</tr>
																	</table>
																
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
										
									</tr>
								</table>
								<table style="width: 100%">
									<tr>
										<td style="font-weight: bold;">Jenis Moda Transportasi</td>
										<td style="font-weight: bold;">Jenis Barang *</td>
										<td style="width: 30%;font-weight: bold;">Nama Barang</td>
										<td style="width: 10%;font-weight: bold;">Jumlah Brg</td>
										<td style="width: 5%;font-weight: bold;">Satuan</td>
									</tr>
									<tr>
										<td style="width: 17%;text-align: center;"><?= $moda['moda_name'] ?></td>
										<td style="width: 10%;text-align: center;">(NTE / MATERIAL / ALKER / SARKER)</td>
										<td colspan="3" style="padding: 0">
											<table style="width: 100%;min-height: 49px;">
												<?php 
													$urut=1;
				                                  	foreach($data_detail as $row) : ?>
				                                  		<tr>
															<td style="width: 29%"><?= $row['nama_barang'] ?></td>
															<td style="width: 9.7%"><?= $row['qty'] ?></td>
															<td style="width: 5.2%"><?= $row['satuan'] ?></td>
														</tr>				                                  		
				                                <?php
				                                  	$urut++;
				                                  	endforeach;
				                                ?>
												

											</table>
										</td>
									</tr>
									<tr>
										<td colspan="5">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="5" style="padding: 0">
											<table style="width: 100%">
												<tr>
													<td style="text-align: center;width: 35%;font-weight: bold;">PT. WAHANA MULTI LOGISTIK</td>
													<td style="text-align: center;width: 30%;font-weight: bold;">PENGIRIM (SUPPLIER/TELKOM AKSES)</td>
													<td style="text-align: center;width: 40%;font-weight: bold;">PENERIMA</td>
												</tr>
												<tr>
													<td style="padding-top: 80px;">
														Nama : <br>
														NIK/Jabatan : <br>
														Tanggal : 
													</td>
													<td style="padding-top: 80px;">
														Nama : <br>
														NIK/Jabatan : <br>
														Tanggal : 
													</td>
													<td style="padding-top: 80px;">
														Nama : <br>
														NIK/Jabatan : <br>
														Tanggal : 
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="border-top: none;font-style: italic;">* Pilih salah satu</td>
						</tr>
					</table>
					
				</div>
			<? }elseif ($page == "sj_ti") { ?>
				<style type="text/css">
					#page-wrap {
					    width: 650px;
					}
					p{
						font-size: 17px;
						display: block;
						width: 100%;
					}
					.table1 {
						display: block;
					    width: 100%;
					    padding-left: 20px;
					    font-size: 17px;
					}
					.table2 {
					    width: 100%;
					    padding-left: 20px;
					    font-size: 17px;
					}
					.kolom-routing{
						float: left;
					    margin-top: 58px;
					    font-size: 17px;
					    font-weight: bold;
					    border: solid;
					    padding: 10px;
					}
				</style>
				<div class="row">
					<div style="width: 100%">
						<div class="kolom-routing">
							NO ROUTING : <?= empty($data) ? "" : $data['no_routing'] ?>
						</div>
						<img src="<?= base_url() ?>assets/images/logo TI.png" style="float: right;" />
					</div>
					<h1 style="text-align: center;font-size: 24px;font-weight: bold;width: 100%;margin-bottom: 35px;">SURAT JALAN</h1>
					<p>Kami yang bertandatangan dibawah ini:</p><br>
					<table class="no-border table1">
						<tr>
							<td class="no-border">Nama Lengkap</td><td class="no-border">:</td>
							<td class="no-border"><?= $this->session->userdata('username') ?></td>
						</tr>
						<tr>
							<td class="no-border">Nama Perusahaan</td class="no-border"><td class="no-border">:</td><td class="no-border">PT Wahana Multi Logistik</td>
						</tr>
						<tr>
							<td class="no-border">Contact Number</td class="no-border"><td class="no-border">:</td>
							<td class="no-border"><?= $this->session->userdata('hp') ?></td>
						</tr>
						<tr>
							<td class="no-border">Unit</td><td class="no-border">:</td>
							<td class="no-border"><?= $this->session->userdata('role') ?></td>
						</tr>
					</table>
					<p>Pada hari ini <?= nama_hari(date('Y-m-d')) ?>, <?= tgl_indo(date('Y-m-d')) ?></p>
					<p>Telah menyerahkan Material kepada :</p>
					<table class="no-border table1" style="margin-bottom: 20px;">
						<tr>
							<td class="no-border">Nama Lengkap</td><td class="no-border">:</td>
							<td class="no-border"><?= empty($data) ? "" : $data['attn_penerima'] ?></td>
						</tr>
						<tr>
							<td class="no-border" style="width: 200px;">Nama Perusahaan</td class="no-border"><td class="no-border">:</td>
							<td class="no-border"><?= empty($data) ? "" : $data['nama_penerima'] ?></td>
						</tr>
						<tr>
							<td class="no-border" style="vertical-align: top;">Alamat</td>
							<td class="no-border" style="vertical-align: top;">:</td>
							<td class="no-border"><?= empty($data) ? "" : $data['alamat_penerima'] ?></td>
						</tr>
						<tr>
							<td class="no-border">Contact Number</td class="no-border"><td class="no-border">:</td>
							<td class="no-border"><?= empty($data) ? "" : $data['hp_penerima'] ?></td>
						</tr>
					</table>
					<p>Rincian sebagai berikut :</p>
					<table class="table2" style="margin-bottom: 30px;">
						<thead>
							<th>No</th>
							<th>Uraian</th>
							<th>Unit</th>
							<th>Qty</th>
							<th>Keterangan</th>
						</thead>
						<tbody>
							<?php 
								$urut=1;
                              	foreach($data_detail as $row) : ?>
                              		<tr>
                              			<td style="width: 5%"><?= $urut ?></td>
										<td style="width: 29%"><?= $row['nama_barang'] ?></td>
										<td style="width: 5.2%"><?= $row['satuan'] ?></td>
										<td style="width: 9.7%"><?= $row['qty'] ?></td>
										<td ></td>
									</tr>				                                  		
                            <?php
                              	$urut++;
                              	endforeach;
                            ?>
                        </tbody>
						
					</table>

					<p>Material telah diterima dengan lengkap dan kondisi baik.</p>
					<p>Catatan :</p>
					<p style="margin-bottom: 0">________________________________________________________________________</p>
					<p>________________________________________________________________________</p>
					<div style="width: 100%;display: contents;margin-top: 90px;">
						<div style="width: 50%;text-align: center;margin-bottom: 0px">
							<p>Yang menyerahkan</p>
							<br>
							<br>
							<br>
							<p>___________________</p>
						</div>
						<div style="width: 50%;text-align: center;margin-bottom: 0px">
							<p>Yang menerima</p>
							<br>
							<br>
							<br>
							<p>___________________</p>
						</div>
					</div>
				</div>
			<? }elseif ($page == "sj_tsel") { ?>
				<style type="text/css">
					#page-wrap {
					    width: 650px;
					}
					p{
						font-size: 17px;
						display: block;
						width: 100%;
					}
					.table1 {
						display: block;
					    width: 100%;
					    padding-left: 20px;
					    font-size: 17px;
					}
					.table2 {
					    width: 100%;
					    padding-left: 20px;
					    font-size: 17px;
					}
					.kolom-routing{
						float: left;
					    margin-top: 58px;
					    font-size: 17px;
					    font-weight: bold;
					    border: solid;
					    padding: 10px;
					}
					table td, table th {
					    padding: 0px;
					}
					.table2 td, .table2 th {
					    padding: 5px;
					}
				</style>
				<div class="row">
					<? if($pic == true): ?>
					<div style="width: 100%;text-align: center;">
						<img src="<?= base_url() ?>assets/images/logo-tsel.png" />
					</div>
					<? endif; ?>
					<h1 style="text-align: center;font-size: 24px;font-weight: bold;width: 100%;margin-bottom: 35px;">SURAT JALAN</h1>
					<table class="no-border table1" style="padding-left: 0">
						<tr>
							<td class="no-border">Nomor Surat Jalan</td><td class="no-border">:</td>
							<td class="no-border" style="padding-left: 10px"><?= empty($data) ? "" : $data['no_routing'] ?></td>
						</tr>
						<tr>
							<td class="no-border">Tanggal Surat Jalan</td>
							<td class="no-border">:</td>
							<td class="no-border" style="padding-left: 10px"> <?= tgl_indo(date('Y-m-d')) ?></td>
						</tr>
						<tr>
							<? if($pic == true): ?>
								<td class="no-border">Grapari</td>
							<? else: ?>
								<td class="no-border">WHSO/ Plaza Telkom</td>
							<? endif; ?>
							<td class="no-border">:</td>
							<td class="no-border" style="padding-left: 10px"><?= ($pic == true) ? "………………………………………" : "Grapari" ?></td>
						</tr>
						<tr>
							<td class="no-border"></td>
							<td class="no-border"></td>
							<td class="no-border" style="padding-bottom: 20px">Up : ………………………………………</td>
						</tr>

						<tr>
							<td class="no-border" style="width: 200px;">Alamat Pick Up</td><td class="no-border">:</td>
							<td class="no-border" style="padding-left: 10px"><?= $data['nama_pengirim'] ?></td>
						</tr>
						<? if($pic == false): ?>
						<tr>
							<td class="no-border">Telkom Acces Pickup</td><td class="no-border">:</td>
							<td class="no-border" style="padding-left: 10px">………………………………………</td>
						</tr>
						<? endif; ?>
						<tr>
							<td class="no-border">Tanggal Pickup </td><td class="no-border">:</td>
							<td class="no-border" style="padding-left: 10px"><?= tgl_indo($data["pickup_date"]) ?></td>
						</tr>
						<tr>
							<td class="no-border">Tanggal Kirim</td><td class="no-border">:</td>
							<td class="no-border" style="padding-left: 10px">………………………………………</td>
						</tr>
					</table>
					<p style="padding-top: 20px; margin-bottom: 0">Kami yang bertandatangan dibawah ini :</p>
					<p style="padding-top: 0px;font-style: italic;font-size: 13px">*/diisi oleh kantorpos tujuan</p>
					<table class="no-border table1" style="padding-left: 40px">
						<? if($pic == false): ?>
						<tr>
							<td class="no-border" style="width: 200px;">Nama /NIPTA</td><td class="no-border">:</td>
							<td class="no-border" style="padding-left: 10px"><?= $data['attn_pengirim'] ?></td>
						</tr>
						<? endif; ?>
						<tr>
							<td class="no-border" style="width: 200px;">Nama Kantor TA</td>
							<td class="no-border">:</td>
							<td class="no-border" style="padding-left: 10px"><?= $data['nama_pengirim'] ?></td>
						</tr>
						<tr>
							<td class="no-border" style="width: 200px;">Contact Number </td>
							<td class="no-border">:</td>
							<td class="no-border" style="padding-left: 10px"><?= $data['hp_pengirim'] ?></td>
						</tr>

						
					</table>
					<p style="padding-top: 20px">Pada hari ini <?= nama_hari(date('Y-m-d')) ?>. tanggal <?= date('d') ?> bulan <?= bulan(date('Y-m-d')) ?> Tahun <?= date('Y') ?></p>
					<p style="padding-top: 10px">Telah menyerahkan Material NTE Indi Home Kepada :</p>
					<table class="no-border table1" style="margin-bottom: 20px;margin-left: 20px;">
						<tr>
							<td class="no-border">Nama Lengkap/Bagian</td><td class="no-border">:</td>
							<td class="no-border" style="padding-left: 10px"><?= empty($data) ? "" : $data['attn_penerima'] ?></td>
						</tr>
						<tr>
							<td class="no-border" style="width: 200px;">Nama Perusahaan</td class="no-border"><td class="no-border">:</td>
							<td class="no-border" style="padding-left: 10px"><?= empty($data) ? "" : $data['nama_penerima'] ?></td>
						</tr>
						<tr>
							<td class="no-border" style="vertical-align: top;">Alamat</td>
							<td class="no-border" style="vertical-align: top;">:</td>
							<td class="no-border" style="padding-left: 10px"><?= empty($data) ? "" : $data['alamat_penerima'] ?></td>
						</tr>
						<tr>
							<td class="no-border">Contact Number</td class="no-border"><td class="no-border">:</td>
							<td class="no-border" style="padding-left: 10px"><?= empty($data) ? "" : $data['hp_penerima'] ?></td>
						</tr>
					</table>
					<p>Rincian sebagai berikut :</p>
					<table class="table2" style="margin-bottom: 30px;">
						<thead>
							<th>No</th>
							<th>Uraian</th>
							<th>Unit</th>
							<th>Qty</th>
							<th>Keterangan</th>
						</thead>
						<tbody>
							<?php 
								$urut=1;
                              	foreach($data_detail as $row) : ?>
                              		<tr>
                              			<td style="width: 5%"><?= $urut ?></td>
										<td style="width: 29%"><?= $row['nama_barang'] ?></td>
										<td style="width: 5.2%"><?= $row['satuan'] ?></td>
										<td style="width: 9.7%"><?= $row['qty'] ?></td>
										<td ></td>
									</tr>				                                  		
                            <?php
                              	$urut++;
                              	endforeach;
                            ?>
                        </tbody>
						
					</table>

					<p>Material NTE telah diterima dengan lengkap dan kondisi baik.</p>
					<p>Catatan :</p>
					<p style="margin-bottom: 0">________________________________________________________________________</p>
					<p style="margin-bottom: 0">________________________________________________________________________</p>
					<p>________________________________________________________________________</p>
					<div style="width: 100%;display: contents;margin-top: 90px;">
						<div style="width: 33%;text-align: center;margin-bottom: 0px">
							<p>Diserahkan oleh</p>
							<br>
							<br>
							<br>
							<p>___________________</p>
							<p>Petugas Grapari/Plasa</p>
						</div>
						<div style="width: 33%;text-align: center;margin-bottom: 0px">
							<p>Dikirim oleh</p>
							<br>
							<br>
							<br>
							<p>___________________</p>
							<p>Ekspedisi / TA</p>
						</div>
						<div style="width: 33%;text-align: center;margin-bottom: 0px">
							<p>Diterima oleh</p>
							<br>
							<br>
							<br>
							<p>___________________</p>
							<p>Petugas WH SO</p>
						</div>
					</div>
				</div>
			<? }elseif ($page == "st_tsel") { ?>
				<style type="text/css">
					#page-wrap {
					    width: 650px;
					}
					p{
						font-size: 17px;
						display: block;
						width: 100%;
					}
					.table1 {
						display: block;
					    width: 100%;
					    padding-left: 20px;
					    font-size: 17px;
					}
					.table2 {
					    width: 100%;
					    padding-left: 20px;
					    font-size: 17px;
					}
					.kolom-routing{
						float: left;
					    margin-top: 58px;
					    font-size: 17px;
					    font-weight: bold;
					    border: solid;
					    padding: 10px;
					}
					table td, table th {
					    padding: 0px;
					}
					.table2 td, .table2 th {
					    padding: 5px;
					}
				</style>
				<div class="row">
					
					<h1 style="text-align: center;font-size: 21px;font-weight: bold;width: 100%;margin-bottom: 0px;padding-top: 0px;">BERITA ACARA SERAH TERIMA <br>PERANGKAT TELKOMSEL</h1>
					<p style="text-align: center;padding:0;">Nomor : <?= empty($data) ? "" : $data['spk_no'] ?></p>
					<hr>
					<p style="padding-top: 20px;margin-bottom: 0">Pada hari ini ……………. tanggal ……… bulan ……………. Tahun …………</p>
					<p style="padding-top: 0px">Kami yang bertanda tangan dibawah ini:</p>

					<table class="no-border table1" style="padding-left: 20;padding-top: 0px">
						<tr>
							<td class="no-border" style="width: 30px;vertical-align: top;">1.</td>
							<td class="no-border">
								<table>
									<tr>
										<td class="no-border">Nama</td>
										<td class="no-border">:</td>
										<td class="no-border" style="padding-left: 10px"></td>
									</tr>
									<tr>
										<td class="no-border">Unit Kerja / Jabatan</td>
										<td class="no-border">:</td>
										<td class="no-border" style="padding-left: 10px"></td>
									</tr>
									<tr>
										<td class="no-border">Selanjutnya</td>
										<td class="no-border">:</td>
										<td class="no-border" style="padding-left: 10px">PIHAK PERTAMA</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td class="no-border" style="width: 30px;vertical-align: top;">2.</td>
							<td class="no-border">
								<table>
									<tr>
										<td class="no-border">Nama</td>
										<td class="no-border">:</td>
										<td class="no-border" style="padding-left: 10px"></td>
									</tr>
									<tr>
										<td class="no-border">Unit Kerja / Jabatan</td>
										<td class="no-border">:</td>
										<td class="no-border" style="padding-left: 10px"></td>
									</tr>
									<tr>
										<td class="no-border">Selanjutnya</td>
										<td class="no-border">:</td>
										<td class="no-border" style="padding-left: 10px">PIHAK KEDUA</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<p style="padding-top: 20px; margin-bottom: 20px">Telah dilakukan proses serah terima perangkat – perangkat TELKOMSEL untuk keperluan Pekerjaan Refurbishment antara PIHAK PERTAMA kepada PIHAK KEDUA, Adapun perangkat – perangkat yang diserahkan PIHAK PERTAMA terlampir sebagai berikut :</p>
					
					<table class="table2" style="margin-bottom: 20px;">
						<thead>
							<th>Item Perangkat</th>
							<th>Jumlah Unit</th>
						</thead>
						<tbody>
							<?php 
								$urut=1;
                              	foreach($data_detail as $row) : ?>
                              		<tr>
										<td style="width: 29%"><?= $row['nama_barang'] ?></td>
										<td style="width: 9.7%"><?= $row['qty'] ?></td>
									</tr>				                                  		
                            <?php
                              	$urut++;
                              	endforeach;
                            ?>
                        </tbody>
						
					</table>

					<p>Detil Perangkat terdapat dalam lampiran Berita Acara Serah Terima ini.</p>
					<p>PIHAK KEDUA telah menerima perangkat sesuai lampiran. Demikian Berita Acara Pemeriksaan ini dibuat untuk dipergunakan sebagaimana mestinya. </p>
					
					<table class="table2">
						<tr>
							<td style="font-weight: bold;text-align: center;">PIHAK PERTAMA</td>
							<td style="font-weight: bold;text-align: center;">PIHAK KEDUA</td>
							<td style="font-weight: bold;text-align: center;">PIHAK KETIGA</td>
						</tr>
						<tr>
							<td style="font-weight: bold;height: 80px;"></td>
							<td style="font-weight: bold;"></td>
							<td style="font-weight: bold;"></td>
						</tr>
						<tr>
							<td style="font-weight: bold;">NIK : </td>
							<td style="font-weight: bold;">NIK : </td>
							<td style="font-weight: bold;">NIK : </td>
						</tr>
					</table>
					
					<p style="padding-top: 20px;">Dikirim via …………………… Resi ………………………… tanggal …………………….</p>
					<p style="text-align: right;margin-bottom: 0">Diterima ditujuan pada tanggal, ………………………</p>
					<p style="text-align: right;">Jam,……………….. </p>

					<table class="table2" style="margin-bottom: 20px">
						<tr>
							<td style="font-weight: bold;text-align: center;">PIHAK EXPEDISI</td>
							<td style="font-weight: bold;text-align: center;">PIHAK PENERIMA</td>
						</tr>
						<tr>
							<td style="font-weight: bold;height: 80px;"></td>
							<td style="font-weight: bold;"></td>
						</tr>
						<tr>
							<td style="font-weight: bold;">NIK : </td>
							<td style="font-weight: bold;">NIK : </td>
						</tr>
					</table>
				</div>
			<?php } ?>
		</div>
	</body>
	</html>
	<!-- <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> -->
    <script type="text/javascript" src="<?= base_url(); ?>assets\bower_components\jquery\js\jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets\bower_components\jquery-ui\js\jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets\bower_components\popper.js\js\popper.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets\bower_components\bootstrap\js\bootstrap.min.js"></script>

	<!-- <script  src="<?= base_url(); ?>assets\js\index.js"></script> -->
	<script type="text/javascript">
		$(document).ready(function(){  
			// window.print();
		})
	</script>
</body>
</html>
