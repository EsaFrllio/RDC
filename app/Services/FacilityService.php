<?php

namespace App\Services;

use App\Repositories\Contracts\FacilityRepositoryInterface;

class FacilityService
{
    protected $facilityRepo;

    public function __construct(FacilityRepositoryInterface $facilityRepo)
    {
        $this->facilityRepo = $facilityRepo;
    }

    public function getAllFacilities()
    {
        return $this->facilityRepo->all();
    }

    public function getFacilityById($id)
    {
        return $this->facilityRepo->find($id);
    }

    public function createFacility(array $data)
    {
        return $this->facilityRepo->create($data);
    }

    public function updateFacility($id, array $data)
    {
        return $this->facilityRepo->update($id, $data);
    }

    public function deleteFacility($id)
    {
        return $this->facilityRepo->delete($id);
    }
}
