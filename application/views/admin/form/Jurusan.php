<form method="POST" action="<?= base_url('Admin/saveJurusan');?>" id="fakultas">
  <div class="form-row align-items-center">
    <div class="col-md-auto">
      <label class="sr-only" for="inlineFormInput">ID Fakultas</label>
      <input name="id_jurusan" min="0" type="number" class="form-control btn-sm mb-4" placeholder="ID Jurusan" required>
    </div>
    <div class="col-md">
      <label class="sr-only" for="inlineFormInputGroup">Jurusan</label>
      <div class="input-group mb-4">
        <input name="jurusan" type="text" class="form-control btn-sm" placeholder="Jurusan" required>
      </div>
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-4 btn-sm">Submit</button>
    </div>
  </div>
</form>