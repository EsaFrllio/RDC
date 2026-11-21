<?php

namespace App\Services;

use App\Repositories\Contracts\TestimonialRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class TestimonialService
{
    protected $testimonialRepo;

    public function __construct(TestimonialRepositoryInterface $testimonialRepo)
    {
        $this->testimonialRepo = $testimonialRepo;
    }

    public function getAllTestimonials()
    {
        return $this->testimonialRepo->all();
    }

    public function getActiveTestimonials()
    {
        return $this->testimonialRepo->getActive();
    }

    public function getTestimonialById($id)
    {
        return $this->testimonialRepo->find($id);
    }

    public function createTestimonial(array $data)
    {
        if (isset($data['avatar']) && $data['avatar'] instanceof \Illuminate\Http\UploadedFile) {
            $data['avatar'] = $data['avatar']->store('testimonials', 'public');
        }

        return $this->testimonialRepo->create($data);
    }

    public function updateTestimonial($id, array $data)
    {
        $testimonial = $this->testimonialRepo->find($id);

        if (isset($data['avatar']) && $data['avatar'] instanceof \Illuminate\Http\UploadedFile) {
            if ($testimonial->avatar) {
                Storage::disk('public')->delete($testimonial->avatar);
            }
            $data['avatar'] = $data['avatar']->store('testimonials', 'public');
        } else {
            unset($data['avatar']);
        }

        return $this->testimonialRepo->update($id, $data);
    }

    public function deleteTestimonial($id)
    {
        $testimonial = $this->testimonialRepo->find($id);
        if ($testimonial->avatar) {
            Storage::disk('public')->delete($testimonial->avatar);
        }
        return $this->testimonialRepo->delete($id);
    }
}
