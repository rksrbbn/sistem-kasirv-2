<!DOCTYPE html>
<html lang="en">

<head>

    <?php $this->load->view('layout/head'); ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->

        <?php $this->load->view('layout/sidebar'); ?>

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->

                <?php $this->load->view('layout/navbar'); ?>

                <!-- End of Topbar -->
                <div class="container">
                    <div class="row">
                        <div class="col">
                        <?php $this->load->view('layout/breadcrum'); ?>
                            <div class="card mb-3">
                                <div class="card-header">
            
                                    <a href="<?= site_url('produk/') ?>"><i class="fas fa-arrow-left"></i>
                                        Back</a>
                                </div>
                                <div class="card-body">
            
                                    <form action="<?= site_url('produk/update'); ?>" method="post" enctype="multipart/form-data">
            
                                        <input type="hidden" name="kode" value="<?= $produk->kd_produk ?>" />
            
                                        <div class="form-group">
                                            <label for="kd_produk">Kode Produk</label>
                                            <input class="form-control <?= form_error('kd_produk') ? 'is-invalid' : '' ?>" type="text" name="kd_produk" readonly min="0" placeholder="Kode Produk" value="<?= $produk->kd_produk ?>" />
                                            <div class="invalid-feedback">
                                                <?= form_error('kd_produk') ?>
                                            </div>
                                        </div>
            
                                        <div class="form-group">
                                            <label for="nama">Nama Produk*</label>
                                            <input class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>" type="text" name="nama" min="0" placeholder="Nama Produk" value="<?= $produk->nama ?>" />
                                            <div class="invalid-feedback">
                                                <?= form_error('nama') ?>
                                            </div>
                                        </div>
            
                                        <div class="form-group">
                                            <label for="harga">Harga*</label>
                                            <input class="form-control <?= form_error('harga') ? 'is-invalid' : '' ?>" type="text" name="harga" min="0" placeholder="Harga" value="<?= $produk->harga ?>" />
                                            <div class="invalid-feedback">
                                                <?= form_error('harga') ?>
                                            </div>
                                        </div>
            
                                        <div class="form-group">
                                            <label for="stok">Stok*</label>
                                            <input class="form-control <?= form_error('stok') ? 'is-invalid' : '' ?>" type="text" name="stok" min="0" placeholder="Stok" value="<?= $produk->stok ?>" />
                                            <div class="invalid-feedback">
                                                <?= form_error('stok') ?>
                                            </div>
                                        </div>
            
                                        <input class="btn btn-success" type="submit" name="btn" value="Save" />
                                    </form>
            
                                </div>
            
                                <div class="card-footer small text-muted">
                                    * required fields
                                </div>
            
            
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view('layout/footer'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php $this->load->view('layout/modal'); ?>

    <?php $this->load->view('layout/js'); ?>

</body>

</html>