<?php

namespace App\Repositories\Eloquent;

use App\Models\Testimonial;
use App\Repositories\Contracts\TestimonialRepositoryInterface;

class TestimonialRepository implements TestimonialRepositoryInterface
{
    public function all()
    {
        return Testimonial::latest()->get();
    }

    public function getActive()
    {
        return Testimonial::active()->latest()->get();
    }

    public function find($id)
    {
        return Testimonial::findOrFail($id);
    }

    public function create(array $data)
    {
        return Testimonial::create($data);
    }

    public function update($id, array $data)
    {
        $testimonial = $this->find($id);
        $testimonial->update($data);
        return $testimonial;
    }

    public function delete($id)
    {
        $testimonial = $this->find($id);
        return $testimonial->delete();
    }
}
