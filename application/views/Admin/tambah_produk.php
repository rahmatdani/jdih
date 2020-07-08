<script src="<?php echo base_url('assets/ckeditor_basic/ckeditor.js'); ?>"></script>
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>Form Tambah Produk</h1>
        </div>
        <a href="<?php echo base_url('Admin/Produk') ?>" class="btn btn-success mb-3">Kembali</a>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?php echo base_url('Admin/Produk/tambah_produk_aksi') ?>" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nomor</label>
                            <input type="text" name="nomor" class="form-control">
                            <?php echo form_error('nomor','<div class="text-small text-danger">','</div>');?>
                        </div>
                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="text" name="tahun" class="form-control">
                            <?php echo form_error('tahun','<div class="text-small text-danger">','</div>');?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tentang</label>
                            <input type="text" name="tentang" class="form-control">
                            <?php echo form_error('tentang','<div class="text-small text-danger">','</div>');?>
                        </div>
                        <div class="form-group">
                            <label>Upload File Pdf</label>
                            <input type="file" name="filepdf" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Konten</label>
                            <textarea class="form-control" name="konten" rows="3"></textarea>
                            <!-- <input type="text" name="konten" class="form-control"> -->
                            <?php echo form_error('konten','<div class="text-small text-danger">','</div>');?>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>
</div>    
<script>
    CKEDITOR.replace('konten');
</script>