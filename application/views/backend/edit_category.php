<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                 Edit Category
                </h1>
            </section>

            <div style="width: 75%">
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-8">
                            <!-- /.box -->
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">

                                    <form action="" method="post" id="add_category">

                                            <label>Enter category</label>
                                            <br></br>
                                            <div class="col-sm-12" style="width: 92%">
                                                <input name="category_name" id="category_name" type="text" 
                                                class="form-control  alphacapital"
                                                value="<?php echo $current_catg[0]['name'];?>" >
                                            </div>
                                            <br></br>
                                            <br></br>


                                            <div class="form-group" style="width: 88%">
                                                <label>Select parent category</label>
                                                <select name="role_type" class="form-control" multiple="">

                                                    <?php  foreach ($get_name as $pcat) {  ?>

                                                        <option value="<?php echo $pcat['id'];?>"
                                                        
                                                         <?php 
                                                            if( ($current_catg[0]['parent_id'])==($pcat['id']) )
                                                                {
                                                                echo "selected";
                                                                }
                                                          ?>
                                                        > 

                                                        <?php echo $pcat['name'];?>
                                                        </option><!-- option end tag -->
                                                    
                                                    <?php } ?>

                                                </select>
                                            </div>


                                            <div align="center">
                                                <button style="width:15%" type="submit" class="btn btn-block btn-primary">Submit</button>
                                            </div>

                                    </form>

                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <script src="<?php echo base_url(" jquery.validate.js ")?>"></script>

        <!-- page script -->
        <script>
            $(function() {
                $("#example1").DataTable();
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false
                });
            });
        </script>


        <script src="<?php echo base_url("jquery.validate.js")?>"></script>

            <script type="text/javascript">
              $("#add_category").validate({
                            rules: {

                                category_name: "required"

            }                
            });

            </script>

        <style type="text/css">
            #add_category label.error {
                color: red;
            }
        </style>
</body>