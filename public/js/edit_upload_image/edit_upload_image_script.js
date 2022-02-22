$(document).ready(function () {

        //--------------change upload image by clicking n image-----------------//
          $('#previewImg').on('click', function () {
           // alert("xxx");
           jQuery('#my_file').trigger('click');
         
         
           });
       //--------------change upload image by clicking on button-------------------//

           $('#btn_image').on('click', function () {
             jQuery('#my_file').trigger('click');
            });
           
    }); 
    //--------------------------------------------------------------------------


