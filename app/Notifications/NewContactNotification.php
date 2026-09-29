<?php

namespace App\Notifications;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Filament\Actions\Action;
use Filament\Notifications\Notification as FilamentNotification;

class NewContactNotification extends Notification
{
  use Queueable;

  /**
   * Create a new notification instance.
   */
  public function __construct(protected Contact $contact) {}

  /**
   * Get the notification's delivery channels.
   *
   * @return array<int, string>
   */
  public function via(object $notifiable): array
  {
    return ['database'];
  }

  /**
   * Get the mail representation of the notification.
   */
  // public function toMail(object $notifiable): MailMessage
  // {
  //   return (new MailMessage)
  //     ->line('The introduction to the notification.')
  //     ->action('Notification Action', url('/'))
  //     ->line('Thank you for using our application!');
  // }

  /**
   * Get the array representation of the notification.
   *
   * @return array<string, mixed>
   */
  public function toDatabase(User $notifiable): array
  {
    return FilamentNotification::make()
      ->title('رسالة تواصل جديدة')
      ->body('أرسل إليك رسالة جديدة من: ' . $this->contact->name)
      ->actions([
        Action::make('view')
          ->label('عرض الرسالة')
          ->url(
            route(
              'filament.admin.resources.contacts.view',
              ['record' => $this->contact]
            )
          ),
      ])
      ->getDatabaseMessage();
  }
}
