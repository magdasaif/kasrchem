<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact =Contact::orderBy('id','desc')->get();
        return view('pages.contact_us',compact('contact'));
    }

   
    public function destroy($id)
    {
        
        try
        {
            Contact::findorFail($id)->delete();
             return redirect()->route('contact.index')->with(['success'=>'تم الحذف بنجاح']);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    
    public function deleteAll(Request $request)
    {
      $all_ids = explode(',',$request->delete_all_id);
     // dd($all_ids);
     Contact::whereIn('id',$all_ids)->delete();
     return redirect()->route('contact.index')->with(['success'=>'تم الحذف بنجاح']);
    }
}
