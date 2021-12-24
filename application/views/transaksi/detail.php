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

                <!-- DataTables -->
                <div class="container">
                    <div class="row">
                        <div class="col">
                        <?php $this->load->view('layout/breadcrum'); ?>
                            <div class="card mb-3">
                            <div class="card-header">
                                    <a href="<?= site_url('transaksi/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
                                </div>
                                <div class="card-body">
                                    <?php if ($this->session->flashdata('pesan')) : ?>
                                        <div class="alert alert-primary" role="alert">
                                            <?= $this->session->flashdata('pesan'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="table-responsive">
                                        <table class="display table table-striped table-hover" id="dataTable" width="80%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>ID Transaksi</th>
                                                    <th>Kode Produk</th>
                                                    <th>Nama Produk</th>
                                                    <th>Harga</th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($detail as $d) : ?>
                                                    <tr>
                                                        <td width="150">
                                                            <?= $d->id_transaksi ?>
                                                        </td>
                                                        <td>
                                                            <?= $d->kd_produk ?>
                                                        </td>
                                                        <td>
                                                            <?= $nm_produk ?>
                                                        </td>
                                                        <td>
                                                            <?= $d->harga ?>
                                                        </td>
                                                        <td>
                                                            <?= $d->qty ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>

                                            </tbody>
                                        </table>
                                    </div>
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

    <script>
        function deleteConfirm(url) {
            $('#btn-delete').attr('href', url);
            $('#deleteModal').modal();
        }
    </script>

    <?php $this->load->view('layout/js'); ?>

</body>

</html>