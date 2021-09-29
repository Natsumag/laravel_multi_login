<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Http\Requests\UploadImageRequest;
use App\Models\Product;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');

        // 他のショップ情報にアクセスすると404に遷移
        $this->middleware(function ($request, $next) {
            $parameterId = $request->route()->parameter('image');
            if (!is_null($parameterId)) {
                $imagesOwnerId = Image::findOrFail($parameterId)->owner->id;
                $imageId = (int)$imagesOwnerId;
                if ($imageId !== Auth::id()) {
                    abort(404);
                }
            }
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::where('owner_id', Auth::id())
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('owner.images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owner.images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadImageRequest $request)
    {
        $fileImages = $request->file('files');
        foreach ($fileImages as $fileImage) {
            $fileNameToStore = ImageService::upload($fileImage, 'products');
            Image::create([
               'owner_id' => Auth::id(),
                'filename' => $fileNameToStore
            ]);
        }

        return redirect()->route('owner.images.index')
            ->with(['message' => 'Create Succesful!', 'status' => 'info']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = Image::findOrFail($id);

        return view('owner.images.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'string|max:50'
        ]);
        $image = Image::findOrFail($id);

        $image->title = $request->title;

        $image->save();

        return redirect()->route('owner.images.index')
            ->with(['message' => 'Update Succesful!', 'status' => 'info']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::findOrFail($id);

        $imageInProducts = Product::where('image_id', $image->id)->get();
        // ->orWhere('image2', $image->id)
        // ->orWhere('image3', $image->id)
        // ->orWhere('image4', $image->id)

        if ($imageInProducts) {
            $imageInProducts->each(function($product) use($image) {
                if ($product->image_id === $image->id) {
                    $product->image_id = null;
                    $product->save();
                }
                // if ($product->image2 === $image->id) {
                //     $product->image2 = null;
                //     $product->save();
                // }
                // if ($product->image3 === $image->id) {
                //     $product->image3 = null;
                //     $product->save();
                // }
                // if ($product->image4 === $image->id) {
                //     $product->image4 = null;
                //     $product->save();
                // }
            });
        }

        $filePath = 'public/products/' . $image->filename;


        Storage::delete($filePath);

        Image::findOrFail($id)->delete();

        return redirect()
            ->route('owner.images.index')
            ->with(['message' => 'Delete Succesful!', 'status' => 'alert']);
    }
}
