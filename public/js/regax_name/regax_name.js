//-------------------------------check for  sunname_ar with enter -----------------//
window.onload=function()
{
    let regax_name = document.getElementById('regax_name_ar');
    regax_name.addEventListener('keypress', test_regax_name_ar);
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
            $(':button[type="submit"]').prop('disabled', false);//make submit enabl

           }
            return false;     
        }  
    }
}
//-----------------------------------click on submit---------------------//
function check_regax_name_ar()
{
   let text = document.getElementById('regax_name_ar').value;
            if(!isNaN(text))
            {
            // هيدخل فى الاف لو كان كاتب رقم
            $(':button[type="submit"]').prop('disabled', true);//make submit  disabled
                document.getElementById('error_name').style.display = 'block';
                return !isNaN(text)
           }
           else
           {
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
//-----------------------// Allow Arabic Characters only-------------------------------//
function CheckArabicCharactersOnly2(e) 
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
            if ( (unicode < 0x0600 || unicode > 0x06FF)) //if not a arabic---> مبيقبلش الكلام اللى مش عربى 
            return true; //مش هيقدر يتكتب حاجة مش باللغة العربية
            else
            {
                 return false;
            }
           

        }
    }
}
///----------------------------------------------------------//      
