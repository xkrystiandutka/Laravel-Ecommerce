<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function CategoryView(){
        $category = Category::latest()->get();
        return view('backend.category.category_view', compact('category'));
    }

    public function CategoryStore(Request $request){
            $request->validate([
                'category_name_en' => 'required',
                'category_name_pl' => 'required',
                'category_icon' => 'required',
            ],[
                'category_name_en.required' => 'Input Category English Name',
                'category_name_pl.required' => 'Input Category Polish Name',
            ]);

            Category::insert([
                'category_name_en' => $request->category_name_en,
                'category_name_pl' => $request->category_name_pl,
                'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
                'category_slug_pl' => strtolower(str_replace(' ', '-', $request->category_name_pl)),
                'category_icon' => $request->category_icon,
            ]);
            $notifaction = array(
                'message' => 'Category Inserted Succesfully',
                'alert-type' => 'success'
                );
            return redirect()->back()->with($notifaction);

        }// end method

    public function CategoryEdit($id){
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }

    public function CategoryUpdate(Request $request ,$id){

        $request->validate([
            'category_name_en' => 'required',
            'category_name_pl' => 'required',
            'category_icon' => 'required',
        ],[
            'category_name_en.required' => 'Input Category English Name',
            'category_name_pl.required' => 'Input Category Polish Name',
        ]);

        Category::findOrFail($id)->update([
                'category_name_en' => $request->category_name_en,
                'category_name_pl' => $request->category_name_pl,
                'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
                'category_slug_pl' => strtolower(str_replace(' ', '-', $request->category_name_pl)),
                'category_icon' => $request->category_icon,
            ]);
            $notifaction = array(
                'message' => 'Category Update Succesfully',
                'alert-type' => 'success'
                );
            return redirect()->route('all.category')->with($notifaction);

    } //end method

    public function CategoryDelete($id){

        Category::findOrFail($id)->delete();
        $notifaction = array(
            'message' => 'Category Delete Succesfully',
            'alert-type' => 'error'
            );
        return redirect()->back()->with($notifaction);
    }
}
