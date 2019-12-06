<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

// Self Model
use App\EmailVerification;

// Sunnies Model
use App\Remote\Sunnies\RStudent;
use App\Remote\Sunnies\FStudent;
use App\Remote\Sunnies\TSAP;
use App\Remote\Sunnies\SyswebUser;
use App\Remote\Sunnies\SyswebProfile;
use App\Remote\Sunnies\SyswebRole;
use App\Remote\Sunnies\SyswebUserInRole;
use Symfony\Component\Mime\Email;

class EmailChecker implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $emailVerified = EmailVerification::select('email')->get()->pluck('email');
        $emails = RStudent::whereNotNull('email')->where('email','!=','')->whereNotIn('email', $emailVerified)->whereYear('modified_date', '2019')->inRandomOrder()->get()->pluck('email');

        echo 'Total email:  ' . count($emails);
        echo "\n";
        echo "\n";

        foreach($emails as $i => $email){
            echo 'start checking ' . $email . ': ';
            $emailVerification = EmailVerification::where('email', $email)->first();
            // $emailVerifications = EmailVerification::whereNotIn('email', $emails)->get();
            if(is_null($emailVerification)){
                $client = new \GuzzleHttp\Client();
                $guzzleResponse = $client->request('GET', 'https://api.my-addr.com/email/api.php?secret=3B9EE8463A8746FB0654D072A2D3B96C&email=' . $email . '&ext=1'); // .

                // $request = new \GuzzleHttp\Psr7\Request('GET', 'https://api.my-addr.com/email/api.php?secret=3B9EE8463A8746FB0654D072A2D3B96C&email=' . $leads->email . '&ext=1');
                // $client->sendAsync($request)->then(function ($guzzleResponse) use ($emailVerification, $leads) {
                    // dd($guzzleResponse->getStatusCode());
                    if($guzzleResponse->getStatusCode() == 200){
                        // $verificationStatus = explode('|', $guzzleResponse->getBody());
                        // $emailVerification = new EmailVerification();
                        $emailVerification = EmailVerification::firstOrNew([
                            'email' => $email
                        ]);
                        $emailVerification->email = $email;
                        if(!is_null($guzzleResponse->getBody()) && !empty($guzzleResponse->getBody())){
                            $verificationStatus = explode('|', $guzzleResponse->getBody());
                            $emailVerification->status = isset($verificationStatus[0]) ? $verificationStatus[0] : 'unknown';
                            $emailVerification->sub_status = isset($verificationStatus[1]) ? $verificationStatus[1] : 'unknown';
                        } else {
                            $emailVerification->status = 'unknown';
                            $emailVerification->sub_status = 'unknown';
                        }

                        try {
                            $emailVerification->save();
                            // Validate the value...
                        } catch (Exception $e) {
                            // report($e);
//
                            // return false;
                        }
                        // if(is_null($emailVerification)){
                            // $emailVerification = EmailVerification::firstOrNew([
                            //     'email' => $leads->email
                            // ]);
                        // }
                    }
                    // echo 'I completed! ' . $response->getBody();

                // return dd($emailVerification);
                // });
            }
            echo $emailVerification->status . '. Remaining: ' . (count($emails) - $i);
            echo "\n";
        }
    }
}
