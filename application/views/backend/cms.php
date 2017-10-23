
<form action="cmsData" method="post" id="add_product" >
</br>

                <div class="xx" style="width:50%">
                  <label>Title</label>
                  <input name="role_type" id="role_type" placeholder="Cms title" type="text" class="form-control alphacapital" >
                </div>

    		        <div class="box-bodypad">
    		        	<label>Content</label>
    		                <textarea id="editor1" name="editor1" rows="10" cols="80">    
    		                </textarea>
    		        </div></br>
    		          

          		  <div class="xx">
                <label>Meta title</label>
                <br>
                <input name="meta_title" id="meta_title" placeholder="Meta title" type="text" class="form-control" >
                </div>
                </br>


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





<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>


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






<!-- 
<script>
$(document).ready(function(){

$("#frmSubscription").validate({    
    rules:{
      status:{
        required:true,
        digits: true
      }
    },

    messages:{
      name:{
        remote: 'This subscription number already exists'
      },
    }
  });

});
</script> -->