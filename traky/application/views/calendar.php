<?php include 'header.php'; ?>

    <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="<?php echo DIR_TRAKY; ?>welcome/">
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
            <li class="active treeview">
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
            Calendar
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Calendar</li>
          </ol>
        </section>
        
         <div class="example-modal" 
                    <?php  if($this->session->flashdata('error') === TRUE):
                        echo 'style="display:block;"';
                    else:
                        echo 'style="display:none;"';
                    endif;
            ?>>
                <div class="modal modal-danger">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Calendar Error</h4>
                      </div>
                      <div class="modal-body">
                        <p><?php echo $this->session->flashdata('error_message'); ?></p>
                      </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default close" data-dismiss="modal">Close</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
              </div><!-- /.example-modal -->

        <!-- Main content -->
        <section class="content">
          <div class="row">            
            <div class="col-md-3">
              
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Create Event</h3>
                </div>
                  <form action="<?php echo DIR_TRAKY; ?>calendar/add_event/" method="post">
                <div class="box-body">
                  <div class="btn-group" style="width: 100%; margin-bottom: 10px;"> 
                    <ul class="fc-color-picker" id="color-chooser">
                      <li><a class="cal-1" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="cal-2" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="cal-3" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="cal-4" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="cal-5" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="cal-6" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="cal-7" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="cal-8" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="cal-9" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="cal-10" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="cal-11" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="cal-12" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="cal-13" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="cal-14" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="cal-15" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="cal-16" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="cal-17" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="cal-18" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="cal-19" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="cal-20" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="cal-21" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="cal-22" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="cal-23" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                    </ul>
                  </div><!-- /btn-group -->
                  
                  <div class="form-group">
                      <input type="text" class="form-control" name="title" id="title" placeholder="Title"/>
                      
                      <div class="checkbox">
                          <label><input type="checkbox" name="allday" id="all-day" value="true"/>All Day?</label>
                      </div>
                      
                    <div class="input-group">
                        <input id="start-date" name="start-date" type="text" class="form-control input-small" placeholder="Start Date">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>     
                      <div class="input-group not-all-day">
                        <input id="end-date" name="end-date" type="text" class="form-control input-small" placeholder="End Date">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div> 
                    <div class="input-group bootstrap-timepicker timepicker not-all-day">
                        <input id="start-time" name="start-time" type="text" class="form-control input-small" placeholder="Start Time">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                    </div>
                    <div class="input-group bootstrap-timepicker timepicker not-all-day">
                        <input id="end-time" name="end-time" type="text" class="form-control input-small" placeholder="End Time">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                    </div>
                  
                      <div class="checkbox">
                          <label><input type="checkbox" name="repeats" id="repeats" value="true"/>Repeat?</label>
                      </div>
                  </div>
                  <div id="repeat-options" class="form-group" >
                      <label>Repeat every:</label>
                      <div class="checkbox">
                          <label><input type="radio" value="1" name="repeat-freq" align="bottom">day</label>
                      </div>  
                      <div class="checkbox">
                          <label><input type="radio" value="7" name="repeat-freq" align="bottom">week</label>
                      </div>
                      <div class="checkbox">
                          <label><input type="radio" value="14" name="repeat-freq" align="bottom">two weeks</label>
                      </div>
                      <!--<div class="checkbox">
                          <label><input type="radio" value="30" name="repeat-freq" align="bottom">monthly</label>
                      </div>-->
                      <div class="checkbox">
                          <label><input type="radio" value="366" name="repeat-freq" align="bottom">yearly</label>
                      </div>
                          
                    </div>
                  
                    <div class="box-footer">
                        <input type="hidden" name="color" value="" id="event-color">
                      <button id="add-new-event" type="submit" class="btn btn-info pull-right">Add</button>
                    </div><!-- /btn-group -->
                    
                </div>
                  </form>
              </div>
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-body no-padding">
                  <!-- THE CALENDAR -->
                  <div id="bir-due-dates"></div>
                  <!--<iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=9lmtvjdovqnbthne3849bd0efs%40group.calendar.google.com&amp;color=%23333333&amp;ctz=Asia%2FManila" style="border-width:0" width="100%" height="600" frameborder="0" scrolling="no"></iframe>-->
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include 'footer.php';
//jzeacctg.yaxien@gmail.com
?>