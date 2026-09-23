<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductVariantRequest;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    public function store(ProductVariantRequest $request, Product $product)
    {
        $validated = $request->validated();

        $sizeId = $validated['size_id'];
        if (!empty($validated['new_size'])) {
            $size = Size::firstOrCreate(['name' => $validated['new_size']]);
            $sizeId = $size->id;
        }

        if (!$sizeId) {
            return back()->with('error', 'Vui lòng chọn hoặc nhập tên kích cỡ (Size).');
        }

        $exists = ProductVariant::where('product_id', $product->id)
            ->where('size_id', $sizeId)->exists();

        if ($exists) {
            return back()->with('error', 'Kích cỡ này đã tồn tại cho sản phẩm. Bạn hãy cập nhật số lượng thay vì tạo mới.');
        }

        ProductVariant::create([
            'product_id' => $product->id,
            'size_id' => $sizeId,
            'stock' => $request->stock,
        ]);
        return back()->with('success', 'Đã thêm kích cỡ mới thành công!');
    }

    public function update(ProductVariantRequest $request, ProductVariant $variant)
    {
        $validated = $request->validated();

        $sizeId = $validated['size_id'];
        if (!empty($validated['new_size'])) {
            $size = Size::firstOrCreate(['name' => $validated['new_size']]);
            $sizeId = $size->id;
        }

        if (!$sizeId) {
            return back()->with('error', 'Vui lòng chọn hoặc nhập tên kích cỡ (Size).');
        }
        $isDulicate = ProductVariant::where('product_id', $variant->product_id)
            ->where('size_id', $sizeId)
            ->where('id', '!=', $variant->id)
            ->exists();
        if ($isDulicate) {
            return back()->with('error', 'Sản phẩm đã có một mặt hàng với kích cỡ này.');
        }
        $variant->update([
            'size_id' => $sizeId,
            'stock' => $validated['stock'],
        ]);
        return back()->with('success', 'Đã cập nhật thông tin mặt hàng thành công!');

    }
    public function destroy(ProductVariant $variant)
    {
        $variant->delete();
        return back()->with('success', 'Đã xóa kích cỡ này khỏi sản phẩm.');
    }
}
