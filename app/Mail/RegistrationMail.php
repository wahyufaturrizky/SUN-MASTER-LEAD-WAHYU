<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Registration;

class RegistrationMail extends Mailable
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
        $senderMail = 'noreply@suneducationgroup.com';
        $senderName = 'Sun Education Group';

        $defaultMailTemplate = 'emails.registration.default';

        // return $this->view('view.name');
        if($this->registration->registration_type == 'sun-edu-general-registration'){
            $senderMail = 'noreply@suneducationgroup.com';
            $senderName = 'Sun Education Group';
            $subject = 'General Registration' . ' - ' . $this->registration->full_name;
            $adminMail = 'info@suneducationgroup.com';
            $defaultMailTemplate = 'emails.registration.adminregistration.form1';
        } else if($this->registration->registration_type == 'sun-edu-apply-program'){
            $senderMail = 'noreply@suneducationgroup.com';
            $senderName = 'Sun Education Group';
            // $program = 
            // $subject = 'SUN Education Apply - ' . $this->registration->full_name . ' has applied for ' . $registration->program_interested . ' in (uni name)(country . ' - ' . $this->registration->full_name)
            $subject = 'Apply Program' . ' - ' . $this->registration->full_name;
            $adminMail = 'info@suneducationgroup.com';
            $defaultMailTemplate = 'emails.registration.adminregistration.form2';
        } else if($this->registration->registration_type == 'sun-edu-info-session'){
            $senderMail = 'noreply@suneducationgroup.com';
            $senderName = 'Sun Education Group';
            $subject = 'Info Session' . ' - ' . $this->registration->full_name;
            $adminMail = 'info@suneducationgroup.com';
            $defaultMailTemplate = 'emails.registration.adminregistration.form3';
        } else if($this->registration->registration_type == 'sun-edu-seminar'){
            $senderMail = 'noreply@suneducationgroup.com';
            $senderName = 'Sun Education Group';
            $subject = 'Seminar' . ' - ' . $this->registration->full_name;
            $adminMail = 'info@suneducationgroup.com';
            $defaultMailTemplate = 'emails.registration.adminregistration.form3';
        } else if($this->registration->registration_type == 'sun-edu-workshop'){
            $senderMail = 'noreply@suneducationgroup.com';
            $senderName = 'Sun Education Group';
            $subject = 'Workshop' . ' - ' . $this->registration->full_name;
            $adminMail = 'info@suneducationgroup.com';
            $defaultMailTemplate = 'emails.registration.adminregistration.form3';
        } else if($this->registration->registration_type == 'sun-eng-general-registration'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'General Registration' . ' - ' . $this->registration->full_name;
            $adminMail = 'info@sunenglish.co.id';
            $defaultMailTemplate = 'emails.registration.adminregistration.form6';
        } else if($this->registration->registration_type == 'sun-eng-ielts'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'IELTS Registration' . ' - ' . $this->registration->full_name;
            $adminMail = 'info@sunenglish.co.id';
            $defaultMailTemplate = 'emails.registration.adminregistration.form4';
        } else if($this->registration->registration_type == 'sun-eng-toefl'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'TOEFL iBT Registration' . ' - ' . $this->registration->full_name;
            $adminMail = 'info@sunenglish.co.id';
            $defaultMailTemplate = 'emails.registration.adminregistration.form4';
        } else if($this->registration->registration_type == 'sun-eng-gmat'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'GMAT Registration' . ' - ' . $this->registration->full_name;
            $adminMail = 'info@sunenglish.co.id';
            $defaultMailTemplate = 'emails.registration.adminregistration.form4';
        } else if($this->registration->registration_type == 'sun-eng-gre'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'GRE Registration' . ' - ' . $this->registration->full_name;
            $adminMail = 'info@sunenglish.co.id';
            $defaultMailTemplate = 'emails.registration.adminregistration.form4';
        } else if($this->registration->registration_type == 'sun-eng-sat'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'SAT I Registration' . ' - ' . $this->registration->full_name;
            $adminMail = 'info@sunenglish.co.id';
            $defaultMailTemplate = 'emails.registration.adminregistration.form4';
        } else if($this->registration->registration_type == 'sun-eng-pte'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'PTE Academic Registration' . ' - ' . $this->registration->full_name;
            $adminMail = 'info@sunenglish.co.id';
            $defaultMailTemplate = 'emails.registration.adminregistration.form4';
        } else if($this->registration->registration_type == 'sun-eng-general-english'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'General English Registration' . ' - ' . $this->registration->full_name;
            $adminMail = 'info@sunenglish.co.id';
            $defaultMailTemplate = 'emails.registration.adminregistration.form4';
        } else if($this->registration->registration_type == 'sun-eng-conversation'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'English Conversation Registration' . ' - ' . $this->registration->full_name;
            $adminMail = 'info@sunenglish.co.id';
            $defaultMailTemplate = 'emails.registration.adminregistration.form4';
        } else if($this->registration->registration_type == 'sun-eng-business'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'Business English Registration' . ' - ' . $this->registration->full_name;
            $adminMail = 'info@sunenglish.co.id';
            $defaultMailTemplate = 'emails.registration.adminregistration.form4';
        } else if($this->registration->registration_type == 'sun-eng-versant'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'Versant Registration' . ' - ' . $this->registration->full_name;
            $adminMail = 'info@sunenglish.co.id';
            $defaultMailTemplate = 'emails.registration.adminregistration.form4';
        } else if($this->registration->registration_type == 'sun-eng-info-session'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'Info Session' . ' - ' . $this->registration->full_name;
            $adminMail = 'info@sunenglish.co.id';
            $defaultMailTemplate = 'emails.registration.adminregistration.form3b';
        } else if($this->registration->registration_type == 'sun-eng-seminar'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'Seminar' . ' - ' . $this->registration->full_name;
            $adminMail = 'info@sunenglish.co.id';
            $defaultMailTemplate = 'emails.registration.adminregistration.form3b';
        } else if($this->registration->registration_type == 'sun-eng-workshop'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'Workshop' . ' - ' . $this->registration->full_name;
            $adminMail = 'info@sunenglish.co.id';
            $defaultMailTemplate = 'emails.registration.adminregistration.form3b';
        } else if($this->registration->registration_type == 'sun-eng-intl-ielts'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'International Test IELTS' . ' - ' . $this->registration->full_name;
            $adminMail = 'info@sunenglish.co.id';
            $defaultMailTemplate = 'emails.registration.adminregistration.form5';
        } else if($this->registration->registration_type == 'sun-eng-intl-toefl'){
            $senderMail = 'noreply@sunenglish.co.id';
            $senderName = 'Sun English';
            $subject = 'International Test TOEFL' . ' - ' . $this->registration->full_name;
            $adminMail = 'info@sunenglish.co.id';
            $defaultMailTemplate = 'emails.registration.adminregistration.form5';
        } else {
            $subject = '' . ' - ' . $this->registration->full_name;
            $defaultMailTemplate = 'emails.registration.default';
        }

        return $this->from($senderMail, $senderName)->subject($subject)->view($defaultMailTemplate);
    }
}
