<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Coupon List
        </h1>

        <ol class="breadcrumb">
            <li>
            <h4><a href="<?php echo base_url(); ?>Coupon/add_coupon">Add Coupon</a></h4></li>
        </ol>


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
                                        <th style="text-align: center;">Coupon code</th> 
                                        <th style="text-align: center;">Percent off</th>        
                                        <th style="text-align: center;">User limit</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php   foreach($current_coupon as $row) { ?>
                                        <tr>
                                            <td style="text-align: center;">           
                                                 <?php echo $row['code'];  ?>
                                            </td>

                                            <td style="text-align: center;">
                                                <?php echo $row['percent_off']; ?>
                                            </td>

                                            <td style="text-align: center;">
                                                <?php echo $row['no_of_uses']; ?>
                                            </td>
                               
                                            <td style="text-align: center;"> 
                                                <div class="buttons">
                                                    <a href="<?php echo base_url(); ?>Coupon/edit_coupon/<?php echo $row['id']; ?>">
                                                        <button class="btn btn_delete">Edit</button>
                                                    </a>
                                                    <a href="<?php  echo base_url(); ?>Coupon/delete_coupon/<?php echo $row['id']; ?>">
                                                        <button class="btn btn_edit" >Delete</button>
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

