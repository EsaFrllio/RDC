<?php

namespace App\Services;

use App\Repositories\Contracts\GalleryRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class GalleryService
{
    protected $galleryRepo;

    public function __construct(GalleryRepositoryInterface $galleryRepo)
    {
        $this->galleryRepo = $galleryRepo;
    }

    public function getAllGalleries()
    {
        return $this->galleryRepo->all();
    }

    public function getGalleriesByCategory($category)
    {
        return $this->galleryRepo->getByCategory($category);
    }

    public function getGalleryById($id)
    {
        return $this->galleryRepo->find($id);
    }

    public function createGallery(array $data)
    {
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['image'] = $data['image']->store('gallery', 'public');
        }

        return $this->galleryRepo->create($data);
    }

    public function updateGallery($id, array $data)
    {
        $gallery = $this->galleryRepo->find($id);

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
            $data['image'] = $data['image']->store('gallery', 'public');
        } else {
            unset($data['image']);
        }

        return $this->galleryRepo->update($id, $data);
    }

    public function deleteGallery($id)
    {
        $gallery = $this->galleryRepo->find($id);
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }
        return $this->galleryRepo->delete($id);
    }
}
