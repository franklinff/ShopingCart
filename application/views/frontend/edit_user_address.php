<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                        Edit address
                    </h1>
                </section>

                <!--form-->
                <div class="container"> 
                    <div class="col-sm-4 col-sm-offset-1" >
                        <div class="login-form">
                                <!--login form-->
                                <h2>Modify Address</h2>  

                                <a href="http://localhost/project/index.php/Home/">list</a>

                                <form action="" method="post" id="address_form_edit">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address line 1</label>
                                        <input  type="text" class="form-control" id="addrssline1" name="address_1"
                                        value="<?php echo $pointing_address[0]['address_1'];?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address line 2</label>
                                        <input type="text" class="form-control" id="addrssline2" name="address_2"
                                        value="<?php echo $pointing_address[0]['address_2'];?>">                                        
                                    </div>

                                    <div class="form-group">
                                          <label for="sel1">Select Country:</label>
                                          <select class="form-control" id="country" name="country">
                                              <option value="0">--Select country--</option>
                                              <?php
                                              foreach ($countries as $ctry) {
                                               // foreach ($countries as $key => $ctry) {
                                               //$countries[$key]['name']
                                               //$ctry['name']
                                                 if($ctry['id'] == $pointing_address[0]['country'] )
                                                          {
                                                            $select_val="selected=selected";
                                                          }
                                                          else
                                                          {
                                                            $select_val="";
                                                          }            
                                                  ?>
                                                  <option value="<?php echo $ctry['id'] ?>" <?php echo $select_val; ?>><?php echo $ctry['name'] ?></option>

                                                <?php } ?>
                                          </select>
                                      </div>

                                      <div class="form-group">
                                          <label for="sel1">Select State:</label>
                                          <select class="form-control" id="state" name="state">
                                              <?php
                                              foreach ($statesxx as $state) {
                                                 if($state['id']== $pointing_address[0]['state'] ){
                                                         $select_val="selected=selected";
                                                          }else{
                                                              $select_val="";
                                                          }
                                                  ?>
                                                  <option value="<?php echo $state['id']?>" <?php echo $select_val; ?>><?php echo $state['name'] ?></option>
                                              <?php } ?>
                                          </select>
                                      </div>

                                        <div class="form-group">
                                            <label for="sel1">Select City:</label>
                                            <select class="form-control" id="city" name="city">
                                                <?php
                                                foreach ($cityxx as $city) {
                                                   if($city['id']== $pointing_address[0]['ct_id'] ){
                                                           $select_val="selected=selected";
                                                            }else{
                                                                $select_val="";
                                                            }
                                                
                                                    ?>
                                                <option value="<?php echo $city['state_id']?>" <?php echo $select_val; ?>><?php echo $city['name'] ?> </option>
                                                <?php } ?>
                                            </select>
                                          </div>

                                          <div class="form-group">
                                              <label for="exampleInputEmail1">Enter zip code</label>
                                              <input type="text" class="form-control" id="zip_code" name="zip_code"
                                              value="<?php echo $pointing_address[0]['zipcode'];?>">
                                          </div>

                                    <div align="center">
                                        <button style="width:30%" type="submit" class="btn btn-block btn-primary">Submit</button>
                                    </div></br>

                                </form>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                <!-- /.content -->
                </div>
        <!-- /.content-wrapper -->
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
        </div>
    </div>
</body>

<script src="<?php echo base_url("jquery.validate.js")?>"></script>

<script type="text/javascript">

  $("#address_form_edit").validate({

                  rules: {
                    address_1: {
                            required: true,
                           },
                    address_2: {
                            required: true,
                           },
                    country: {
                            required: true,
                           },
                    state: {
                            required: true,
                           },                                                   
                    city: {
                            required: true,
                           },
                    zip_code: {
                            required: true,
                           }                                                                               
                    },
                  messages: {
                      address_1: {
                                required: "Please enter address",
                          },
                      address_2: {
                                required: "Please enter address",
                        },
                      city: {
                                required: "Please select your city",
                          },
                      state: {
                                required: "Please provide your state",
                        },
                      country: {
                                required: "Please select your country",
                          },
                      zip_code: {
                                required: "Please provide the zip code",
                        }                      
                  }
   });
</script>

  <style type="text/css">
    #address_form_edit label.error{
      color: red;
    }
  </style>

  <script type="text/javascript">
    
  $(document).ready(function(){
    /*Get the country list */
      $.ajax({
        type: "GET",
        url: "<?php echo base_url(); ?>index.php/Home/get_countries",
        data:{id:$(this).val()}, 
        beforeSend :function(){
            $('.country').find("option:eq(0)").html("Please wait..");
        },                         
        success: function (data) {
          /*get response as json */
           $('.country').find("option:eq(0)").html("Select Country");
          var obj=jQuery.parseJSON(data);
          $(obj).each(function()
          {
           var option = $('<option />');
           option.attr('value', this.value).text(this.label);           
           $('.country').append(option);
         });  
          
          
        }
      });

    /*Get the state list */
    $('.country').change(function(){
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>index.php/Home/get_states",
        data:{id:$(this).val()}, 
        beforeSend :function(){
            $(".state option:gt(0)").remove(); 
            $(".citie option:gt(0)").remove(); 
            $('.state').find("option:eq(0)").html("Please wait..");
        },                         
        success: function (data) {
          /*get response as json */
           $('.state').find("option:eq(0)").html("Select State");
          var obj=jQuery.parseJSON(data);
          $(obj).each(function()
          {
           var option = $('<option />');
           option.attr('value', this.value).text(this.label);           
           $('.state').append(option);
         });  
          /*ends */
          
        }
      });
    });

    /*Get the city list */
    $('.state').change(function(){
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>index.php/Home/get_cities",
        data:{id:$(this).val()}, 
          beforeSend :function(){
            $(".city option:gt(0)").remove(); 
            $('.city').find("option:eq(0)").html("Please wait..");
                },
                success: function (data) {
                    /*get response as json */
                    $('.city').find("option:eq(0)").html("Select City");
                    var obj = jQuery.parseJSON(data);
                    $(obj).each(function ()
                    {
                        var option = $('<option />');
                        option.attr('value', this.value).text(this.label);
                        $('.city').append(option);
                    });

                }
            });
        });
    });
</script>








