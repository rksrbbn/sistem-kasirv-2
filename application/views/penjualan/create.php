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

                <div class="card mb-3">
                    <div class="card-header">
                        <a href="<?= site_url('dosen/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
                    </div>
                    <div class="card-body">

                        <form action="<?= site_url('dosen/save'); ?>" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="kd_dosen">Kode dosen*</label>
                                <input class="form-control <?= form_error('kd_dosen') ? 'is-invalid' : '' ?>" type="text" name="kd_dosen" min="0" placeholder="Kode dosen" />
                                <div class="invalid-feedback">
                                    <?= form_error('kd_dosen') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nama_dosen">Nama dosen*</label>
                                <input class="form-control <?= form_error('nama_dosen') ? 'is-invalid' : '' ?>" type="text" name="nama_dosen" min="0" placeholder="Nama dosen" />
                                <div class="invalid-feedback">
                                    <?= form_error('nama_dosen') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat_dosen">Alamat dosen*</label>
                                <input class="form-control <?= form_error('alamat_dosen') ? 'is-invalid' : '' ?>" type="text" name="alamat_dosen" min="0" placeholder="Alamat dosen" />
                                <div class="invalid-feedback">
                                    <?= form_error('alamat_dosen') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="kd_mapel">Nama mapel*</label>
                                <select class="form-control <?= form_error('kd_mapel') ? 'is-invalid' : '' ?>" name="kd_mapel">
                                    <?php foreach ($mapels as $mapel) : ?>
                                        <option value="<?= $mapel->kd_mapel; ?>"><?= $mapel->nama_mapel; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= form_error('kd_mapel') ?>
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