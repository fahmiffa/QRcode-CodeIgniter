
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Create qrcode CodeIgniter</title>   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> 
   <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

   <style type="text/css">
     body {
      font-family: 'Lato', sans-serif;
      background-color: #f5f5f5;
    }
    .nduwur 
    {
      padding-top: 50px;
    }
   </style>
  </head>

  <body>   
 <div class="container">
  <div class="nduwur text-center">
    <a href="<?php echo site_url();?>" style="text-decoration: none"><p class="h2 font-weight-bold">Create qrcode CodeIgniter</p></a>
    <div class="lead"></div>
  </div>
  <hr width="50%">
  
  <div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
      <?php echo $info = $this->session->flashdata('info');
        echo form_open('welcome/generate',' id="form"');?>
      <div class="form-group">
        <label for="email">Enter Id generate Qrcode:</label>
        <input type="text" class="form-control" id="code" name="code">
      </div>
      <button type="submit" class="btn btn-primary float-right">Generate</button>
    </form>
      
    </div>
    <div class="col-sm-4"></div>
  </div>
 </div>
<br>
 <div id="konf"></div>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>  
 <script type="text/javascript">

    //input form
    $('#form').submit(function(e){
        e.preventDefault();
        
         var formData = new FormData($("#form")[0]);                 
        
         $.ajax({
           url: $("#form").attr('action'),
           type: 'post' ,
           data: formData,
           dataType: 'json',
           contentType : false,
           processData : false,
           success: function(response) {
             if(response.success === true) {

               $('.form-group').removeClass('has-error')
                               .removeClass('has-success');
               $('.text-danger').remove();
               $("#form")[0].reset();

              if(typeof(response.redirect) !== 'undefined')
              {
                document.location.href = response.redirect;
              }            
             else if(typeof(response.info) !== 'undefined')
              {
                $("#konf").html(response.info);
              }  

             } else {
               $.each(response.messages,function(key, value){
                 var element = $('#' + key);
                 element.closest('div.form-group')
                 .removeClass('has-error')
                 .addClass(value.length > 0 ? 'has-error' : 'has-success')
                 .find('.text-danger')
                 .remove();
                 element.after(value);
               });
             }
           }
        });
    });

    </script>

  </body>
</html>
