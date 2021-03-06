<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Product List
        </h1>

        <ol class="breadcrumb">
            <li>
            <h4><a href="<?php echo base_url(); ?>Product/addProduct">Add product</a></h4></li>
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
                                        <th style="text-align: center;">Product</th> 
                                        <th style="text-align: center;">SKU</th>        
                                        <th style="text-align: center;">Short desc.</th>
                                        <th style="text-align: center;">Price</th> 
                                        <th style="text-align: center;">Qty.</th>        
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php   foreach($products as $row) { ?>
                                        <tr>
                                            <td style="text-align: center;">           
                                                 <?php echo $row['name'];  ?>
                                            </td>

                                            <td style="text-align: center;">
                                                <?php echo $row['sku']; ?>
                                            </td>

                                            <td style="text-align: center;">
                                                <?php echo $row['short_description']; ?>
                                            </td>

                                            <td style="text-align: center;">           
                                                 <?php echo $row['price']; ?>
                                            </td>

                                            <td style="text-align: center;">           
                                                 <?php echo $row['quantity']; ?>
                                            </td>

                                            <td style="text-align: center;">           
                                                 <?php echo $row['status']; ?>
                                            </td>

                                            <td style="text-align: center;"> 
                                                <div class="buttons">
                                                     <a href="<?php echo base_url(); ?>Product/editProduct/<?php echo $row['id']; ?>">
                                                        <button class="btn btn_delete">Edit</button>
                                                    </a>
                                                    <a href="<?php  echo base_url(); ?>Product/deleteProduct/<?php echo $row['id']; ?>">
                                                        <button class="btn btn_edit" id="btn_edit" value="">Delete</button>
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

