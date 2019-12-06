<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Registration;

class UserRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Registration $registration)
    {
        $this->registration = $registration;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $defaultMailTemplate = 'emails.registration.default';

        // return $this->view('view.name');
        if($this->registration->registration_type == 'sun-edu-general-registration'){
            $senderMail = 'noreply@suneducationgroup.com';
            $senderName = 'Sun Education Group';
            $subject = 'Terima kasih. General enquiry anda telah kami terima.';
            $defaultMailTemplate = 'emails.registration.userregistration.email1';
        } else if($this->registration->registration_type == 'sun-edu-apply-program'){
            $senderMail = 'noreply@suneducationgroup.com';
            $senderName = 'Sun Education Group';
            // $program = 
            // $subject = 'SUN Education Apply - ' . $registration->full_name . ' has applied for ' . $registration->program_interested . ' in (uni name)(country)
            $subject = 'Terima kasih. Pengajuan untuk progam ' . $this->registration->reference_program_name . ' di ' . $this->registration->reference_university_name . ' telah kami terima.';
            $defaultMailTemplate = 'emails.registration.userregistration.email2';
        } else if($this->registration->registration_type == 'sun-edu-info-session'){
            $senderMail = 'noreply@suneducationgroup.com';
            $senderName = 'Sun Education Group';
            $subject = 'Sun Education - Info Session';
        } else if($this->registration->registration_type == 'sun-edu-seminar'){
            $senderMail = 'noreply@suneducationgroup.com';
            $senderName = 'Sun Education Group';
            $subject = 'Sun Education - Seminar';
        } else if($this->registration->registration_type == 'sun-edu-workshop'){
            $senderMail = 'noreply@suneducationgroup.com';
            $senderName = 'Sun Education Group';
            $subject = 'Sun Education - Workshop';
        } else if($this->registration->registration_type == 'sun-eng-general-registration'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'Sun English - General Registration';
            $defaultMailTemplate = 'emails.registration.userregistration.email3';
        } else if($this->registration->registration_type == 'sun-eng-ielts'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'Sun English - Apply IELTS';
            $defaultMailTemplate = 'emails.registration.userregistration.email3';
        } else if($this->registration->registration_type == 'sun-eng-toefl'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'Sun English - Apply TOEFL';
            $defaultMailTemplate = 'emails.registration.userregistration.email3';
        } else if($this->registration->registration_type == 'sun-eng-gmat'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'Sun English - Apply GMAT';
            $defaultMailTemplate = 'emails.registration.userregistration.email3';
        } else if($this->registration->registration_type == 'sun-eng-gre'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'Sun English - Apply GRE';
            $defaultMailTemplate = 'emails.registration.userregistration.email3';
        } else if($this->registration->registration_type == 'sun-eng-sat'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'Sun English - Apply SAT';
            $defaultMailTemplate = 'emails.registration.userregistration.email3';
        } else if($this->registration->registration_type == 'sun-eng-pte'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'Sun English - Apply PTE';
            $defaultMailTemplate = 'emails.registration.userregistration.email3';
        } else if($this->registration->registration_type == 'sun-eng-general-english'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'Sun English - Apply General English';
            $defaultMailTemplate = 'emails.registration.userregistration.email3';
        } else if($this->registration->registration_type == 'sun-eng-conversation'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'Sun English - Apply Conversation';
            $defaultMailTemplate = 'emails.registration.userregistration.email3';
        } else if($this->registration->registration_type == 'sun-eng-business'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'Sun English - Apply Business';
            $defaultMailTemplate = 'emails.registration.userregistration.email3';
        } else if($this->registration->registration_type == 'sun-eng-versant'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'Sun English - Apply Versant';
            $defaultMailTemplate = 'emails.registration.userregistration.email3';
        } else if($this->registration->registration_type == 'sun-eng-info-session'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'Sun English - Info Session';
        } else if($this->registration->registration_type == 'sun-eng-seminar'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'Sun English - Seminar';
        } else if($this->registration->registration_type == 'sun-eng-workshop'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'Sun English - Workshop';
        } else if($this->registration->registration_type == 'sun-eng-intl-ielts'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'Sun English - International (IELTS)';
            $defaultMailTemplate = 'emails.registration.userregistration.email4';
        } else if($this->registration->registration_type == 'sun-eng-intl-toefl'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'Sun English - International (TOEFL)';
            $defaultMailTemplate = 'emails.registration.userregistration.email4';
        } else {
            $senderMail = 'noreply@suneducationgroup.com';
            $senderName = 'Sun Education Group';
            $subject = '';
            $defaultMailTemplate = 'emails.registration.userregistration.email1';
        }

        // return $this->subject($subject)->view('emails.registration.userregistration');
        return $this->from($senderMail, $senderName)->subject($subject)->view($defaultMailTemplate);
    }
}