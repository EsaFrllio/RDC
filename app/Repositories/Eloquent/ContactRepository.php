<?php

namespace App\Repositories\Eloquent;

use App\Models\Contact;
use App\Repositories\Contracts\ContactRepositoryInterface;

class ContactRepository implements ContactRepositoryInterface
{
    public function getSettings()
    {
        return Contact::firstOrCreate([], [
            'whatsapp' => '628123456789',
            'phone' => '+62 812-3456-789',
            'email' => 'hello@rdcthecafe.com',
            'address' => 'Neon Street No. 42, Cyber City',
            'business_hours' => 'Mon - Sun: 10:00 AM - 12:00 AM',
            'google_maps_link' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2942478546114!2d106.82420367468172!3d-6.224855493763327!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e4b7c2b5eb%3A0x6342898dbf145b37!2sMega%20Kuningan!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid'
        ]);
    }

    public function updateSettings(array $data)
    {
        $settings = $this->getSettings();
        $settings->update($data);
        return $settings;
    }
}
