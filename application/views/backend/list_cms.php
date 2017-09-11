<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Cms List
        </h1>

        <ol class="breadcrumb">
            <li>
            <h4><a href="<?php echo base_url(); ?>index.php/Cms/cms_data">Add cms</a></h4></li>
        </ol>

        <p class="login-box-msg" style="color:green;">
            <?php // echo $this->session->flashdata('success'); ?>
        </p>

        <p class="login-box-msg" style="color:green;">
            <?php // echo $this->session->flashdata('success1'); ?>
        </p>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">

                            <table class="table table-bordered table-striped" id="dataOne">
                                <thead>
                                    <tr style="">
                                        <th style="text-align: center;">Title</th> 
                                        <th style="text-align: center;">Content</th>        
                                        <th style="text-align: center;">Meta title</th>
                                        <th style="text-align: center;">Meta description</th> 
                                        <th style="text-align: center;">Meta keyword</th>        
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php   foreach($cms_data as $row) { ?>
                                        <tr>
                                            <td style="text-align: center;">           
                                                 <?php echo $row['title'];  ?>
                                            </td>

                                            <td style="text-align: center;">
                                                <?php echo substr($row['content'],0,30);?>
                                            </td>

                                            <td style="text-align: center;">
                                                <?php echo $row['meta_title']; ?>
                                            </td>

                                            <td style="text-align: center;">           
                                                 <?php echo $row['meta_description']; ?>
                                            </td>

                                            <td style="text-align: center;">           
                                                 <?php echo $row['meta_keywords']; ?>
                                            </td>

                                            <td style="text-align: center;"> 
                                                <div class="buttons">
                                                     <a href="<?php echo base_url(); ?>index.php/Cms/update_cms/<?php echo $row['id']; ?>">
                                                        <button class="btn btn_delete">Edit</button>
                                                    </a>
                                                </div>                                                          
                                            </td>

                                        </tr>

                                <?php    }     ?>

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
                $("#dataOne").DataTable();
                
            });
        </script>

<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {

        padding: 0px; 

    }
</style>

