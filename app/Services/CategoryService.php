<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function getAll()
    {
        $categories = Category::paginate(10);
        return $categories;
    }
    public function update(array $data, Category $category)
    {
        $category->update($data);
        return $category;
    }
    public function store(array $data)
    {
        $category = Category::create($data);
        return $category;
    }
    public function destroy(Category $category)
    {
        return $category->delete();
    }
}
