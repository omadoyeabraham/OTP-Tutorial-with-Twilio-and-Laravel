<?php

namespace App\Http\Controllers;

use App\Services\OTPService;
use App\Services\TwilioService;
use Illuminate\Http\Request;

class OTPcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('otp.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param OTPService $OTPService
     * @param TwilioService $twilioService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function store(Request $request, OTPService $OTPService, TwilioService $twilioService)
    {
        $otp = $OTPService->createOtp();

        $callId = $twilioService->makeOtpVoiceCall(env('AUTHORISED_PHONE_NUMBER'), $otp->code);

        return view('otp.validate', ['callId' => $callId]);
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
}
