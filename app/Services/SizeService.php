<?php

namespace App\Services;

use App\Models\Size;

class SizeService
{
    public function getAll()
    {
        return Size::orderBy('id', 'desc')->paginate(10);
    }

    public function store(array $data)
    {
        return Size::create($data);
    }

    public function update(array $data, Size $size)
    {
        $size->update($data);
        return $size;
    }

    public function destroy(Size $size)
    {
        return $size->delete();
    }
}
