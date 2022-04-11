$(function() {
    $("#btn_delete_all").click(function() {
        var selected = new Array();
        $("#datatable input[type=checkbox]:checked").each(function() {
            selected.push(this.value);
        });
       // alert(selected);
        if (selected.length > 0) {
            $('#delete_all').modal('show')
            $('input[id="delete_all_id"]').val(selected);
        }
    });
});

 function checkAll(name,elem){
    var checkboxes = document.getElementsByClassName(name);
    var leng = checkboxes.length;
    
    if(elem.checked){
        for(var i=0 ; i < leng ; i++){
            checkboxes[i].checked = true;
            $('#btn_delete_all').prop('disabled', false);
         }
    }else{
        for(var i=0 ; i < leng ; i++){
            checkboxes[i].checked = false;
            $('#btn_delete_all').prop('disabled', true);
         }
    }
}

function check(){
    var num = new Array();
    $("#datatable input[type=checkbox]:checked").each(function() {
        num.push(this.value);
      
    });
    if (num.length > 0) {
        $('#btn_delete_all').prop('disabled', false);
    //toggledeleteAllBtn();
    }else{
        $('#btn_delete_all').prop('disabled', true);
     // toggledeleteAllBtn();
    }
}

$(document).on('change','input[name="row_checkbox"]', function()
{
   if( $('input[name="row_checkbox"]').length == $('input[name="row_checkbox"]:checked').length )
    {
     
       $('input[name="select_all"]').prop('checked', true);
    
    }
   else
    {
        $('input[name="select_all"]').prop('checked', false);
       // toggledeleteAllBtn()
     }
 });

//  function toggledeleteAllBtn(){
//     if( $('input[name="row_checkbox"]:checked').length > 0 ){
//         $('#btn_delete_all').text('حذف المُحدد ('+$('input[name="row_checkbox"]:checked').length+')').prop('disabled', false);
//     }
//     if( $('input[name="select_all"]:checked')){
//         $('#btn_delete_all').text('حذف المُحدد ('+$('input[name="row_checkbox"]:checked').length+')').prop('disabled', false);
//     }
//     else{
//        // $('button#btn_delete_all').addClass('d-none');
//         $('#btn_delete_all').text('حذف المُحدد ').prop('disabled', true);;


//     }
// }