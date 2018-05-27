<?php foreach ($konsentrasi->result() as $k) {
  ?>
  <form method="POST" action="<?php echo base_url('Admin/submit_kaprodi/'.$k->id);?>" id="kaprodi">
   <div class="form-row align-items-center">
    <div class="col-md mb-4">
      <select name="kaprodi" class="custom-select mr-sm-2">
        <option selected>Mengubah Kaprodi <?php echo $k->konsentrasi;?></option>
        <?php foreach ($dosen as $j) {
          ?>
          <option value="<?php echo $j->nik;?>"><?php echo $j->nama_dosen;?></option>
          <?php } ?>
        </select>
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-4">Submit</button>
      </div>
    </div>
  </form>
  <?php } ?>