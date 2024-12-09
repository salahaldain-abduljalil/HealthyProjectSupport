<?php

namespace App\Http\Controllers;

use App\Models\Blogpost;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BlogController extends Controller
{
    public function getAllArticles()
    {
        $blogposts = Blogpost::where('user_id', Auth::user()->id)->get();
        return view('Backend.allarticles', compact('blogposts'));
    }

    public function CreateArticle()
    {

        return view('Backend.createarticles');
    }

    public function StoreArticle(Request $request)
    {
        if ($request->file('post_image')) {
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $request->file('post_image')->getClientOriginalExtension();
            $img = $manager->read($request->file('post_image'));
            $img = $img->resize(370, 247);
            $img->toJpeg(80)->save(base_path('public/upload/post/' . $name_gen));
            $save_url = 'upload/post/' . $name_gen;

            Blogpost::insert([
                'user_id'  => $request->user_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'long_descp' => $request->long_descp,
                'post_tags' => $request->post_tags,
                'post_image' => $save_url,
                'status' => $request->status,
                'created_at' => Carbon::now(),

            ]);
        }
        //end if.

        $notification = array(
            'message' => 'تم إنشاء مقالتك بنجاح',
            'alert-type' => 'success',
        );
        return redirect()->route('get.allarticles')->with($notification);
    }

    public function getArticletoEdit($id)
    {

        $blogposts = Blogpost::find($id);

        return view('Backend.editarticle', compact('blogposts'));
    }

    public function updateArticle(Request $request)
    {

        $post_id = $request->id;

        if ($request->file('post_image')) {
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $request->file('post_image')->getClientOriginalExtension();
            $img = $manager->read($request->file('post_image'));
            $img = $img->resize(370, 247);
            $img->toJpeg(80)->save(base_path('public/upload/post/' . $name_gen));
            $save_url = 'upload/post/' . $name_gen;

            Blogpost::find($post_id)->update([
                'id'      => $request->id,
                'user_id'  => $request->user_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'long_descp' => $request->long_descp,
                'post_tags' => $request->post_tags,
                'post_image' => $save_url,
                'status' => $request->status,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'تم تحديث مقالتك بنجاح',
                'alert-type' => 'success'
            );
            return redirect()->route('get.allarticles')->with($notification);
        } else {

            BlogPost::find($post_id)->update([
                'id'      => $request->id,
                'user_id'  => $request->user_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'long_descp' => $request->long_descp,
                'post_tags' => $request->post_tags,
                'status' => $request->status,
                'created_at' => Carbon::now(),

            ]);

            $notification = array(
                'message' => 'تم تحديث مقالتك بنجاح',
                'alert-type' => 'success'
            );
            return redirect()->route('get.allarticles')->with($notification);
        }
        // end else
    }

    public function DeleteArticle($id)
    {
        $item = BlogPost::find($id);
        $img = $item->post_image;
        unlink($img);

        BlogPost::find($id)->delete();

        $notification = array(
            'message' => 'تم حذف مقالتك بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function BlogDetails($slug)
    {

        $blog = BlogPost::where('post_slug', $slug)->first();
        $tags = $blog->post_tags;
        $tags_all = explode(',', $tags);
        $posts = BlogPost::latest()->limit(3)->get();
        return view('frontend.blog.blog_details', compact('blog', 'tags_all',  'posts'));
    }

    function sendComment(Request $request)
    {

        $request->validate([
            'temporaryMsgId' => ['required'],
        ]);

        $comments = new Comment();
        $comments->user_id = $request->user_id;
        $comments->post_id = $request->post_id;
        $comments->long_descp = $request->long_descp;
        $comments->save();

        $posts = Comment::with('posts')->where('post_id',$request->post_id)->count();

        return response()->json([
            'comment' => $this->commentCard($comments),
            'tempID' => $request->temporaryMsgId,
            'totalcomment' => $posts,
        ]);
    }

    function commentCard($comments)
    {
        return view('frontend.blog.comment_card', compact('comments'))->render();
    }


}
