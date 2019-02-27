<?php

namespace App\Http\Controllers;

use App\Services\OTPService;
use App\Services\TwilioService;
use Illuminate\Http\Request;

class OTPController extends Controller
{
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
     * Route which Twilio calls to determine the voice message to be played to the user.
     *
     * @param Request $request
     * @param $otpCode
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function generateVoiceMessage(Request $request, $otpCode, TwilioService $twilioService)
    {
        $twimlResponse = $twilioService->generateTwimlForVoiceCall($otpCode);

        return response($twimlResponse, 200)
            ->header('Content-Type', 'text/xml');
    }

    public function validateOTP(Request $request, OTPService $OTPService)
    {
        $otpCode = $request->get('otpCode');

        $otpIsValid = $OTPService->otpIsValid($otpCode);

        if($otpIsValid) {
            return view('otp.create', ['otpValidated' => true, 'otpCode' => $otpCode]);
        }

        return view('otp.validate', ['error' => $otpCode . " is invalid"]);
    }
}
