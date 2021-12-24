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
                            <div class="card mb-3">
                                <div class="card-header">
                                    <a href="<?= site_url('transaksi/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
                                </div>
                                <div class="card-body">

                                    <form action="<?= site_url('transaksi/save'); ?>" method="post" enctype="multipart/form-data">


                                        <div class="form-group">
                                            <label for="tanggal">Tanggal Transaksi*</label>
                                            <input class="form-control <?= form_error('tanggal') ? 'is-invalid' : '' ?>" type="date" name="tanggal" min="0" placeholder="Tanggal Transaksi" />
                                            <div class="invalid-feedback">
                                                <?= form_error('tanggal') ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="kd_produk">Kode Produk*</label>
                                            <select class="form-control <?= form_error('kd_produk') ? 'is-invalid' : '' ?>" name="kd_produk">
                                                <?php foreach($produk as $p): ?>
                                                    <option value="<?= $p->kd_produk; ?>"> <?= $p->kd_produk; ?> : <?= $p->nama; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                <?= form_error('kd_produk') ?>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="qty">Quantity</label>
                                            <input class="form-control <?= form_error('qty') ? 'is-invalid' : '' ?>" type="number" name="qty" min="0" />
                                            <div class="invalid-feedback">
                                                <?= form_error('qty') ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="kasir_id">ID Kasir*</label>
                                            <select class="form-control <?= form_error('kasir_id') ? 'is-invalid' : '' ?>" name="kasir_id">
                                                <?php foreach($kasir as $k): ?>
                                                    <option value="<?= $k->id_kasir; ?>"><?= $k->nama; ?> - <?= $k->id_kasir; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                <?= form_error('kasir_id') ?>
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