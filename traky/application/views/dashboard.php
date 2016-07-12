<?php include 'header.php'; ?>
          
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
              <a href=<?php echo DIR_TRAKY; ?>welcome/">
                <i class="fa fa-dashboard"></i><span>Dashboard</span></i>
              </a>
            </li>
			<li class="treeview">
              <a href="<?php echo DIR_TRAKY; ?>client/">
                <i class="fa fa-users"></i><span>Clients</span></i>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo DIR_TRAKY; ?>tax_types/">
                <i class="fa fa-files-o "></i><span>Tax Types</span></i>
              </a>
            </li> 
            <li class="treeview">
              <a href="<?php echo DIR_TRAKY; ?>calendar/">
                <i class="fa fa-calendar "></i><span>Calendar</span></i>
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
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">            
            <div class="col-lg-6 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $not_filed_yet['count']; ?></h3>
                  <p>Not yet filed</p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-compass"></i>
                </div>
                <?php foreach($not_filed_yet['clients'] as $key => $not_filed): 
                        foreach($not_filed as $omg => $lacking): ?>
                            <a href="<?php echo DIR_TRAKY.'client/view_client/'.$lacking['client_id']; ?>" class="small-box-footer">
                                <?php echo '<strong>'.$key.'</strong> - <i>'.$lacking['business_name'].'</i>'; ?>
                                <i class="fa fa-arrow-circle-right"></i></a>
                <?php   endforeach;
                    endforeach; ?>
              </div>
            </div><!-- ./col -->
            
            
            <div class="col-lg-5 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $upDeadline_count; ?></h3>
                  <p>Upcoming Deadline</p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-document"></i>
                </div>
                <?php foreach ($to_be_filed as $filed): ?>
                    <a href="<?php echo DIR_TRAKY.'tax_types/view_all_clients/'.$filed->tax_type_id; ?>" class="small-box-footer"> 
                        <?php echo $filed->tax_type_form; ?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                <?php endforeach; ?>
              </div>
            </div><!-- ./col -->
            
          </div><!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">  
              <!-- TO DO List -->
              <div class="box box-primary">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title">To Do List</h3>
                  <div class="box-tools pull-right">
                    <ul class="pagination pagination-sm inline">
                      <li><a href="#">&laquo;</a></li>
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">&raquo;</a></li>
                    </ul>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="todo-list">
                    <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                      <input type="checkbox" value="" name="">
                      <!-- todo text -->
                      <span class="text">Design a nice theme</span>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i>
                      </div>
                    </li>
                    <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <input type="checkbox" value="" name="">
                      <span class="text">Make the theme responsive</span>
                      <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                      <div class="tools">
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i>
                      </div>
                    </li>
                    <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <input type="checkbox" value="" name="">
                      <span class="text">Let theme shine like a star</span>
                      <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                      <div class="tools">
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i>
                      </div>
                    </li>
                    <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <input type="checkbox" value="" name="">
                      <span class="text">Let theme shine like a star</span>
                      <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                      <div class="tools">
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i>
                      </div>
                    </li>
                    <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <input type="checkbox" value="" name="">
                      <span class="text">Check your messages and notifications</span>
                      <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                      <div class="tools">
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i>
                      </div>
                    </li>
                    <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <input type="checkbox" value="" name="">
                      <span class="text">Let theme shine like a star</span>
                      <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                      <div class="tools">
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i>
                      </div>
                    </li>
                  </ul>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                  <button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
                </div>
              </div><!-- /.box -->


            </section><!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">
              <!-- Calendar -->
              <div class="box box-solid bg-green-gradient">
                <div class="box-header">
                  <i class="fa fa-calendar"></i>
                  <h3 class="box-title">Calendar</h3>                 
                </div><!-- /.box-header -->
                <div class="box-footer text-black">
                  <!--The calendar -->
                  <div id="calendar-dashboard" style="width: 100%">
                      <ul class="nav nav-stacked">
                        <?php foreach($events as $event): ?>
                          <li><b><?php echo $event->title; ?> </b>
                              <span class="pull-right badge" style="background-color: <?php echo $event->color; ?>">
                                  <?php echo date('F d Y', strtotime($event->start)); ?>
                              </span>
                          </li>
                        <?php endforeach; ?>
                      </ul>
                  </div>
                </div><!-- /.box-body -->
               
              </div><!-- /.box -->
		
            </section><!-- right col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
<?php include 'footer.php'; ?>