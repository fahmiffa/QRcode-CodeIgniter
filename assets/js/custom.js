var datau = $('.tabel').attr("id");            
var dataTable = $('.tabel').DataTable({             
     "ajax":{  
          url:datau,
          type:"POST"             
     }  
});     

//delete  
  $(document).on("click",".del",function(e) {
           var id = $(this).attr("id");            
           e.preventDefault();
           bootbox.confirm("Are you sure delete ?", function(result) {
               if (result) {

                     $.ajax({  
                     url:"siswa/delete",  
                     method:"POST",  
                     data:{Id:id},  
                     success:function(data)  
                     {                                                      
                          location.reload();
                     }  
                });

               }   
           });
       });

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