<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\BinaryOp\Mul;

class MusicController extends Controller
{
    Public function musicShow(){
        $categories = Music::all();
        $categories = Music::paginate(4);
        return view('Music', compact('categories'));
    }

    public function Categuary(Request $request){
        $request->validate([
           'category_name' => 'required',
           'category_image'=>'required',
           'status'=>'required',

        ]);
        if($request->hasFile('category_image')){
            $getfile = $request->category_image;
            $changename = time().'.'.$getfile->getClientOriginalExtension();
            $getfile->move(public_path('CategouryImage'), $changename);
          }

        $model = new Music();
        $model->name = $request->category_name;
        $model->categaury_image =$changename;
        $model->status = $request->status;
        $model->save();
        return redirect()->back()->with('success','Your post is uploaded successfully');
    }

    public function delete($id){
        $iddetele = Music::find($id);

        if ($iddetele) {

            $imagePath = public_path('storage/category_images/' . $iddetele->categaury_image);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $iddetele->delete();

            return redirect()->back()->with('success', "Music Post is deleted Successfully");
        } else {
            return redirect()->back()->withErrors('Data is Not Found');
        }
    }

    public function Music(Request $request ,$id=null){
        $categories = Music::all();
        $music = $id ? Music::find($id) : null;
        return view('Music', compact('categories', 'music'));
    }

    public function edit($id){
        $music = Music::find($id);
        if (!$music) {
            return redirect()->back()->withErrors('Category not found');
        }

        $categories = Music::all();
        return view('Music', compact('music', 'categories'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'category_name' => 'required',
            'status' => 'required',
        ]);

        $music = Music::find($id);
        if (!$music) {
            return redirect()->back()->withErrors('Category not found');
        }


        if ($request->hasFile('category_image')) {

            $oldImagePath = public_path('storage/category_images/' . $music->categaury_image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }


            $getImage = $request->file('category_image');
            $getNewName = time().'.'.$getImage->getClientOriginalExtension();
            $getImage->storeAs('category_images', $getNewName, 'public');


            $music->categaury_image = $getNewName;
        }

        $music->name = $request->category_name;
        $music->status = $request->status;
        $music->save();

        return redirect()->route('addMusic')->with('success', 'Category Updated Successfully');
    }

}
