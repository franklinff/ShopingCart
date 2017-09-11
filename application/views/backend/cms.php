<form action="cms_data" method="post" id="add_product" >

                <div class="xx" style="width:50%">
                  <label>Title</label>
                  <select multiple="" class="form-control" name="role_type">
                    <option value="Company Information">Company Information</option>
                    <option value="Terms of Use">Terms of Use</option>
                    <option value="Privacy Policy">Privacy Policy</option>
                    <option value="Refund Policy">Refund Policy</option>
                    <option value="Copyright">Copyright</option>
                  </select>
                </div>

				<!-- /.box-header -->
		        <div class="box-bodypad">
		        	<label>Content</label>
		            <!-- <form> -->
		                <textarea id="editor1" name="editor1" rows="10" cols="80">
		                        <!-- This is my textarea to be replaced with CKEditor. -->
		                </textarea>
		           <!--  </form> -->
		        </div></br>
		          <!-- /.box -->


          		<div class="xx">
                <label>Meta title</label>
                <br>
                <input name="meta_title" id="meta_title" placeholder="Meta title" type="text" class="form-control" >
                </div></br>


                <div class="xx" >
                <label>Meta description</label>
                <br>            
                <textarea name="long_description" id="long_description" class="form-control" rows="3"  placeholder="Meta description"></textarea>
                </div></br>


                <div class="xx">
                <label>Meta keywords</label>
                <br> 
                <input name="meta_keywords" id="meta_keywords" placeholder="Meta keywords" type="text" class="form-control" >
                </div></br>

                <div  align="center" >
                <button style="width:15%" type="submit" class="btn btn-block btn-primary">Submit</button>
                </div></br>
</form>



<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
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