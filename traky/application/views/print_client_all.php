<?php include 'header.php'; ?>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="/traky/welcome">
                <i class="fa fa-dashboard"></i><span>Dashboard</span></i>
              </a>
            </li>
			<li class="active treeview">
              <a href="/traky/client">
                <i class="fa fa-users"></i><span>Clients</span></i>
              </a>
            </li>
			<li class="treeview">
              <a href="/traky/tax_types">
                <i class="fa fa-files-o "></i><span>Tax Types</span></i>
              </a>
            </li>            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Client
            <small>Print Preview</small>
          </h1>
            <a class="" href="<?php echo DIR_TRAKY; ?>client/"><i class="fa fa-hand-o-left fa-2x" title="Go Back"></i></a>
            <button onclick="printDiv('all_client')"><i class="fa fa-print fa-2x" title="print now"></i></button>
          <ol class="breadcrumb">
            <li><a href="../welcome"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Clients</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $status; ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding" id="all_client">
                  <table class="table table-condensed">
                    <tr>
                        <th>Client</th>
                        <th>TIN</th>
                        <th>Address</th>
                        <th>Signatory</th>
                    </tr>
                   <?php foreach($clients as $client): ?>
                    <tr>                        
                        <td><?php echo $client->client_name; ?></td>
                        <td><?php echo $client->tin; ?></td>
                        <td><?php echo $client->address; ?></td>
                        <td><?php echo $client->signatory; ?></td>
                    </tr>            
                    <?php endforeach; ?> 
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->            
          </div><!-- /.row -->          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include 'footer.php'; ?>