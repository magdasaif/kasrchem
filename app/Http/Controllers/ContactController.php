<?php

namespace App\Http\Controllers;

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
}
