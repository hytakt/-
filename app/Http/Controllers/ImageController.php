<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cloudinary;
use App\Models\Image;
use App\Models\Post;

class ImageController extends Controller
{
    public function destroy($image)
    {
        // 画像をデータベースから削除
        $imageModel = Image::find($image);
        if (!$imageModel) {
            return back()->with('error', '画像が見つかりませんでした。');
        }
    
        $imagePath = $imageModel->image_path;
        $imageModel->delete();
    
        // Cloudinaryなどのストレージから画像を削除
        // この部分はCloudinary APIなどのストレージに応じてカスタマイズが必要です
    
        // 削除が成功したらリダイレクト
        return redirect()->back()->with('success', '画像が削除されました。');
    }
}

