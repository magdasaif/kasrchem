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
     *                  required={"name","email","phone","message","token"},
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
     *                  @OA\Property(
     *                      property="token",
     *                      type="string",
     *                      description="form token"
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

            //use header to read parameter passed in header
             $lang=$request->header('locale');

             if($lang=='ar'){
                $validation_message = [
                    'name.required' =>'اسم الراسل مطلوب',
                    'email.required' =>'تاكد من ادخال البريد الالكترونى',
                    'email.email' => 'تاكد من ادخال البريد الالكترونى بشكل صحيح',
                    'phone.required' =>'تاكد من ادخال الهاتف',
                    'phone.numeric' =>'يجب ان يحتوى الهاتف ع ارقام',
                    'phone.min' =>'الحد الأدني لرقم الهاتف ٩ أرقام',
                    'phone.max' =>'أقصي حد لرقم الهاتف ١٤ رقم',
                    'phone.digits' =>'تاكد من ادخال 14 رقم فى الهاتف',
                    'message.required' =>'تاكد من ادخال محتوى الرساله',

                ];
            }else{
                $validation_message =[
                    'name.required' =>'Sender name is requird',
                    'email.required' =>'Email is requird',
                    'email.email' => 'Be sure that mail is valid',
                    'phone.required' =>'Phone is requird',
                    'phone.numeric' =>'Be sure phone is numeric',
                    'phone.min' =>'Phone Number must be at least 9 digits',
                    'phone.max' =>'Phone Number Could be 14 digits at most',
                    'phone.digits' =>'Be sure phone is 14 digit',
                    'message.required' =>'Message is requird',

                ];
            }

            //--------------to use trans fun ---but read site lang instead of passed lang----------------
            // [
            //     'name.required' => trans('contact.name'),
            //     'email.required' => trans('contact.mail_requird'),
            //     'email.email' =>trans('contact.mail_email'),
            //     'phone.required' =>trans('contact.phone_requird'),
            //     'phone.numeric' =>trans('contact.phone_numeric'),
            //     'phone.digits' =>trans('contact.phone_digits'),
            //     'message.required' =>trans('contact.message_requird'),
            //     ]
        $response = array('response' => '', 'success'=>false);

        $validator = Validator::make(
            $request->all(),
            [
            'name' => 'required',
            'email' =>'required|email',
            'phone'=>'required|numeric|min:9',//00966547449384
            'message'=>'required',
           ],
          $validation_message
        );

        if ($validator->fails()) {
             $response['response'] = $validator->messages();
        } else {

            //insert into db
            $cont=new Contact();
            $cont->name =$request->name;
            $cont->email =$request->email;
            $cont->phone =$request->phone;
            $cont->token =$request->token;
            $cont->message =$request->message;
            $cont->save();

             //to email --->get mail of site owner to send mail to it
             $site_email= SiteInfo::get()->pluck('site_mail')->first();

//            $response['success']=$site_email;

            //send mail with the content (passed here) of contact blade in emails folder
             //handel subject,from ,to in this mail
            Mail::send(
                'emails.contact',
                array(
                    'title' => 'Contact Mail -- تواصل معنا ',
                    'name' => $request->get('name'),
                    'mail' => $request->get('email'),
                    'phone' => $request->get('phone'),
                    'content' => $request->get('message'),
                ),
                function ($message) use ($request) {
                    $message->from($request->email);
                    $message->subject("Contact Mail -- تواصل معنا ");
//                     $message->to( ($site_email) ? $site_email : 'eradunited@murabba.dev' );
                    foreach ( SiteInfo::get()->pluck('site_mail') as $recipient) {
                    Mail::to($recipient)->send($cont);
                    }
//                    $message->to('eradunited@murabba.dev');
                }
            );


            $response['response']='تم ارسال الرساله بنجاح';
           // $response['success']='true';



          //  Mail::To($to_email) ->send(new ConatctEmail($data));
//             $response['success']= $to_email;

        }

        return $response;



    }

}
