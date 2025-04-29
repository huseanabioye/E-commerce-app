<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Product;

class AdminController extends Controller
{
    public function  view_category()
    {
        $data = category::all();
        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request)
    {
        $category = new category;

        $category->category_name = $request->category;
        $category->save();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Category
        Added Successfully');

        return redirect()->back();
    }

    public function edit_category($id)
    {
        $data = category::find($id);
        return view('admin.edit_category',compact('data'));
    }

    public function update_category(Request $request, $id)
    {
         $data = category::find($id);

         $data->category_name= $request->category;

         $data->save();

         toastr()->timeOut(10000)->closeButton()->addSuccess('Category Update Successfully');

         return redirect('/view_category');
    }

    public function delete_category($id)
    {
        $data = category::find($id);
        $data->delete();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Category
        Deleted Successfully');


        return redirect()->back();
    }


    public function add_product()
    {
        $category = category::all();
        return view('admin.add_product', compact('category'));
    }

    public function upload_product(Request $request)
    {
        $data =new Product;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->qty;
        $data->category = $request->category;

        $image = $request->image;

        if($image)
        {
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $request->image->move('products',$imageName);

            $data->image = $imageName;
        }

        $data->save();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Category
        product Upload Successfully');

        return redirect()->back();
    }

      public function view_product()
      {
        $product = Product::paginate(4);
        return view('admin.view_product',compact('product'));
      }

      public function delete_product($id)
      {

        $data = product::find($id);

        // deleting image form public folder

        $image_path = public_path('products/'.$data->image);

        if(file_exists($image_path))
        {
            unlink($image_path);
        }

        $data->delete();

        return redirect()->back();
      }
}
