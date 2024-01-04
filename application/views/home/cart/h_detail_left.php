<div class="panel panel-info">
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-user"></i> Informasi Pelanggan</h4>
    </div>
    <div class="panel-body">
        <fieldset id="account">
            <div class="form-group required">
                <label for="cnama" class="control-label">Nama</label>
                <input value="<?= $cst['dpn_cst'] . ' ' . $cst['blkg_cst'] ?>" readonly="" type="text" class="form-control" id="cnama" placeholder="Nama" name="cnama">
            </div>
            <div class="form-group required">
                <label for="ckontak" class="control-label">Kontak</label>
                <input value="<?= $cst['kontak_cst'] ?>" readonly="" type="text" class="form-control" id="ckontak" placeholder="Kontak" name="ckontak">
            </div>
            <div class="form-group required">
                <label for="calamat" class="control-label">Alamat</label>
                <textarea readonly="" rows="4" class="form-control" id="calamat" placeholder="Alamat" name="calamat"><?= $cst['alamat_cst'] ?></textarea>
            </div>
        </fieldset>
    </div>
</div>