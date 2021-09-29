<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadImageRequest;
use App\Models\Shop;
use App\Services\ImageService;
use Illuminate\Support\Facades\Auth;
use InterventionImage;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');

        // 他のショップ情報にアクセスすると404に遷移
        $this->middleware(function ($request, $next) {
            $parameterId = $request->route()->parameter('shop');
            if (!is_null($parameterId)) {
                $shopsOwnerId = Shop::findOrFail($parameterId)->owner->id;
                $shopId = (int)$shopsOwnerId;
                if ($shopId !== Auth::id()) {
                    abort(404);
                }
            }
            return $next($request);
        });
    }

    public function index()
    {
        $shops = Shop::where('owner_id', Auth::id())->get();

        return view('owner.shops.index', compact('shops'));
    }

    public function edit($id)
    {
        $shop = Shop::findOrFail($id);

        return view('owner.shops.edit', compact('shop'));
    }

    public function update(UploadImageRequest $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'information' => ['required', 'string', 'max:255'],
            'is_selling' => ['required'],
        ]);

        $shop = Shop::findOrFail($id);
        $shop->name = $request->name;
        $shop->information = $request->information;
        $shop->is_selling = $request->is_selling;

        $imageFile = $request->image;
        if (!is_null($imageFile) && $imageFile->isValid()) {
            $fileNameToStore = ImageService::upload($imageFile, 'shops');
            $shop->filename = $fileNameToStore;
        }

        $shop->save();

        return redirect()->route('owner.shops.index')
            ->with(['message' => 'Update Succesful!', 'status' => 'info']);
    }
}
