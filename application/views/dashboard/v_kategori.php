<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Kategori
			<small>Kategori Artikel</small>
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-lg-9">
				<a href="<?php echo base_url('dashboard/kategori_tambah'); ?>"
					class="btn btn-sm btn-primary">Buat Kategori baru</a>
					<br/>
					<br/>
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">Kategori</h3>
						</div>
						<div class="box-body">
							<!-- Notif ganti password sukses / gagal -->
							<?php
							if (isset($_GET['alert'])) {
								if ($_GET['alert'] == "sukses") {

									echo "<div class='alert alert-success'>Data baru berhasil disimpan!</div>";

								}else if ($_GET['alert'] == "gagal") {

									echo "<div class='alert alert-danger'>Maaf, Data baru gagal disimpan!</div>";

								}else if ($_GET['alert'] == "sukses_hapus") {

									echo "<div class='alert alert-success'>Data berhasil dihapus!</div>";

								}else if ($_GET['alert'] == "gagal_hapus") {
									
									echo "<div class='alert alert-danger'>Maaf, Data gagal dihapus!</div>";
								}
							}
							?>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th width="1%">NO</th>
										<th>Kategori</th>
										<th>Slug</th>
										<th width="10%">OPSI</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach($kategori as $k){
										?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo $k->kategori_nama; ?></td>
											<td><?php echo $k->kategori_slug; ?></td>
											<td>
												<a
												href="<?php echo base_url('dashboard/kategori_edit/').$k->kategori_id; ?>" class="btn btn-warning btnsm"> <i class="fa fa-pencil"></i> </a>
												<a
												href="<?php echo base_url('dashboard/kategori_hapus/').$k->kategori_id; ?>" class="btn btn-danger btnsm"> <i class="fa fa-trash"></i> </a>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section> 
	</div>