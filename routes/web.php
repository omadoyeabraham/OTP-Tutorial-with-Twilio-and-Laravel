<?php

Route::get('/', function () {
    return view('welcome');
});

Route::post('generateMessage/{otpCode}', 'OTPController@generateVoiceMessage')->name('generateMessage');

Route::resource('otp', 'OTPController');

Route::get('otp/validate', 'OTPController@ShowValidate');

Route::post('otp/validate', 'OTPController@validateOTP')->name('otp.validate');

//Route::post('callUser', 'OTPController@callUserWithOtp');
