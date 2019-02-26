<?php

namespace App\Services;

use Exception;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;

class TwilioService
{
    /**
     * Twilio rest client
     *
     * @var Twilio\Rest\Client
     */
    private $twilioRestClient;

    /**
     * TwilioService constructor.
     *
     * @throws ConfigurationException
     */
    public function __construct()
    {
        $this->twilioRestClient = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

    }

    /**
     * Make a voice call to a phone number providing an otp code from the application
     *
     * @param String $phoneNumber
     * @param $otpCode
     * @return \Twilio\Rest\Api\V2010\Account\CallInstance
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function makeOtpVoiceCall(String $phoneNumber, $otpCode)
    {
        // Url which points to our application route for generating the TWIML used in calling the user.
        $twimlUrl = route('generateOTPTwiml', ['otpCode' => $otpCode]);
//        $twimlUrl = "http://9a161643.ngrok.io/" . "voice/call/message/" . $otpCode;

        $call = $this->twilioRestClient->calls->create($phoneNumber, env('TWILIO_FROM_NUMBER'), array("url" => $twimlUrl));

        return $call->sid;
    }

    /**
     * Generate the TWIML needed for a voice call sending an OTP code to a user.
     *
     * @param $otpCode
     * @return VoiceResponse
     */
    public function generateTwiMLForVoiceCall($otpCode)
    {
        $voiceMessage = new VoiceResponse();
        $voiceMessage->say('This is an automated call providing you your OTP from the test app.');
        $voiceMessage->say('Your one time password is ' . $otpCode);
        $voiceMessage->pause(['length' => 2]);
        $voiceMessage->say('Your one time password is ' . $otpCode);

        return $voiceMessage;
    }
}
