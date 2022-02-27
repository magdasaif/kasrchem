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
        }else{
            $('#btn_delete_all').prop('disabled', true);
        }
    }