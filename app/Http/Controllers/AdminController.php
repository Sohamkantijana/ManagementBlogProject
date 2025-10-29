<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    //
    public function addpost(){
        return view('admin.add_post');
    }
    public function createpost(Request $request){




        $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpg,jpeg,png|max:1024',
        ]);
        if ($request->file('image')->getSize() < 100 * 1024) {
        // For AJAX, return JSON instead of redirect
            return response()->json([
            'success' => false,
            'message' => 'Image must be at least 100 KB.'
            ], 422);
        }

        

        $post=new post();
        $post->title = $request->title;
        $post->description = $request->description;
        $image = $request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        
        $post->image = $imagename;
        $post->user_name= Auth::User()->name;
        $post->user_id= Auth::User()->id;
        $saved = $post->save();
        if ($saved) {

            $request->image->move(public_path('img'), $imagename);
        }
        
        return response()->json([

            'success' => true,
            'message' => 'Post Created Successfully',
            'data' => $post
        ]);




    }
    public function allpost(){
        $post = Post::paginate(10);
        $totalPosts = Post::count();
        return view('admin.allpost', compact('post', 'totalPosts'));
    }
    public function updatePost($id){
        $post=Post::findOrFail($id);
        return view('admin.updatepost',compact('post'));

    }


    public function postupdate(Request $request, $id){

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->description = $request->description;


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->getSize() < 100 * 1024) {
                return response()->json([
                    'success' => false,
                    'message' => 'Image must be at least 100 KB.'
                ], 422);
            }

            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $post->image = $imagename;

            $image->move(public_path('img'), $imagename);
        }

        $post->user_name = Auth::user()->name;
        $post->user_id = Auth::user()->id;

        $post->save();

        return response()->json([
            'success' => true,
            'message' => 'Post Updated Successfully',
            'data' => $post
        ]);
    }







    public function deletePost($id){

        $post = Post::findOrFail($id);
        if(file_exists(public_path('img/'.$post->image))){
            unlink(public_path('img/'.$post->image));
        }

    // Delete post from database
        $post->delete();

    // For AJAX request, return JSON
        return response()->json([

            'success' => true,
            'message' => 'Post deleted successfully'
        ]);
    }

}
