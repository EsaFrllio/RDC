<?php

namespace App\Repositories\Eloquent;

use App\Models\Facility;
use App\Repositories\Contracts\FacilityRepositoryInterface;

class FacilityRepository implements FacilityRepositoryInterface
{
    public function all()
    {
        return Facility::latest()->get();
    }

    public function find($id)
    {
        return Facility::findOrFail($id);
    }

    public function create(array $data)
    {
        return Facility::create($data);
    }

    public function update($id, array $data)
    {
        $facility = $this->find($id);
        $facility->update($data);
        return $facility;
    }

    public function delete($id)
    {
        $facility = $this->find($id);
        return $facility->delete();
    }
}
