<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    // 商品購入フォームの表示
    public function showPurchaseForm($itemId)
    {
        $item = Item::findOrFail($itemId);
        return view('purchase.form', compact('item'));
    }

    // 購入処理
    public function purchase(Request $request, $itemId)
    {
        $item = Item::findOrFail($itemId);

        $purchase = new Purchase();
        $purchase->user_id = Auth::id();
        $purchase->item_id = $item->id;
        $purchase->address = $request->address;
        $purchase->save();

        return redirect()->route('purchase.success', ['itemId' => $itemId]);
    }

    // 購入完了ページ
    public function success($itemId)
    {
        return view('purchase.success', compact('itemId'));
    }

    // 住所変更フォーム
    public function showAddressChangeForm($itemId)
    {
        $purchase = Purchase::where('item_id', $itemId)->where('user_id', Auth::id())->first();
        return view('purchase.address_change', compact('purchase'));
    }

    // 住所変更処理
    public function changeAddress(Request $request, $itemId)
    {
        $purchase = Purchase::where('item_id', $itemId)->where('user_id', Auth::id())->first();
        $purchase->address = $request->address;
        $purchase->save();

        return redirect()->route('purchase.success', ['itemId' => $itemId]);
    }
}
