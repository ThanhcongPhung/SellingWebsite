<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use Image;
class BannersController extends Controller
{
    public function addBanner(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->all();
    		//echo "<pre>"; print_r($data); die;
    		$banner = new Banner;
			$banner->title = $data['title'];
			$banner->link = $data['link'];
            if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }
			// Upload Image
            if($request->hasFile('image')){
            	$image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
	                $fileName = rand(111,99999).'.'.$extension;
                    $banner_path = 'images/frontend_images/banners/'.$fileName;
     				Image::make($image_tmp)->resize(1140, 340)->save($banner_path);
     				$banner->image = $fileName;
                }
            }
            $banner->status = $status;
			$banner->save();
			return redirect()->back()->with('flash_message_success', 'Banner has been added successfully');
    	}

    	return view('admin.banners.add_banner');
    }

    public function viewBanner(){
        $banners = Banner::get();
        return view('admin.banners.view_banners')->with(compact('banners'));
    }
}
