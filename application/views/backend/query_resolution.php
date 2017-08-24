<div>
<form action="<?php echo base_url();?>index.php/Contact_us_admin/data_submit" method="post">

                    <div class="query">
                    <input type="hidden" name="reply_id" value="<?php echo $id; ?>">

                        <input type="text" name="name" class="form-control" required="required" placeholder="Please enter a resolution to the query" style="text-transform:capitalize;  width:75%;height:120px;background-color:gold; font:20px/22px sans-serif; ">
                    </div>

                    </br>
                    <button class="query1" type="submit" style="background-color:yellowgreen;color:white;padding:5px;font-size:18px;border:none;padding:8px;">Sent reply</button>
                    </br>
</form>
</div>


<style type="text/css">
  .query{margin-left: 437px;
    margin-top: 50px;
  }

  .query1{
    margin-left: 700px;
  }
</style>


