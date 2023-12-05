<?php

namespace App\Jobs;

use App\Mail\SendVerificationCodeMail;
use App\Models\VerificationCode;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendVerificationCodeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $user;
    /**
     * Create a new job instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $mailData = [
            'title' => 'Verification code for verify your account',
            'body' => 'This is your verification code',
            'code' => generateUniqueVerificationCode(),
            'name' => $this->user->name,
        ];

        Mail::to($this->user->email)->send(new SendVerificationCodeMail($mailData));
        $isExist = VerificationCode::whereUser_id($this->user->id)->first();
        if (!$isExist) {
            VerificationCode::create([
                'user_id' => $this->user->id,
                'code' => $mailData['code'],
            ]);
        } else {
            $isExist->update([
                'code' => $mailData['code'],
            ]);
        }
    }
}
