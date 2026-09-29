<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\User;
use App\Notifications\NewContactNotification;
use Illuminate\Support\Facades\Notification;

class ContactService
{
  public function store(array $data): Contact
  {
    $contact = Contact::create($data);

    $admins = User::role(['super_admin'])->get();

    if ($admins->isNotEmpty()) {
      Notification::send(
        $admins,
        new NewContactNotification($contact)
      );
    }

    return $contact;
  }
}
