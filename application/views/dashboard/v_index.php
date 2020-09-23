

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
  </section>


  <!-- Main content -->

  <section class="content">

    <div class="row">
     <!-- Ringkasan Dashboard -->

     <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?php echo $jumlah_artikel; ?></h3>
          <p>jumlah artikel</p>
        </div>
        <div class="icon">
          <i class="ion ion-android-list"></i>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?php echo $jumlah_halaman; ?></h3>
          <p>jumlah halaman</p>
        </div>
        <div class="icon">
          <i class="ion ion-android-document"></i>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?php echo $jumlah_kategori; ?></h3>
          <p>jumlah kategori</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?php echo $jumlah_pengguna; ?></h3>
          <p>jumlah pengguna</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-lg-6">
      <div class="box box-primary">

      </div>
    </div>
  </div>

  <!-- Main row -->
  <div class="row">
    <div class="col-lg-6">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Dashboard</h3>
        </div>
        <div class="box-body">
          <h3>Selamat Datang !</h3>
          <div class="table-responsive">
            <table class="table table-bordered tablehover">
              <tr>
                <th width="%">Nama</th>
                <th width="1px">:</th>
                <td>
                  <?php
                  $id_user = $this->session->userdata('id');
                  $user = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row(); ?>
                  <p><?php echo $user->pengguna_nama; ?></p>
                </td>
              </tr>
              <tr>
                <th width="20%">Username</th>
                <th width="1px">:</th>
                <td><?php echo $this->session->userdata('username') ?></td>
              </tr>
              <tr>
                <th width="20%">Level</th>
                <th width="1px">:</th>
                <td><?php echo $this->session->userdata('level') ?></td>
              </tr>
              <tr>
                <th width="20%">Status</th>
                <th width="1px">:</th>
                <td>Aktif</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>

</div>
<!-- /.content-wrapper -->

