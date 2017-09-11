<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            User Listing
        </h1>

        <ol class="breadcrumb">
                <li>
                    <h4><a href="<?php echo base_url(); ?>user/add_user">Add User</a></h4></li>
        </ol>

            <p class="login-box-msg" style="color:green;">
                <?php echo $this->session->flashdata('success'); ?>
            </p>
            <p class="login-box-msg" style="color:green;">
                <?php echo $this->session->flashdata('success1'); ?>
            </p>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">

                            <table class="table table-bordered table-striped" id="dataOn">
                                <thead>
                                    <tr>
                                        <th style="">First Name</th>
                                        <th style="">Last Name</th>
                                        <th style="">Email</th>
                                        <th style="">Role Type</th>
                                        <th style="">Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    foreach ($result as $row) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['firstname']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['lastname']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['email']; ?>
                                            </td>

                                            <td>
                                                <?php 
                                                    echo $row['role_name'];
                                               ?> 
                                            </td>
                                            
                                            <td>
                                                <span class="label label-success"><?php
                                                            if ($row['status'] == 1) {
                                                                echo "Active";
                                                            } else {
                                                                echo "Inactive";
                                                            }
                                                            ?>                                                 
                                                </span>
                                            </td>
                                            
                                            <td>
                                                <div class="buttons">
                                                    <a href="<?php echo base_url(); ?>index.php/user/delete_user/<?php echo $row['id']; ?>">
                                                        <button class="btn btn_edit" id="btn_edit" value="">Delete</button>
                                                    </a>

                                                    <a href="<?php echo base_url(); ?>index.php/user/edit/<?php echo $row['id']; ?>">
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
                $("#dataOn").DataTable();
                
            });
        </script>