<?php

namespace App\Services;

use App\OTP;

class OTPService
{
    /**
     * @var TwilioService
     */
    private $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }

    /**
     * Create the OTP and make a call to the user providing the code
     *
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function createOtp()
    {
        $otp = OTP::create([
            'code' => rand(10000, 99999),
            'active' => 0,
        ]);

        return $otp;
    }

    /**
     * Validate an OTP provided by a user
     *
     * @param $otpCode
     * @return mixed
     */
    public function otpIsValid($otpCode)
    {
        return count(OTP::where('code', $otpCode)->get()) ? true : false;
    }
}
