<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Halaman
			<small>Tulis Halaman Baru</small> 
		</h1>
	</section>

	<section class="content">
		<a href="<?php echo base_url('dashboard/pages'); ?>" class="btn btn-sm btn-primary">Kembali</a>
		<br>
		<br>

		<?php foreach($halaman as $h) { ?>

			<form method="post" action="<?php echo base_url('dashboard/pages_update') ?>">
				<div class="row">
					<div class="col-lg-12">
						<div class="box box primary">
							<div class="box-body">

								<div class="box-body">
									<div class="form-group">
										<input type="hidden" name="id" value="<?php echo $h->halaman_id; ?>">
										<label>Judul Halaman</label>
										<input type="text" name="judul" class="form-control" placeholder="Masukkan judul halaman" value="<?php echo $h->halaman_judul; ?>">
										<?php echo form_error('judul'); ?>
									</div>
								</div>

								<div class="box-body">
									<div class="form-group">
										<label>Konten Halaman</label>
										<?php echo form_error('konten'); ?>
										<br>
										<textarea class="form-control" id="editor" name="konten">
											<?php echo $h->halaman_konten; ?>
										</textarea>
									</div>
								</div>

								<input type="submit" value="Publish" class="btn btn-success btn-block">

							</div>
						</div>
					</div>
				</div>

			</form>
		<?php } ?>
	</section>
</div>