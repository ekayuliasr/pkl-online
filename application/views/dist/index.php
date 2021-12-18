<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
              <div class="row">
                <div class="col-md-8">
                <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                      <i class="fas fa-archive"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Total Produk Saya</h4>
                      </div>
                      <div class="card-body">
                        <?= $total_product; ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                      <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Sales</h4>
                      </div>
                      <div class="card-body">
                        <?= $total_selling; ?>/<?= !empty($user->TARGET) ? $user->TARGET : "0"; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <?php if (!empty($user->COMPANY_ID)): ?>
              <div class="card">
                <div class="card-header">
                  <h4>Produk Rekomendasi <?= ucwords(strtolower($user->COMPANY_NAME)); ?></h4>
                </div>
                <div class="card-body">
                  <div class="owl-carousel owl-theme" id="products-carousel">
                    <?php foreach ($products as $key): ?>
                      <div>
                        <div class="product-item pb-3">
                          <div class="product-image">
                            <img alt="image" src="<?= $key->IMAGE == null ? base_url().'assets/img/news/img07.jpg' : base_url().'upload/products/'.$key->IMAGE->PRODUCT_IMAGE_NAME; ?>" class="img-fluid">
                          </div>
                          <div class="product-details">
                            <div class="product-name"><?= $key->PRODUCT_NAME; ?></div>
                            <div class="text-muted text-small">Rp<?= number_format($key->PRODUCT_PRICE); ?></div>
                            <div class="product-cta">
                              <button onclick="selectProduct(<?= $key->PRODUCT_ID; ?>, '<?= $key->PRODUCT_NAME; ?>')" class="btn btn-primary">Pilih Produk</button>
                              <!-- <a href="#" class="btn btn-primary">Pilih Produk</a> -->
                            </div>
                          </div>  
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
              <?php endif; ?>
              <div class="card">
                <div class="card-header">
                  <h4>Transaksi</h4>
                  <div class="card-header-action">
                    <a href="<?= base_url(); ?>history/" class="btn btn-danger">Lihat lainnya <i class="fas fa-chevron-right"></i></a>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped table-hover">
                      <tr>
                        <th>ID Transaksi</th>
                        <th>Nama Produk</th>
                        <th>Status</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Action</th>
                      </tr>
                      <?php $no = 1; foreach ($transaction as $key): ?>     
                      <tr>
                        <td><?= $key->REFF_ID; ?></td>
                        <td><?= $key->PRODUCT_NAME; ?></td>
                        <td>
                          <?php 
                            if ($key->TRANSACTION_STATUS == 1) {
                              echo 'Menunggu Pembayaran';
                            } else if ($key->TRANSACTION_STATUS == 2) {
                              echo 'Menunggu Konfirmasi';
                            } else if ($key->TRANSACTION_STATUS == 3) {
                              echo 'Menunggu Barang Diproses';
                            } else if ($key->TRANSACTION_STATUS == 4) {
                              echo 'Barang Dikirim';
                            } else if ($key->TRANSACTION_STATUS == 5) {
                              echo 'Transaksi Berhasil';
                            } else {
                              echo 'Transaksi Gagal';
                            }
                          ?>
                        </td>
                        <td><?= date('d F Y', strtotime($key->TRANSACTION_DATE)); ?></td>
                        <td><a href="<?= base_url(); ?>transaction/detail/<?= $key->TRANSACTION_ID; ?>" class="btn btn-info btn-sm">Detail</a></td>
                      </tr>
                      <?php $no++; endforeach; ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <div class="card-description">Job Vacancies</div>
                </div>
                <div class="card-body p-0">
                  <div class="tickets-list">
                    <?php foreach($jobs as $job): ?>
                      <a class="ticket-item">
                        <div class="ticket-title">
                          <h4><?= $job->JOB_POSITION; ?></h4>
                        </div>
                        <div><?= $job->JOB_COMPANY; ?></div>
                        <div class="ticket-info">
                          <div class="text-primary text-small"><?= date('d F Y', strtotime($job->JOB_START)); ?> - <?= date('d F Y', strtotime($job->JOB_END)); ?></div>
                        </div>
                      </a>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
<?php $this->load->view('dist/_partials/footer'); ?>