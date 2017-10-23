<h1 class="xx">
           Edit Cms 
</h1>

<!-- <form action="<?php echo base_url(); ?>index.php/Cms/update_cms/" method="post" id="add_product" > -->
<form action="" method="post" id="update_cms" >


<?php  foreach ($individual_cms as $row) {  ?>

              <div >
                <label style="margin-left: 280px">Title</label>
                
                  <select multiple="" class="xx" name="role_type">  
                      <?php
                        foreach ($cms_da as $c) {
                          if($c['title'] == $individual_cms[0]['title'] )
                              {
                                $select_val="selected=selected";
                              }
                              else
                              {
                                $select_val="";
                              }
                      ?>
                      <option value="<?php echo $c['title']; ?>" <?php echo $select_val;?> >
                          <?php echo $c['title'];?> 
                      </option>

                      <?php 
                          }
                      ?>
                  </select>
              </div></br>


                <div class="box-bodypad">
                  <label>Content</label> <br> 
                        <textarea id="editor1" name="editor1" rows="10" cols="80" >
                                <?php echo $row['content'];?>
                        </textarea> 
                </div></br>


                <div class="xx">
                <label>Meta title</label>
                <br>
                <input name="meta_title" id="meta_title" type="text" class="form-control" value="<?php echo $row['meta_title'];?>"  >
                </div></br>


                <div class="xx" >
                <label>Meta description</label>
                <br>            
                <textarea name="long_description" id="long_description" class="form-control" rows="2"  >
                  <?php echo $row['meta_description'];?>
                </textarea>
                </div></br>


                <div class="xx">
                <label>Meta keywords</label>
                <br> 
                <input name="meta_keywords" id="meta_keywords"  type="text" class="form-control" value="<?php echo $row['meta_keywords'];?>" >
                </div></br>


                <div  align="center" >
                <button style="width:15%" type="submit" class="btn btn-block btn-primary">Submit</button>
                </div></br>
<?php  } ?>
</form>



<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor instance, using default configuration.
    CKEDITOR.replace('editor1');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
  });
</script>


<style type="text/css">
  .box-bodypad {
    margin-left: 280px;
    margin-right: 150px;
    margin-top: 15px;
  }

  .xx {
    margin-left: 280px;
    width: 850px;
    }
</style>