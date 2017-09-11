<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            User query
        </h1>
<!-- 
        <ol class="breadcrumb">
                <li>
                    <h4><a href="<?php echo base_url(); ?>index.php/user/add_user">Add User</a></h4></li>
        </ol> -->

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
                                        <th style="">Name</th>
                                        <th style="">Email</th>
                                        <th style="">Contact no.</th>
                                        <th style="">Subject</th>
                                        <th style="">Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    foreach ($result as $row) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['email']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['contact_no']; ?>
                                            </td>

                                            <td>
                                                <?php echo $row['subject']; ?>
                                            </td>

                                             <td>
                                                <?php echo $row['message']; ?>                             
                                            </td>
                                            
                                            <td>
                                                <div class="buttons">
                                                    <a href="<?php echo base_url(); ?>index.php/Contact_us_admin/reply_to_query/<?php echo $row['id']; ?>">
                                                        <button class="btn btn_delete">Reply</button>
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