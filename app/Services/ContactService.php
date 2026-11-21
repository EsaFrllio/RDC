<?php

namespace App\Services;

use App\Repositories\Contracts\ContactRepositoryInterface;

class ContactService
{
    protected $contactRepo;

    public function __construct(ContactRepositoryInterface $contactRepo)
    {
        $this->contactRepo = $contactRepo;
    }

    public function getContactSettings()
    {
        return $this->contactRepo->getSettings();
    }

    public function updateContactSettings(array $data)
    {
        return $this->contactRepo->updateSettings($data);
    }
}
