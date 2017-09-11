<div class="wrapper">
            <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
                <!-- Content Header (Page header) -->
        <section class="content-header">
            <h3>Configuration Listing</h3>
            <p class="login-box-msg" style="color:green;"><?php echo $this->session->flashdata('success'); ?></p>
        </section>
   
        <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">

                                    <table class="table table-bordered table-striped" id="data">
                                        <thead>
                                            <tr>
                                                <th style="" >Configuration key</th>
                                                <th style="">Configuration value</th>
                                            </tr>
                                        </thead>

                                        <tbody> 
                                        <?php
                                        foreach ($resultz as $row) {
                                        ?> 

                                        <tr>  
                                           <td><?php echo $row['conf_key']; ?></td>  
                                           <td><?php echo $row['conf_value']; ?></td>
                                                    
                                            <td>
                                                <div class="buttons">
                                                    <a href="<?php echo base_url(); ?>index.php/user/edit_configuration/<?php echo $row['id']; ?>">
                                                    <button class="btn btn_delete">Edit</button>
                                                    </a>
                                                </div>                              
                                            </td>
                                        </tr>

                                        <?php  } ?> 
                                        </tbody>
                                    </table> 
                               
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
</div>