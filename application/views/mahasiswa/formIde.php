<form method="POST" action="<?= base_url('Mahasiswa/sendIde') ;?>">
	<div class="form-group">
		<textarea class="form-control" name="deskripsi" placeholder="Deskripsi" id="deskripsi" minlength="200" rows="16" value=''>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto a possimus voluptates? Tenetur temporibus repellendus ipsam dolorum at nobis fugiat id culpa! Dolores, repudiandae consectetur. Vero maiores quia quibusdam! Eveniet.</textarea>
		<small>Minimal 200 Kata</small>
	</div>
	<div class="form-row">
		<div class="form-group col-md">
			<input class="form-control form-control-sm" type="text" name="judul" id="judul" placeholder="Judul Skripsi" required>
		</div>

		<div class="form-group float-right">
			<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-paper-plane fa-sm"></i> Submit</button>
		</div>
	</div>
</form>	