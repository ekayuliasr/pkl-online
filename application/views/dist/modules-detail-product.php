<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
                                     

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?= $product->REFF_ID; ?></h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Transaksi</a></div>
              <div class="breadcrumb-item">Detail</div>
            </div>
          </div>
         
          <div class="section-body">
            <div class="invoice">
              <div class="invoice-print">
                <div class="row">
                  <div class="col-md-12">
                    <div class="section-title">Detail Product</div>
                    <!-- <p class="section-lead">All items here cannot be deleted.</p> -->
                    <h3 class="text-center text-black-50 mb-4"><?= $product->PRODUCT_NAME; ?></h3>
                    <img alt="image" src="<?= $product->PRODUCT_IMAGE_NAME == null ? base_url().'assets/img/news/img07.jpg' : base_url().'upload/products/'.$product->PRODUCT_IMAGE_NAME; ?>" class="d-block ml-auto mr-auto mb-4" style="width:35%">
                    
                    <div class="row">
                      <div class="col-md-6">
                        <address>
                          <strong>Category:</strong><br>
                            <?= $product->CATEGORY_NAME; ?><br><br>

                            <strong>Description:</strong><br>
                            <?= $product->PRODUCT_DESCRIPTION; ?><br><br>

                            <strong>Harga:</strong><br>
                            Rp. <?= number_format($product->PRODUCT_PRICE); ?><br><br>
                        </address>
                      </div>
                    </div>
                    <!-- <div class="table-responsive">
                      <table class="table table-striped table-hover table-md">
                        <tr>
                          <th data-width="40">#</th>
                          <th>Produk</th>
                          <th>Kategori</th>
                          <th>Deskripsi</th>

                          <th class="text-center">Harga</th>
                        </tr>
                        <tr>
                          <td>1</td>
                          <td><?= $product->PRODUCT_NAME; ?></td>
                          <td><?= $product->CATEGORY_NAME; ?></td>
                          <td><?= $product->PRODUCT_DESCRIPTION; ?></td>
                          <td></td>
                         
                          <td class="text-center">Rp. <?= number_format($product->PRODUCT_PRICE); ?></td>
                        </tr>
                      </table> -->
                    </div>
                  </div>
                </div>
              </div>
              <!-- <hr> -->
             
              </div>
            </div>
          </div>
        </section>
      </div>

        
<?php $this->load->view('dist/_partials/footer'); ?>