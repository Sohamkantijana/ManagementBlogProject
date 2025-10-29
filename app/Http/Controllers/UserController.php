<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
class UserController extends Controller
{
    public function showDataInHome(){
        $post = Post::all();
        return view('home',compact('post'));

    }
    public function showFullPost($id){
        $post=Post::findOrFail( $id );
        return view('fullpost',compact('post'));

    }
    public function index(Request $request){
        if($request->user()->usertype == 'admin'){
            return view('admin.dashboard');
            
        }
        else{
            return redirect()->route('dashboard');
        }
        
        

    }
    public function home(Request $request){
        if($request->user()->usertype == 'user'){
            return view('dashboard');
            
        }
        else{
            return redirect()->route('admin.dashboard');
        }
    

        
        
    }
    public function downloadSinglePost($id)
    {
        $posts = \App\Models\Post::all(); // Get all posts
        $filename = 'posts_' . now()->format('Y-m-d_H-i-s') . '.csv';
        $headers = [
        "Content-Type" => "text/csv",
        "Content-Disposition" => "attachment; filename={$filename}",
       ];
       $columns = ['ID', 'Title', 'Description', 'Image', 'User Name', 'User ID', 'Created At'];
       $callback = function() use ($posts, $columns) {
        

        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);
        foreach ($posts as $post) {
            fputcsv($file, [
                $post->id,
                $post->title,
                $post->description,
                $post->image,
                $post->user_name,
                $post->user_id,
                $post->created_at
            ]);
        }
        fclose($file);
    };

    return response()->stream($callback, 200, $headers);




    }


    



}