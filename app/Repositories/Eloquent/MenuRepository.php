<?php

namespace App\Repositories\Eloquent;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Repositories\Contracts\MenuRepositoryInterface;

class MenuRepository implements MenuRepositoryInterface
{
    public function all()
    {
        return Menu::with('category')->latest()->get();
    }

    public function find($id)
    {
        return Menu::findOrFail($id);
    }

    public function create(array $data)
    {
        return Menu::create($data);
    }

    public function update($id, array $data)
    {
        $menu = $this->find($id);
        $menu->update($data);
        return $menu;
    }

    public function delete($id)
    {
        $menu = $this->find($id);
        return $menu->delete();
    }

    public function getFeatured()
    {
        return Menu::with('category')->where('is_featured', true)->get();
    }

    public function getCategories()
    {
        return MenuCategory::with('menus')->get();
    }
}
