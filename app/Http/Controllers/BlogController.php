<?php

namespace App\Http\Controllers;

use App\Models\Blogpost;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BlogController extends Controller {
    public function getAllArticles() {
        $blogposts = Blogpost::where( 'user_id', Auth::user()->id )->get();
        return view( 'Backend.allarticles', compact( 'blogposts' ) );
    }

    public function CreateArticle() {

        return view( 'Backend.createarticles' );
    }

    public function StoreArticle( Request $request ) {
        if ( $request->file( 'post_image' ) ) {
            $manager = new ImageManager( new Driver() );
            $name_gen = hexdec( uniqid() ) . '.' . $request->file( 'post_image' )->getClientOriginalExtension();
            $img = $manager->read( $request->file( 'post_image' ) );
            $img = $img->resize( 370, 247 );
            $img->toJpeg( 80 )->save( base_path( 'public/upload/post/' . $name_gen ) );
            $save_url = 'upload/post/' . $name_gen;

            Blogpost::insert( [
                'user_id'  => $request->user_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower( str_replace( ' ', '-', $request->post_title ) ),
                'long_descp' => $request->long_descp,
                'post_tags' => $request->post_tags,
                'post_image' => $save_url,
                'status' => $request->status,
                'created_at' => Carbon::now(),

            ] );
        }
        //end if.

        $notification = array(
            'message' => 'تم إنشاء مقالتك بنجاح',
            'alert-type' => 'success',
        );
        return redirect()->route( 'get.allarticles' )->with( $notification );
    }
}
