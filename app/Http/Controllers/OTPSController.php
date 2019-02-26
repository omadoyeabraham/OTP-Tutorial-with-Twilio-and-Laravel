<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\TwilioService;

class OTPSController extends Controller
{
    /**
     * @var TwilioService
     */
    private $voiceService;

    public function __construct(TwilioService $voiceService)
    {
        $this->voiceService = $voiceService;
    }

    /**
     * Call the user with their otp code
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function callUserWithOtp(Request $request)
    {
        try {
            $data = $request->all();
            $callId = $this->voiceService->makeOtpVoiceCall($data["phoneNumber"], $data["otpCode"]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json([
            "message" => 'Call queued successfully',
            "callId" => $callId
        ], 200);
    }

    /**
     * Route which Twilio calls to determine the voice message to be played to the user.
     *
     * @param Request $request
     * @param $otpCode
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function generateVoiceMessage(Request $request, $otpCode)
    {
        $twimlResponse = $this->voiceService->generateTwimlForVoiceCall($otpCode);

        return response($twimlResponse, 200)
            ->header('Content-Type', 'text/xml');
    }
}
