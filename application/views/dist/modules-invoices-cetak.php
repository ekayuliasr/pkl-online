<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $transaction->TRANSACTION_CODE; ?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style type="text/css" media="print">
        @page {
            size: 105mm 148mm;
            
        }
        body {
            font-family: Ariel;
            font-size: 12px;
        }
        table {
            border: solid thin #000;
            border-collapse: collapse;
        }
        td, th {
            padding: 3 6;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #F5F5F5;
            font-weight: bold;
        }
        h1 {
            text-align: center;
            font-size: 18px;
            text-transform: upparcase;
        }
    </style>
</head>
<body onload="print()"> <!--print()-->
    <div class="main-content">
        <section class="section">        
          <div class="section-body">
            <div class="invoice">
              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="invoice-title">
                      <h3><div class="badge"><?php 
                                  if ($transaction->TRANSACTION_STATUS == 1) {
                                    echo 'Menunggu Pembayaran';
                                  } else if ($transaction->TRANSACTION_STATUS == 2) {
                                    echo 'Menunggu Konfirmasi';
                                  } else if ($transaction->TRANSACTION_STATUS == 3) {
                                    echo 'Menunggu Barang Diproses';
                                  } else if ($transaction->TRANSACTION_STATUS == 4) {
                                    echo 'Barang Dikirim';
                                  } else if ($transaction->TRANSACTION_STATUS == 5) {
                                    echo 'Transaksi Berhasil';
                                  } else {
                                    echo 'Transaksi Gagal';
                                  }
                                ?></div></h3>
                      <div class="invoice-number"><?= $transaction->TRANSACTION_CODE; ?></div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-6">
                        <address>
                          <strong>Billed To:</strong><br>
                            <?= $transaction->USER_FULLNAME; ?><br><br>
                            <strong>Tanggal Transaksi:</strong><br>
                          <?= date("d F Y h:i:s", strtotime($transaction->TRANSACTION_DATE)); ?><br><br>
                        </address>
                      
                        <address>
                          <strong>Dikirim Kepada:</strong><br>
                          <?= $transaction->TRANSACTION_NAME; ?><br>
                          <?= $transaction->TRANSACTION_ADDRESS; ?>
                        </address>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="row mt-4">
                  <div class="col-md-12">
                    <div class="section-title"><strong>Order Summary</strong></div>
                  
                      <table>
                        <tr>
                          <td data-width="40">No.</td>
                          <td>Produk</td>
                          <td class="text-center">Harga</td>
                          <td class="text-center">Jumlah</td>
                          <td class="text-right">Total</td>
                        </tr>
                        <tr>
                          <td>1</td>
                          <td><?= $transaction->PRODUCT_NAME; ?></td>
                          <td class="text-center"><?= number_format($transaction->PRODUCT_PRICE); ?></td>
                          <td class="text-center"><?= $transaction->TRANSACTION_QTY; ?></td>
                          <td class="text-right"><?= number_format($transaction->PAYMENT_TOTAL); ?></td>
                        </tr>
                      </table>
                  
                    <div class="row mt-4">
                      <div class="col-lg-8">
                        <div class="section-title">Payment Method</div>
                        <div class="alert">
                            Anda dapat melakukan pembayaran melalui rekening berikut:<br>
                            <h6>BRI 0585-01-000755-30-4 a.n LIBMI Education Center </h6>
                            Sejumlah <b>Rp<?= number_format($transaction->PAYMENT_TOTAL); ?></b>
                        </div>
                     
                        <hr class="mt-2 mb-2">
                        <div class="invoice-detail-item">
                          <div class="invoice-detail-name">Total</div>
                          <div class="invoice-detail-value invoice-detail-value-lg">Rp<?= number_format($transaction->PAYMENT_TOTAL); ?></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="text-md-right">
                <div class="float-lg-left mb-lg-0 mb-3">
                  <?php if(!$this->session->userdata('admin') && $transaction->TRANSACTION_STATUS == 1): ?>
                    <button class="btn btn-primary btn-icon icon-left" data-toggle="modal" data-target="#confirmModal"><i class="fas fa-credit-card"></i> Process Payment</button>
                  <?php elseif($this->session->userdata('admin') && $transaction->TRANSACTION_STATUS > 1): ?>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
</body>
</html>