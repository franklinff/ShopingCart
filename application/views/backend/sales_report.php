<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <?php
        if ($this->session->flashdata('success')) {
            echo "<span style='color:green'>" . $this->session->flashdata('success') . "</span><br>";
        }
        ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                   <!-- 
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">

                           
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Change the order status</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo base_url(); ?>admin/orders/update_order_status" method="post" class="searchform">
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
 -->
                    <div class="box-header">
                        <h3 class="box-title">Sales Reports</h3>
                    </div>

                    <div class="box-body">
                        <table class="table table-bordered table-striped" id="myTable">
                            <thead>
                                <tr>
                                    <th class="">Serial No.</th>
                                    <th class="">Date</th>
                                    <th class="">Amount</th>
                                    <th class="">No of sales</th>
                                </tr>
                            <thead>
                            <tbody>    
                                <?php
                                if (!empty($sales_reports)) {
                                    $i = 1;
                                    foreach ($sales_reports as $value) {
                                        ?>
                                        <tr>
                                            <td class=""><?php echo $i; ?></td>
                                            <td class=""><?php echo $value['created_date']; ?></td>
                                            <td class=""><?php echo $value['grand_total']; ?></td>
                                            <td class=""><?php echo $value['no_of_sales']; ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <!-- interactive chart -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <i class="fa fa-bar-chart-o"></i>

                            <h3 class="box-title">Sales Reports</h3>

                        </div>
                        <div class="box-body">
                            <div id="interactive" style="height: 300px;"></div>
                        </div>
                        <!-- /.box-body-->
                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.col -->
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>




<script>
    $(document).ready(function () {
        $('#myTable').DataTable();

        var data = [
            {data:<?php echo $arr_sales ?>, }
        ], totalPoints = 30;
       
        var interactive_plot = $.plot("#interactive", data, {
            grid: {
                borderColor: "#f3f3f3",
                borderWidth: 1,
                tickColor: "#f3f3f3"
            },
            series: {
                shadowSize: 0, // Drawing is faster without shadows
                color: "#3c8dbc"
            },
            lines: {
                fill: true, //Converts the line chart to area chart
                color: "#3c8dbc"
            },
            yaxis: {
                min: 0,
                max: 50,
                show: true
            },
            xaxis: {
                show: true
            }
        });

        var updateInterval = 500; //Fetch data ever x milliseconds
        var realtime = "on"; //If == to on then fetch data every x seconds. else stop fetching
        function update() {

            interactive_plot.setData(data);

            // Since the axes don't change, we don't need to call plot.setupGrid()
            interactive_plot.draw();
            if (realtime === "on")
                setTimeout(update, updateInterval);
        }

        //INITIALIZE REALTIME DATA FETCHING
        if (realtime === "on") {
            update();
        }
        //REALTIME TOGGLE
        $("#realtime .btn").click(function () {
            if ($(this).data("toggle") === "on") {
                realtime = "on";
            } else {
                realtime = "off";
            }
            update();
        });
        /*
         * END INTERACTIVE CHART
         */

    });

    function getId(id) {
        $('#con_id').val(id);
        console.log(id);
    }

</script>



<!-- FLOT CHARTS -->
<script src="<?php echo base_url("application/admin/plugins/flot/jquery.flot.min.js")?>"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?php echo base_url("application/admin/plugins/flot/jquery.flot.resize.min.js")?>"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="<?php echo base_url("application/admin/plugins/flot/jquery.flot.pie.min.js")?>"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="<?php echo base_url("application/admin/plugins/flot/jquery.flot.categories.min.js")?>"></script>
<script src="<?php echo base_url("application/admin/plugins/flot/morris.min.js")?>"></script>