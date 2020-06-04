<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Mail\ContactusMail;
use Sentinel;
use Baazar;
use Session;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('frontend.contact');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validateForm($request);

        $data = [
            'first_name'  => $request->first_name,
            'last_name'   => $request->last_name,
            'phone'       => $request->phone, 
            'email'       => $request->email,
            'description' => $request->description,
            'created_at'  => now(),
        ];   

        Contact::create($data);

        // $first_name = $data['first_name'];
        // $last_name  = $data['last_name'];
        // $messages   = $data['description'];
        // $frormmail   = $data['email'];
        // $toeamil = $data['toemail'];
        
        // \Mail::to($data['toemail'])->send(new ContactusMail($data,$first_name,$last_name,$messages,$frormmail,$toeamil));  

        session()->flash('success','your comment send successfully');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    //    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function contactmailList(){
        $mailList = Contact::all(); 
        return view('admin.contacts.messagelist',compact('mailList'));
    }

    public function replayMail(Request $request,$id){
        dd($request->all());
        $messageList = Contact::find($id);
        $messageList->update([
            'messages' => $request->messages,
            ]);

        \Mail::to($messageList['email'])->send(new ContactusMail($messageList));  

        session()->flash('success','Repley mail send successfully');

        return back();
    }

    private function validateForm($request){
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required', 
            'description' => 'required',
        ]);
    }
}
