<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact.contact');
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
        //
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

    public function postContact(ContactRequest $request)
    {
        $data = array(
            'email' => $request->email,
            'bodyWiadomosc' => $request->wiadomosc,
            'imie' => $request->imie,
            'nazwisko' => $request->nazwisko,
            'tel' => $request->tel
        );

        Mail::send('emails.contact', $data, function($message){
            $message->from('cukiernia@cukiernia.pl');
            $message->to('dante.dawid@gmail.com');
            $message->subject('Wiadomość z formularza cukienri');
        });

        return view('contact.wiadomosc');
    }

//    public function ship(ContactRequest $request, $orderId)
//    {
//        $order = Order::findOrFail($orderId);
//
//        // Ship order...
//
//        Mail::to($request->user())->send(new OrderShipped($order));
//    }

}
