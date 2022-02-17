 //---------------for show seelct option of sub2------------------------//
 $(document).ready(function () {
    $('select[name="section_id"]').on('change', function () {
    // alert('ssss');
    var section_id = $(this).val();
         //alert(section_id);
        // alert("{{ URL::to('fetch_sub1')}}/" + section_id);

        $.ajax({
            type: "GET",
           // url: "{{ URL::to('fetch_sub1')}}/" + section_id,
            url: "../../fetch_sub1/" + section_id,
            dataType: "json",
            success: function (data)
            {
                if(data!='')
                { //لو فى تصنيف رئيسى للقسم هيعرضه

                    //هيخفى ويفضى اى حاجه تحته
                    $("#sub1_requi").hide();
                    $('#main_category_id').empty();

                    $('select[name="main_category"]').show();

                    $("#sub2_requi").hide();
                        $('#sub2_sel').empty();
                        $('#sub2_sel').show();

                        $("#sub3_requi").hide();
                        $('#sub3_sel').empty();
                        $('#sub3_sel').show();

                        $("#sub4_requi").hide();
                        $('#sub4_sel').empty();
                        $('#sub4_sel').show();

                    $('#main_category_id').append('<option value="" disabled="true" selected="true">اختر التصنيف الرئيسى</option>');
                    $.each(data, function (key, value) {
                        //alert('<option value="' + key + '">' + value + '</option>');
                    $('#main_category_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
                else
                {
                    // alert("لا يوجـد تصنيف رئيسى للقسم المختار من فضلك قم باضافته اولا");


                    $('select[name="main_category"]').hide();//hide select
                    $("#sub1_requi").show();//show div if sub1not founded

                    $("#sub2_requi").hide();
                        $('#sub2_sel').empty();
                        $('#sub2_sel').show();

                        $("#sub3_requi").hide();
                        $('#sub3_sel').empty();
                        $('#sub3_sel').show();

                        $("#sub4_requi").hide();
                        $('#sub4_sel').empty();
                        $('#sub4_sel').show();



                        //-------------get name of section--------------//
                            document.getElementById("section_id").value=section_id;
                            //  alert($( "#main_category_id option:selected" ).text()); //بيجيب قيمة الاوبشن المختارة
                             document.getElementById("new_main_name").value=$("#section_sel option:selected" ).text();
                        //----------------------------//
                }

            },
            error:function()
            { alert("false"); }
        });
});
//---------------------to get value if not making change in select------------------------
//save section id value to return back with it
var section_id = $('select[name="section_id"]').val();
//alert(section_id);
document.getElementById("section_id").value=section_id;
document.getElementById("section_id1").value=section_id;
document.getElementById("section_id2").value=section_id;
document.getElementById("section_id22").value=section_id;
document.getElementById("section_id222").value=section_id;
//alert(document.getElementById("section_id222").value);
//alert(section_id);

//save main category id value to return back with it
var cate_id = $('select[name="main_category"]').val();
document.getElementById("cate_id").value=cate_id;
document.getElementById("cate_id2").value=cate_id;
document.getElementById("cate_id22").value=cate_id;
document.getElementById("cate_id222").value=cate_id;
// alert(cate_id);


var sub2_id = $('select[name="sub2"]').val();
document.getElementById("sub2_id").value=sub2_id;
document.getElementById("sub2_id2").value=sub2_id;
document.getElementById("sub2_id22").value=sub2_id;



var sub3_id = $('select[name="sub3"]').val();
document.getElementById("sub3_id").value=sub3_id;
document.getElementById("sub3_id2").value=sub3_id;


var sub4_id = $('select[name="sub4"]').val();
document.getElementById("sub4_id").value=sub4_id;


//read value of selected sub category
document.getElementById("new_main_name").value=$("#section_sel option:selected" ).text();
document.getElementById("test").value=$("#main_category_id option:selected" ).text();
document.getElementById("sub2_name").value=$("#sub2_sel option:selected" ).text();
document.getElementById("sub3_name").value=$("#sub3_sel option:selected" ).text();

if($("#sub1_requi").css('display')=='block'){

$("#sub2_requi").hide();
$('#sub2_sel').empty();
$('#sub2_sel').show();

$("#sub3_requi").hide();
$('#sub3_sel').empty();
$('#sub3_sel').show();

$("#sub4_requi").hide();
$('#sub4_sel').empty();
$('#sub4_sel').show();
}

if($("#sub2_requi").css('display')=='block'){
$("#sub3_requi").hide();
$('#sub3_sel').empty();
$('#sub3_sel').show();

$("#sub4_requi").hide();
$('#sub4_sel').empty();
$('#sub4_sel').show();
}

if($("#sub3_requi").css('display')=='block'){
$("#sub4_requi").hide();
$('#sub4_sel').empty();
$('#sub4_sel').show();
}


//-----------------------------------------------------------------
        $('select[name="main_category"]').on('change', function () {
            var main_category_id = $(this).val();
            var section_id = $('select[name="section_id"]').val();

        // alert(main_category_id);
         // alert($( "#main_category_id option:selected" ).text());
          if (main_category_id=='')
         {
            $("#main_error").show();

         }else
         {
           if (main_category_id ) {
             // alert("{{ URL::to('fetch_sub2')}}/" + main_category_id);

                $.ajax({
                    type: "GET",
                  //  url: "{{ URL::to('fetch_sub2')}}/" + main_category_id,
                    url: "../../fetch_sub2/" + main_category_id,
                    dataType: "json",

                    success: function (data)
                    {
                        //alert("true");
                        // $("#all").show();
                        // $("#sub2_div").show();

                       // alert("data="+data) ;
                       // alert(main_category_id);
                        $('select[name="sub2"]').empty();
                         //--------------------------------------------//
                         if(data!='')
                        {
                            $('select[name="sub2"]').show();
                            $("#sub2_requi").hide();

                            //هيخفى ويفضى اى حاجه تحته

                            $("#sub3_requi").hide();
                            $('#sub3_sel').empty();
                            $('#sub3_sel').show();

                            $("#sub4_requi").hide();
                            $('#sub4_sel').empty();
                            $('#sub4_sel').show();

                            $('select[name="sub2"]').append('<option value="" disabled="true" selected="true">اختر التصنيف الفرعي</option>');
                            $.each(data, function (key, value)
                            {
                               $('select[name="sub2"]').append('<option value="' + key + '">' + value + '</option>');
                            });

                        }
                        else
                        {
                           // alert("لا يوجـد تصنيف فرعى للتصنيف الرئيسي المختار من فضلك قم باضافته اولا");
                            $('select[name="sub2"]').hide();//hide select
                             $("#sub2_requi").show();//show div if sub2not founded

                            //هيخفى ويفضى اى حاجه تحته

                            $("#sub3_requi").hide();
                            $('#sub3_sel').empty();
                            $('#sub3_sel').show();

                            $("#sub4_requi").hide();
                            $('#sub4_sel').empty();
                            $('#sub4_sel').show();

                                //-------------get name of main_category--------------//
                                   document.getElementById("section_id1").value=section_id;
                                   document.getElementById("cate_id").value=main_category_id;
                                   //  alert($( "#main_category_id option:selected" ).text()); //بيجيب قيمة الاوبشن المختارة
                                    document.getElementById("test").value=$("#main_category_id option:selected" ).text();
                                //----------------------------//



                        }
                     //--------------------------------------------//
                    },
                    error:function()
                    { alert("false"); }
                });

            }
            else {
                alert('AJAX load did not work');
            }

        }
        });


     //---------------for show seelct option of sub3------------------------//

        $('select[name="sub2"]').on('change', function () {
            var sub2_id = $(this).val();
            var section_id = $('select[name="section_id"]').val();
            var cate_id = $('select[name="main_category"]').val();


           // alert(sub2_id);
           if (sub2_id) {

                $.ajax({
                    type: "GET",
                   // url: "{{ URL::to('fetch_sub3')}}/" + sub2_id,
                    url: "../../fetch_sub3/" + sub2_id,
                    dataType: "json",

                    success: function (data)
                    {
                         //alert("true");
                      // $("#sub3_div").show();
                         $('select[name="sub3"]').empty();
                         //--------------------------------------------//
                         if(data!='')
                        {
                            $('select[name="sub3"]').show();
                            $("#sub3_requi").hide();

                            //هيخفى ويفضى اى حاجه تحته
                            $("#sub4_requi").hide();
                            $('#sub4_sel').empty();
                            $('#sub4_sel').show();

                            $('select[name="sub3"]').append('<option value="" disabled="true" selected="true">اختر النوع</option>');
                           $.each(data, function (key, value) {
                          $('select[name="sub3"]').append('<option value="' + key + '">' + value + '</option>');
                         });

                        }
                        else
                        {
                            $('select[name="sub3"]').hide();//hide select
                             $("#sub3_requi").show();//show div if sub2not founded

                              //هيخفى ويفضى اى حاجه تحته
                            $("#sub4_requi").hide();
                            $('#sub4_sel').empty();

                                //-------------get name of sub2--------------//
                               // alert(sub2_id);
                                document.getElementById("section_id2").value=section_id;
                                document.getElementById("cate_id2").value=cate_id;
                                document.getElementById("sub2_id").value=sub2_id;
                                 //  alert($( "#sub2_sel option:selected" ).text());
                                document.getElementById("sub2_name").value=$("#sub2_sel option:selected" ).text();
                                //----------------------------------------------------//
                        }
                         //--------------------------------------------//


                    },
                    error:function()
                    { alert("false"); }
                });

            }
            else {
                alert('AJAX load did not work');
            }
        });

    //---------------for show seelct option of sub4------------------------//

        $('select[name="sub3"]').on('change', function () {
            var sub3_id = $(this).val();
            var section_id = $('select[name="section_id"]').val();
            var cate_id = $('select[name="main_category"]').val();
            var sub2_id = $('select[name="sub2"]').val();

            //alert (sub3_id);
           if (sub3_id) {
              // alert("{{ URL::to('fetch_sub4')}}/" + sub3_id);

                $.ajax({
                    type: "GET",
                   // url: "{{ URL::to('fetch_sub4')}}/" + sub3_id,
                    url: "../../fetch_sub4/" + sub3_id,
                    dataType: "json",

                    success: function (data)
                    {
                         //alert("true");
                       // $("#sub4_div").show();
                         $('select[name="sub4"]').empty();
                          //--------------------------------------------//
                          if(data!='')
                        {
                            $('select[name="sub4"]').show();
                            $("#sub4_requi").hide();

                            $('select[name="sub4"]').append('<option value="" disabled="true" selected="true">اختر النوع الفرعى</option>');
                           $.each(data, function (key, value) {
                          $('select[name="sub4"]').append('<option value="' + key + '">' + value + '</option>');
                         });

                        }
                        else
                        {
                            $('select[name="sub4"]').hide();//hide select
                             $("#sub4_requi").show();//show div if sub2not founded
                                //-------------get name of sub2--------------//

                                    document.getElementById("sub2_id2").value=sub2_id;
                                    document.getElementById("section_id22").value=section_id;
                                    document.getElementById("cate_id22").value=cate_id;
                                   document.getElementById("sub3_id").value=sub3_id;
                                    document.getElementById("sub3_name").value=$("#sub3_sel option:selected" ).text();
                                //----------------------------------------------------//
                        }
                         //--------------------------------------------//


                    },
                    error:function()
                    { alert("false"); }
                });

}
            else {
                alert('AJAX load did not work');
            }
        });
    });
    //--------------------------------------------------------------------------//