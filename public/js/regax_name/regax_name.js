//-------------------------------check for  subname_ar with enter -----------------//
window.onload=function()
{
    let regax_name = document.getElementById('regax_name_ar');
    // let regax_name_ar_model = document.getElementById('regax_name_ar_model');
    regax_name.addEventListener('keypress', test_regax_name_ar);
   // regax_name_ar_model.addEventListener('keypress', test_regax_name_ar);
    function test_regax_name_ar(e) 
    {
        if (e.keyCode === 13 )
        {
       // alert(regax_name);
            if(!isNaN(regax_name))
            {
               // هيدخل فى الاف لو كان كاتب رقم
               $(':button[type="submit"]').prop('disabled', true);//make submit  disabled
                document.getElementById('error_name').style.display = 'block';
               return !isNaN(regax_name)

            }
            else
           {
           document.getElementById('error_name').style.display = 'none'; //if enter char and number or char only
            $(':button[type="submit"]').prop('disabled', false);//make submit enabl
           }
            return false;     
        }  
    }
}
//-----------------------------------click on submit ---------------------//
function check_regax_name_ar()
{
   let text = document.getElementById('regax_name_ar').value;
            if(!isNaN(text))
            {
                //it is number only
            // هيدخل فى الاف لو كان كاتب رقم
            $(':button[type="submit"]').prop('disabled', true);//make submit  disabled
                document.getElementById('error_name').style.display = 'block';
                return !isNaN(text)
           }
           else
           {
            document.getElementById('error_name').style.display = 'none'; //if enter char and number or char only
            $(':button[type="submit"]').prop('disabled', false);//make submit enabl
           }
           
}
//---------------//Allow Arabic Characters only-----------------------//

function CheckArabicCharactersOnly(e) 
{
    // 8 = backspace
    // 32 = space
    //48  = 0
    //57   =9
    // 0x0600   0x06FF  -->range for arabic
    var unicode = e.charCode ? e.charCode : e.keyCode
    if (unicode != 8) 
    { 
        //if the key isn't the backspace key (which we should allow)
        if (unicode == 32 ||unicode ==13 ) 
        {
            return true;
        }
         else 
        {
            if ((unicode < 48 || unicode > 57) && (unicode < 0x0600 || unicode > 0x06FF))//if not a arabic and number
           // if ( (unicode < 0x0600 || unicode > 0x06FF)) //if not a arabic---> مبيقبلش الكلام اللى مش عربى 
            return false; //disable key press
        }
    }
  
}
//-----------------------// Allow english Characters only-------------------------------//
function CheckEnglishCharactersOnly(e) 
{
    // 0 = numpad
    // 8 = backspace
    // 32 = space
    var unicode = e.charCode ? e.charCode : e.keyCode
    if (unicode != 8) 
    { 
        //if the key isn't the backspace key (which we should allow)
        if (unicode == 32 ||unicode ==13 ) 
        {
            return true;
        }

        else 
        {
            //if ((unicode < 48 || unicode > 57) && (unicode < 0x0600 || unicode > 0x06FF))//if not a arabic and number
            if ( (unicode < 0x0600 || unicode > 0x06FF)) 
            {
            return true; //مش هيقدر يكتب بالعربى
             document.getElementById('error_name_en').style.display = 'none'; 
           }
            else
            {
                document.getElementById('error_name_en').style.display = 'block'; //if enter char and number or char only
                 return false;
            }
           

        }
    }
}
//+++++++++++++++++++++++++++ for models+++++++++++++++++++++++++++++++++++++++++++++++++++++++//      
//-----------------------------------click on submit ---------------------//
function check_regax_name_ar_model(id)
{
    //alert(id);
   let text_model = document.getElementById('regax_name_ar_model'+id).value;
            if(!isNaN(text_model))
            {
                //it is number only
            // هيدخل فى الاف لو كان كاتب رقم
            //$(':button[type="submit"]').prop('disabled', true);//make submit  disabled
                document.getElementById('error_name_model'+id).style.display = 'block';
                return !isNaN(text_model)
           }
           else
           {
            document.getElementById('error_name_model'+id).style.display = 'none'; //if enter char and number or char only
           // $(':button[type="submit"]').prop('disabled', false);//make submit enabl
           }
           
}
//---------------//Allow Arabic Characters only-----------------------//

function CheckArabicCharactersOnly_model(e,id) 
{
    // 8 = backspace
    // 32 = space
    //48  = 0
    //57   =9
    // 0x0600   0x06FF  -->range for arabic
    var unicode = e.charCode ? e.charCode : e.keyCode
    if (unicode != 8) 
    { 
        //if the key isn't the backspace key (which we should allow)
        if (unicode == 32) 
        {
            return true;
        }
         else 
        {
            if ((unicode < 48 || unicode > 57) && (unicode < 0x0600 || unicode > 0x06FF))//if not a arabic and number
           // if ( (unicode < 0x0600 || unicode > 0x06FF)) //if not a arabic---> مبيقبلش الكلام اللى مش عربى 
            return false; //disable key press
        }
    }
  
}
//-----------------------// Allow english Characters only-------------------------------//
function CheckEnglishCharactersOnly_model(e,id) 
{
    // 0 = numpad
    // 8 = backspace
    // 32 = space
    var unicode = e.charCode ? e.charCode : e.keyCode
    if (unicode != 8) 
    { 
        //if the key isn't the backspace key (which we should allow)
        if (unicode == 32) 
        {
            return true;
        }

        else 
        {
            //if ((unicode < 48 || unicode > 57) && (unicode < 0x0600 || unicode > 0x06FF))//if not a arabic and number
            if ( (unicode < 0x0600 || unicode > 0x06FF)) 
            {
            return true; //مش هيقدر يكتب بالعربى
             document.getElementById('error_name_en_model'+id).style.display = 'none'; 
           }
            else
            {
                document.getElementById('error_name_en_model'+id).style.display = 'block'; //if enter char and number or char only
                 return false;
            }
           

        }
    }
}
///----------------------------------------------------------//  