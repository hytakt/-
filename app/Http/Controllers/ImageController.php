<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Support\Facades\Redirect;
use Cloudinary\Uploader;

class ImageController extends Controller
{
   

    public function destroy(Request $request, Image $image)
    {
        // CloudinaryのパブリックIDを取得
        $publicId = pathinfo($image->image_path, PATHINFO_FILENAME);
    
        // Cloudinaryから画像を削除
        try {
            $result = Uploader::destroy($publicId);
    
            // 削除が成功した場合
            if ($result["result"] === "ok") {
                // データベースから画像を削除
                $image->delete();
                return redirect()->back()->with('success', '画像が削除されました。');
            } else {
                return redirect()->back()->with('error', 'Cloudinaryで画像を削除できませんでした。');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '画像の削除中にエラーが発生しました。');
        }
    }

}

