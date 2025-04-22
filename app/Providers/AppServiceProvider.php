<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
        // return (new MailMessage)
        //     ->subject('Verify Email Address')
        //     ->line('Click the button below to verify your email address.')
        //     ->action('Verify Email Address', $url);
        return (new MailMessage)
            ->subject('Verifikasi Email Kamu di BantuinDong')
            ->greeting('Halo ' . $notifiable->name . ' 👋')
            ->line('Terima kasih yah sudah menjadi bagian dari kami! Silakan klik tombol di bawah ini untuk memverifikasi email kamu.')
            ->action('Verifikasi Email', $url)
            ->line('Kalau kamu tidak merasa mendaftar, abaikan email ini ya. ')
            ->salutation('Salam hangat, Tim BantuinDong');
    });
    }
}
