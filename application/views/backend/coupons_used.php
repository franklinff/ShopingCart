<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <?php 
                if($this->session->flashdata('success')){
                    echo "<span style='color:green'>".$this->session->flashdata('success')."</span><br>";
                }
            ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Change the order status</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo base_url(); ?>admin/orders/updateOrderStatus" method="post" class="searchform">
                                        <input type="radio" name="status" value="P"> Pending<br>
                                        <input type="radio" name="status" value="O"> Processing<br>
                                        <input type="radio" name="status" value="S"> Shipped<br>
                                        <input type="radio" name="status" value="D"> Delivered<br><br>
                                        <input type="hidden" name="id" value="" id="con_id">       
                                        <button type="submit" class="btn btn-default">Submit</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="box-header">
                        <h3 class="box-title">Coupons Used</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th class="">Coupons</th>
                                    <th class="">Percent off</th>
                                    <th class="">Customer Name</th>
                                    <th class="">Email</th>
                                </tr>
                            <thead>
                            <tbody>    
                                <?php
                                if (!empty($coupons)) {
                                    foreach ($coupons as $value) {
                                        ?>
                                        <tr>
                                            <td class=""><?php echo $value['code']; ?></td>
                                            <td class=""><?php echo $value['percent_off']; ?> %</td>
                                            <td class=""><?php echo $value['firstname'] . ' ' . $value['lastname']; ?></td>
                                            <td class=""><?php echo $value['email']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>


<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });

    function getId(id) {
        $('#con_id').val(id);
        console.log(id);
    }
</script>

