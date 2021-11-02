<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function BrandView(){
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view', compact('brands'));
    }

    public function BrandStore(Request $request){
        $request->validate([
            'brand_name_en' => 'required',
            'brand_name_pl' => 'required',
            'brand_image' => 'required',
        ],[
            'brand_name_en.required' => 'Input Brang English Name',
            'brand_name_pl.required' => 'Input Brang Polish Name',
        ]);

        $image = $request->file('brand_image');
        $name_en = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/brand/' . $name_en);
        $save_url = 'upload/brand/' . $name_en;

        Brand::insert([
            'brand_name_en' => $request->brand_name_en,
            'brand_name_pl' => $request->brand_name_pl,
            'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
            'brand_slug_pl' => strtolower(str_replace(' ', '-', $request->brand_name_pl)),
            'brand_image' => $save_url,
        ]);
        $notifaction = array(
            'message' => 'Brand Inserted Succesfully',
            'alert-type' => 'success'
            );
        return redirect()->back()->with($notifaction);

    } // end method

    public function BrandEdit($id){
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }

    public function BrandUpdate(Request $request) {
        $brand_id = $request->id;
        $old_img = $request->old_image;

            if ($request->file('brand_image')) {

                unlink($old_img);
                $image = $request->file('brand_image');
                $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
                $save_url = 'upload/brand/'.$name_gen;

                Brand::findOrFail($brand_id)->update([
                    'brand_name_en' => $request->brand_name_en,
                    'brand_name_pl' => $request->brand_name_pl,
                    'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                    'brand_slug_pl' => str_replace(' ', '-', $request->brand_name_pl),
                    'brand_image' => $save_url,
                ]);
                $notifaction = array(
                    'message' => 'Brand Upadated Succesfully',
                    'alert-type' => 'info'
                    );
                return redirect()->route('all.brand')->with($notifaction);
            }else{
                Brand::findOrFail($brand_id)->update([
                    'brand_name_en' => $request->brand_name_en,
                    'brand_name_pl' => $request->brand_name_pl,
                    'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                    'brand_slug_pl' => str_replace(' ', '-', $request->brand_name_pl),
                ]);
                $notifaction = array(
                    'message' => 'Brand Upadated Succesfully',
                    'alert-type' => 'info'
                    );
                return redirect()->route('all.brand')->with($notifaction);
            }   // end else

    } //end method

    public function BrandDelete($id){

        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img);

        Brand::findOrFail($id)->delete();
        $notifaction = array(
            'message' => 'Brand Deleted Succesfully',
            'alert-type' => 'info'
            );
            return redirect()->back()->with($notifaction);

    }


}
