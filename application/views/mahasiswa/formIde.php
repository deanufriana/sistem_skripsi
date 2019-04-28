<form method="POST" action="<?= base_url('Mahasiswa/sendIde') ;?>">
	<div class="form-group">
		<textarea class="form-control" name="deskripsi" placeholder="Deskripsi" id="deskripsi" minlength="200" rows="16" value=''></textarea>
		<small>Minimal 200 Kata</small>
	</div>
	<div class="form-row">
		<div class="form-group col-md col">
			<input class="form-control form-control-sm" type="text" name="judul" id="judul" placeholder="Judul Skripsi" required>
		</div>

		<div class="form-group col-auto">
			<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-paper-plane fa-sm"></i> Submit</button>
		</div>
	</div>
</form>	