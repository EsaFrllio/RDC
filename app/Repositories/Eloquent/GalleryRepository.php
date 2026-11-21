<?php

namespace App\Repositories\Eloquent;

use App\Models\Gallery;
use App\Repositories\Contracts\GalleryRepositoryInterface;

class GalleryRepository implements GalleryRepositoryInterface
{
    public function all()
    {
        return Gallery::latest()->get();
    }

    public function find($id)
    {
        return Gallery::findOrFail($id);
    }

    public function create(array $data)
    {
        return Gallery::create($data);
    }

    public function update($id, array $data)
    {
        $gallery = $this->find($id);
        $gallery->update($data);
        return $gallery;
    }

    public function delete($id)
    {
        $gallery = $this->find($id);
        return $gallery->delete();
    }

    public function getByCategory($category)
    {
        return Gallery::where('category', $category)->latest()->get();
    }
}
