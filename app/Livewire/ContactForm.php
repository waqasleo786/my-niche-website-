<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\ContactSubmission;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ContactForm extends Component
{
    #[Rule('required|string|max:100')]
    public string $name = '';

    #[Rule('required|email|max:150')]
    public string $email = '';

    #[Rule('nullable|regex:/^03[0-9]{2}-?[0-9]{7}$/|max:15')]
    public string $phone = '';

    #[Rule('required|string|max:150')]
    public string $subject = '';

    #[Rule('required|string|min:10|max:2000')]
    public string $message = '';

    public bool $submitted = false;
    public string $errorMessage = '';

    public function submit(): void
    {
        $this->errorMessage = '';

        // Rate limiting: 3 submissions per 5 minutes per IP
        $key = 'contact-form:' . request()->ip();

        if (RateLimiter::tooManyAttempts($key, maxAttempts: 3)) {
            $this->errorMessage = __('Too many submissions. Please wait 5 minutes before trying again.');
            return;
        }

        $this->validate();

        RateLimiter::hit($key, decaySeconds: 300);

        // Save to database
        ContactSubmission::create([
            'name'    => $this->name,
            'email'   => $this->email,
            'phone'   => $this->phone ?: null,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        // Send notification email to admin
        Mail::raw(
            sprintf(
                "New Contact Form Submission\n\nName: %s\nEmail: %s\nPhone: %s\nSubject: %s\n\nMessage:\n%s",
                $this->name,
                $this->email,
                $this->phone ?: 'Not provided',
                $this->subject,
                $this->message
            ),
            function ($mail): void {
                $mail->to('waqasleo@gmail.com')
                    ->subject('New Contact: ' . $this->subject);
            }
        );

        $this->reset(['name', 'email', 'phone', 'subject', 'message']);
        $this->submitted = true;
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.contact-form');
    }
}
