<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Banner Listing
        </h1>

        <ol class="breadcrumb">
            <li>
            <h4><a href="<?php echo base_url(); ?>index.php/Banner/uploadImage">Add banner</a></h4></li>
        </ol>

        <p class="login-box-msg" style="color:green;">
            <?php  echo $this->session->flashdata('success'); ?>
        </p>
        <p class="login-box-msg" style="color:green;">
            <?php  echo $this->session->flashdata('success1'); ?>
        </p>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">

                            <table class="table table-bordered table-striped" id="data">
                                <thead>
                                    <tr style="">
                                        <th style="text-align: center;">Banner</th>
                                        <th style="text-align: center;">Banner Name</th>
                                         <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        foreach ($result as $row) {
                                    ?>
                                        <tr>

                                            <td style="text-align: center;">           
                                                <img src="<?php echo base_url(); ?>uploads/<?php echo $row["banner_path"];?>" style="width:160px">
                                            </td>

                                            <td style="text-align: center;">
                                                <?php  echo $row['banner_path']; ?>
                                            </td>

                                            <td style="text-align: center;">
                                                <?php  $row['status'];
                                                if (($row['status'])== 1){
                                                   echo "Active";
                                                }
                                                else{
                                                    echo "Inactive";
                                                }
                                                ?>
                                            </td>

                                            <td style="text-align: center;">
                                                <div class="buttons">
                                                    <a href="<?php echo base_url(); ?>index.php/banner/deleteBanner/<?php echo $row['id']; ?>">
                                                        <button class="btn btn_edit" id="btn_edit" value="">Delete</button>
                                                    </a>

                                                    <a href="<?php echo base_url(); ?>index.php/banner/editBanner/<?php echo $row['id']; ?>">
                                                        <button class="btn btn_delete">Edit</button>
                                                    </a>
                                                </div>
                                            </td>

                                        </tr>

                                    <?php
                                         }
                                    ?>
                                </tbody>
                            </table>

                            <br>

                        </div>
                    </div>
                    <!-- /.content -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>

 <!-- page script -->
        <script>
            $(function() {
                $("#data").DataTable();
                
            });
        </script>