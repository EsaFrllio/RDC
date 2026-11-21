<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Repositories\Contracts\MenuRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MenuService
{
    protected $menuRepo;

    public function __construct(MenuRepositoryInterface $menuRepo)
    {
        $this->menuRepo = $menuRepo;
    }

    public function getAllMenus()
    {
        return Menu::with('category')->orderBy('sort_order')->get();
    }

    public function getFeaturedMenus()
    {
        return Menu::featured()
            ->orderBy('sort_order')
            ->get();
    }

    public function getCategoriesWithMenus()
    {
        return MenuCategory::orderBy('sort_order')
            ->with(['menus' => function ($query) {
                $query->where('is_featured', false)
                    ->orderBy('sort_order');
            }])
            ->get()
            ->filter(fn ($category) => $category->menus->isNotEmpty());
    }

    public function getMenuById($id)
    {
        return Menu::findOrFail($id);
    }

    public function createMenu(array $data)
    {
        $data['slug'] = Str::slug($data['name']);
        
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['image'] = $data['image']->store('menu', 'public');
        }

        $data['is_featured'] = isset($data['is_featured']) && $data['is_featured'];
        $data['sort_order'] = isset($data['sort_order']) ? (int)$data['sort_order'] : 0;

        return Menu::create($data);
    }

    public function updateMenu($id, array $data)
    {
        $menu = Menu::findOrFail($id);
        $data['slug'] = Str::slug($data['name']);

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            if ($menu->image && !Str::startsWith($menu->image, 'http') && Storage::disk('public')->exists($menu->image)) {
                Storage::disk('public')->delete($menu->image);
            }
            $data['image'] = $data['image']->store('menu', 'public');
        } else {
            unset($data['image']);
        }

        $data['is_featured'] = isset($data['is_featured']) && $data['is_featured'];
        $data['sort_order'] = isset($data['sort_order']) ? (int)$data['sort_order'] : 0;

        $menu->update($data);
        return $menu;
    }

    public function deleteMenu($id)
    {
        $menu = Menu::findOrFail($id);
        if ($menu->image && !Str::startsWith($menu->image, 'http') && Storage::disk('public')->exists($menu->image)) {
            Storage::disk('public')->delete($menu->image);
        }
        return $menu->delete();
    }
}
