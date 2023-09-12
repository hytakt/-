<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Support\Facades\Redirect;
use Cloudinary\Uploader;

class ImageController extends Controller
{
   

    public function destroy($image)
    {
        $imageModel = Image::find($image);
        if (!$imageModel) {
            return back()->with('error', '画像が見つかりませんでした。');
        }
        
        $imagePath = $imageModel->image_path;
        $imageModel->delete();
    
            return redirect()->back()->with('success', '画像が削除されました。');
    }

}

