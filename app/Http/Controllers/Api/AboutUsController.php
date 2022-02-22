<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\AboutResource;
use App\Models\AboutUs;
use App\Models\SiteInfo;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConatctEmail;
use App\Models\Contact;

class AboutUsController extends Controller
{

    public function about_us(Request $request){
        //use header to read parameter passed in header 
        $lang=$request->header('locale');
      
        if($lang=='ar'){
            $selected ="title_ar as title";
            $selected2="mission_ar as mission";
            $selected3="vision_ar as vision";
            $selected4="goal_ar as goal";
        }else{
             $selected="title_en as title";
             $selected2="mission_en as mission";
             $selected3="vision_en as vision";
             $selected4="goal_en as goal";
        }
        $about= new AboutResource(AboutUs::select('image',$selected,$selected2,$selected3,$selected4)->first());
      //  $about->map(function($i) { $i->type = 'about_us'; });
        return response($about,200,['OK']);
    }
    

    /**
     * @OA\Get (
     *      path="/setting",
     *      operationId="Get site setting information",
     *      tags={"Setting"},
     *      summary="Get site setting information",
     *      @OA\Parameter(
     *          name="locale",
     *          description="App Locale",
     *          required=true,
     *          in="header",
     *          @OA\Schema(
     *              type="string",
     *              enum={"ar", "en"},
     *              default="ar"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     *     )
     */

    public function setting(Request $request){
        //use header to read parameter passed in header 
        $lang=$request->header('locale');
      
        if($lang=='ar'){
            $selected ="site_name_ar as site_name";
            $selected2="site_desc_ar as site_description";
        }else{
             $selected="site_name_en as site_name";
             $selected2="site_desc_en as site_description";
        }
        $setting=new AboutResource(SiteInfo::select('*',$selected,$selected2)->first());
       // $setting->map(function($i) { $i->type = 'setting'; });
        return response($setting,200,['OK']);
    }
   
    
    /**
     * @OA\Post(
     *      path="/contact",
     *      operationId="send_message",
     *      tags={"Contact"},
     *      summary="Contact Message Endpoint",
     *      description="Send Message",
     *      @OA\Parameter(
     *          name="locale",
     *          description="App Locale",
     *          required=true,
     *          in="header",
     *          @OA\Schema(
     *              type="string",
     *              enum={"ar", "en"},
     *              default="ar"
     *          )
     *      ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  required={"name","email","phone","message"},
     *                  @OA\Property(
     *                      property="name",
     *                      type="string",
     *                      description="Sender Name"
     *                  ),
     *                  @OA\Property(
     *                      property="email",
     *                      type="string",
     *                      description="Sender Email"
     *                  ),
     *                  @OA\Property(
     *                      property="phone",
     *                      type="string",
     *                      description="Sender Phone"
     *                  ),
     *                  @OA\Property(
     *                      property="message",
     *                      type="string",
     *                      description="Message Content"
     *                  ),
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     *     )
     * @param ContactRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function contact(Request $request){


        $response = array('response' => '', 'success'=>false);
        
        $validator = Validator::make(
            $request->all(),
            [
            'name' => 'required',
            'email' =>'required|email',
            'phone'=>'required|numeric|digits:14',//00966547449384
            'message'=>'required',
           ],
           [
            'name.required' =>'اسم الراسل مطلوب',
            'email.required' => 'تاكد من ادخال البريد الالكترونى',
            'email.email' =>'تاكد من ادخال البريد الالكترونى بشكل صحيح',
            'phone.required' =>'تاكد من ادخال الهاتف',
            'phone.numeric' =>'يجب ان يحتوى الهاتف ع ارقام',
            'phone.digits' =>'تاكد من ادخال 14 رقم فى الهاتف',
            'message.required' =>'تاكد من ادخال محتوى الرساله',
            ]
        );

        if ($validator->fails()) {
             $response['response'] = $validator->messages();
        } else {

            $cont=new Contact();
            $cont->name =$request->name;
            $cont->email =$request->email;
            $cont->phone =$request->phone;
            $cont->message =$request->message;
            $cont->save();

             //use header to read parameter passed in header 
            // $lang=$request->header('locale');
        
            // if($lang=='ar'){
            //     $selected ="site_name_ar as site_name";
            //     $selected2="site_desc_ar as site_description";
            // }else{
            //      $selected="site_name_en as site_name";
            //      $selected2="site_desc_en as site_description";
            // }
           
            $response['response']='تم ارسال الرساله بنجاح';
            $response['success']='true';
            
            $mail_body1='From :'.$request->name;
            $mail_body2='Mail :'.$request->email;
            $mail_body3='Phone :'.$request->phone;
            $mail_body4='Message :'.$request->message;
            
            $data=['title'=> 'new conatct' , 'name' => $mail_body1, 'mail' => $mail_body2, 'phone' => $mail_body3, 'message' => $mail_body4];
            
            //to email --->mail of site owner
            $to_email= SiteInfo::select('site_mail')->first();          
            // Mail::To($request->email) ->send(new ConatctEmail($data));

            Mail::To($request->email) ->send(new ConatctEmail($data),function($message)
             {
                 $message->to($to_email, 'John Smith')
                     ->replyTo($request->email, 'Reply message')
                     ->subject('Welcome!');
             });

             $response['success']=$data;
             
        }

        return $response;

       
       
    }
   
}
