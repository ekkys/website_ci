

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
          <!-- Main row -->
          <div class="row"> 
            <div class="col-lg-12"> 
              <div class="box box-box-primary">

                <div class="box-header"> 
                  <h3 class="box-title">Dashboard</h3> 
                </div>

                <div class="box-body chat" id="chat-box">
                  Anda berhasil Login sebagai :<br/>
                  Username : <?php echo $this->session->userdata('username') ?> <br/>
                  Level : <?php echo $this->session->userdata('level') ?> <br/>
                  id pengguna : <?php echo $this->session->userdata('id') ?> <br/>
                </div>

              </div>

            </div> 

          </div>

        </section>
        
      </div>
      <!-- /.content-wrapper -->

    