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
					<div style="border: solid 1px black;">
						<table style="width: 100%">
							<tr>
								<td class="no-border" style="font-weight: bold;vertical-align: top;">To :</td>
								<td class="no-border" style="font-weight: bold;">
									PT. Telkom Akses<br>
									Gedung Telkom Jakarta Barat<br>
									Jl. Letjen S Parman Kav. 8<br>
									Tomang Grogol Petamburan<br>
									Jakarta Barat - DKI Jakarta 11440<br>
								</td>
								<td class="no-border">
									<table id="meta">
										<tr>
											<td class="meta-head no-border">Invoice</td>
											<td class="no-border"><?= empty($data) ? "" : $data['no_invoice']?></td>
										</tr>
										<tr>

											<td class="meta-head no-border">Date</td>
											<td class="no-border"><?= empty($data) ? "" : date("d M Y", strtotime($data['tgl_invoice']))?></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</div>
					<h1 class="header-inv" style="background-color: #1616a0;margin-bottom: 0;">INVOICE</h1>
					<table style="margin-bottom: 0; width: 100%;">

						<tr>
							<th>No</th>
							<th>Nama Barang</th>
							<th>Qty</th>
							<th>Satuan</th>
							<th>Berat/KG</th>
							<th>Harga</th>
							<th style="text-align: right;">Subtotal</th>
						</tr>

						<?php 
	                    $urut=1;
	                    foreach($data_detail as $row): ?>
						<tr class="item-row">
							<td><?=$urut?></td>
							<td class="item-name"><?= $row["nama_barang"] ?></td>
							<td class="item-name"><?= $row["qty"] ?></td>
							<td class="item-name"><?= $row["satuan"] ?></td>
							<td class="item-name"><?= $row["kg"] ?></td>
							<td style="text-align: right;"><?= number_format($row["price"]) ?></td>
							<td style="text-align: right;"><?= number_format($row["subtotal"]) ?></td>						
						</tr>
						<?php $urut++?>
	                    <?php endforeach; ?>
	                    <tr class="item-row">
							<td colspan="6" style="text-align: right;">Subtotal</td>
							<td style="text-align: right;"><?= number_format($data["subtotal"]) ?></td>
						</tr>
	                    <tr>
							<th>No</th>
							<th colspan="5">Kegiatan</th>
							<th style="text-align: right;">Biaya</th>
						</tr>

						<?php 
	                    $urut=1;
	                    foreach($data_biaya as $row): ?>
						<tr class="item-row">
							<td><?=$urut?></td>
							<td class="item-name" colspan="5"><?= $row["aktifitas"] ?></td>
							<td style="text-align: right;"><?= number_format($row["biaya"]) ?></td>					
						</tr>
						<?php $urut++?>
	                    <?php endforeach; ?>
						
						<tr class="item-row">
							<td colspan="6" style="text-align: right;">Charge</td>
							<td style="text-align: right;"><?= number_format($data["cost"]) ?></td>
						</tr>   
						<tr>
							<td colspan="6" class="total-line" style="text-align: right;font-weight: bold;">Grand Total</td>
							<td class="total-value" style="text-align: right;font-weight: bold;"><?= number_format($data["cost"] + $data["subtotal"]) ?></td>
						</tr>
						<tr>
							<td colspan="6" class="total-line" style="text-align: right;font-weight: bold;">PPN 1%</td>
							<td class="total-value" style="text-align: right;font-weight: bold;"><?= number_format($data["tax"]) ?></td>
						</tr>
						<tr>
							<td colspan="6" class="total-line" style="text-align: right;font-weight: bold;border-bottom: 1px solid black;">Total</td>
							<td class="total-value" style="text-align: right;font-weight: bold;border-bottom: 1px solid black;"><?= number_format($data["total"]) ?></td>
						</tr>
						<tr class="item-row">
							<td colspan="7" style="text-align:left;font-weight: bold;font-style: italic;font-size: 17px;">The Sum Of :  &nbsp;&nbsp;"<?= terbilang($data["total"]) ?>"</td>
						</tr>
						
					</table>
					<div style="border: solid 1px black;">
						<table style="width: 350px;margin-bottom: 10px;margin-left: 10px;">
							<tr>
								<td colspan="2"style="text-align:left;font-size: 13px;border: none;">
									<i><b>Please remit to our account of :</b></i><br>
								</td>
							</tr>
							<tr>
								<td class="p-0">Acc. Name</td>
								<td class="p-0">: PT. Wahana Multi Logistik</td>
							</tr>
							<tr>
								<td class="p-0">Acc Number</td>
								<td class="p-0">: 042501-000647-30-1</td>
							</tr>
							<tr>
								<td class="p-0">Name of Bank</td>
								<td class="p-0">: Bank BRI Cabang Tendean </td>
							</tr>
						</table>
					</div>
				</div>
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
							<p style="font-weight: bold;">Agus Setiawan, SE, MMTr</p>
						</td>
					</tr>
				</table>
				<div style="clear: both;height: 200px;"></div>
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
										<td style="text-align: right;width: 200px;" class="no-border">Rp <?= number_format($data["subtotal"] + $data["cost"]) ?></td>					
									</tr>
									<tr>
										<td class="item-name no-border" style="text-align: right;font-weight: 400;">Subtotal</td>
										<td style="text-align: right;width: 200px;text-decoration: overline;" class="no-border">Rp <?= number_format($data["subtotal"] + $data["cost"]) ?>
										</td>
									</tr>
									<tr>
										<td class="item-name no-border" style="text-align: right;font-weight: 400;">PPN 1%</td>
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
								<p style="margin-bottom: 0">BEKASI, <?= tgl_indo(date('Y-m-d')) ?></p>
								<p style="font-weight: bold;">PT. WAHANA MULTI LOGISTIK</p>
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
								REF<br><br>
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
										<td colspan="3"><?= empty($data) ? "" : tgl_indo(date("Y-m-d", strtotime($data['CreatedDate']))) ?></td>
										
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
											<?= empty($data) ? "" : $data['site_name'] ?>
										</td>
										<td>
											<?= empty($data) ? "" : $data['alamat_penerima'] ?>
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
							<td style="height: 100px;"></td>
							<td style="height: 100px;"></td>
						</tr>
					</table>
					
				</div>
			<? } elseif ($page == "routing_new") { ?>
				<div class="row">
					<table class="table" style="margin-bottom:10px;margin-top: 10px;">
						<tr>
							<td width="50%" height="100px;" class="no-border">
								<table style="width: 100%">
									<tr>
										<td style="font-weight: bold;width: 70%" class="no-border">
											<div style="border: solid 1px grey;padding: 10px;">Reff:</div>
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
											<div style="border: solid 1px grey;padding: 10px;font-size: 12px;"><?= empty($data) ? "" : $data['pickup_address'] ?></div>
										</td>
									</tr>
									<tr>
										<td style="font-weight: bold;width: 40%;" class="no-border">
											Destination	
										</td>
										<td class="no-border" width="1%" style="padding: 10px 5px;">:</td>
										<td class="no-border" width="49%" >
											<div style="border: solid 1px grey;padding: 10px;font-size: 12px;"><?= empty($data) ? "" : $data['alamat_penerima'] ?></div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>

					
					</h1>
					<table style="width: 100%">
						<tr>
							<td width="50%" class="no-border" style="vertical-align: top;">
								<table style="width: 100%">
									<tr>
										<td style="font-weight: bold">TANGGAL DO</td>
										<td colspan="3"></td>
									</tr>
									<tr>
										<td style="font-weight: bold">NOMOR DO</td>
										<td colspan="3">123</td>
									</tr>
									<tr>
										<td style="font-weight: bold">COMBINE/MULTI</td>
										<td colspan="3"></td>
									</tr>
									<tr>
										<td rowspan="2" style="font-weight: bold">JENIS PENGIRIMAN</td>
										<td style="font-weight: bold">DARAT</td>
										<td style="font-weight: bold">LAUT</td>
										<td style="font-weight: bold">UDARA</td>
									</tr>
									<tr>
										<td>KG</td>
										<td>KG</td>
										<td>KG</td>
									</tr>
									<tr>
										<td colspan="4" class="no-border"></td>
									</tr>
									<tr>
										<td style="font-weight: bold">VENDOR NAME</td>
										<td colspan="3">123</td>
									</tr>
									<tr>
										<td style="font-weight: bold">NO HP</td>
										<td colspan="3">123</td>
									</tr>
									<tr>
										<td style="font-weight: bold">JENIS ARMADA</td>
										<td colspan="3">123</td>
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
											Jl. Kalimalang No.123<br>
											Bekasi 17510
										</td>
										<td>
											Perum. Graha Prima Blok IA NO.88A
											Tambun Utara
										</td>
									</tr>
									<tr>
										<td colspan="2" class="no-border"></td>
									</tr>
									<tr>
										<td style="font-weight: bold">NO. TRUCKING</td>
										<td></td>
									</tr>
									<tr>
										<td style="font-weight: bold">NO. CONTAINER / SHIPPING NAME</td>
										<td></td>
									</tr>
									<tr>
										<td style="font-weight: bold">NO. SMU / AIRLINES</td>
										<td></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2" class="no-border"></td>
						</tr>
						<tr>
							<td colspan="2" style="height: 100px;"></td>
						</tr>
						<tr>
							<td class="no-border" style="font-weight: bold;">PAYMENT</td>
							<td class="no-border" style="font-weight: bold;">INVOICE</td>
						</tr>
						<tr>
							<td style="height: 100px;"></td>
							<td style="height: 100px;"></td>
						</tr>
					</table>
					
				</div>
			<? } ?>
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
