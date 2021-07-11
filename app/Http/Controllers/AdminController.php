<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as Image;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Models\Post;
use App\Models\SiteSetting;
use DB;
use File;


class AdminController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        $new_users = User::latest()->get();
        $orders = Transaction::all();
        $pending_orders = Transaction::where('status','pending')->get();
        $posts = Post::latest()->take(5)->get();

        return view('dashboard',['users' => $users, 'new_users' => $new_users, 'orders' => $orders,'pending_orders' => $pending_orders,'posts' => $posts]);

    }

    //USERS

    public function users()
    {
        $users = DB::table('users')
                    ->join('wallets','users.id','=','wallets.user_id')
                    ->where('role','<>', 2)->get();
        return view('pages.backend.users',['users' => $users]);
    }

    public function updateUserShow(Request $request,$id)
    {
        $user = User::where('id',$id)->first();
        return view('pages.backend.update-user',['user' => $user]);
    }

    public function saveUser(Request $request)
    {
        $id = $request->id;
        User::where('id',$id)->update([
            'user_type' => $request->user_type,
            'name' => $request->name,
            'email' => $request->email,
            'state' =>  $request->state,
            'phone' => $request->phone
        ]);
        $message = "<div class='alert alert-success'>User Updated Successfully</div>";

        return redirect()->back()->with('message',$message);
    }

    public function topupUserShow(Request $request, $id)
    {
        $user_id = $request->id;
        $wallet = Wallet::where('user_id',$user_id)->first();
        return view('pages.backend.topup',['wallet' => $wallet]);
    }
    public function topup(Request $request)
    {
        $user_id = $request->user_id;
        $user_wallet = Wallet::where('user_id',$user_id)->first();
        $user_balance = $user_wallet->amount;

        Wallet::where('user_id',$user_id)->update(['amount' => $user_balance+$request->amount]);
        $message = "<div class='alert alert-success'>Topup Successful</div>";

        return redirect()->back()->with('message',$message);
    }

    public function destroyUser(Request $request)
    {
        // $delete_id = $request->delete_id;
        // $post = Post::where('id',$delete_id)->first();
        // @unlink('/uploads/post_images/'.$post->featured_image);
        // Comment::where('post_id',$post->id)->delete();
        // PostView::where('post_id',$post->id)->delete();
        // Post::where('id',$delete_id)->delete();

          

        $id = $request->delete_id;
        Wallet::where('user_id',$id)->delete();
        User::where('id',$id)->delete();
        $result = '{"message": "User Deleted Successfully"}';       
        $result = json_decode($result);
        return response()->json(['result' => $result]);

    }

//TRANSACTIONS
    public function getTransactions()
    {
        $transactions = Transaction::orderby('created_at','desc')->get();
        return view('pages.backend.manage-transactions',['transactions' => $transactions]);
    }

    public function destroyTransaction(Request $request)
    {
        $id = $request->delete_id;
        Transaction::where('id',$id)->delete();
        $result = '{"message": "Transaction Deleted Successfully"}';       
        $result = json_decode($result);
        return response()->json(['result' => $result]);
    }

    //POSTS

    public function getPosts()
    {
        $posts = Post::all();
        return view('pages.backend.manage-posts',['posts' => $posts]);
    }

    public function addPost(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|unique:posts,title',
            'author' => 'required',
            'body' => 'required'
        ]);

        $author = $request->author;
        $title = $request->title;
        $body =  $request->body;
        $featured_image = $request->featured_image;

        if(isset($featured_image) == true){
            $featured = Str::random(30). '.' . $featured_image->getClientOriginalExtension();
            $path = public_path('uploads/post_images/'. $featured);
            Image::make($featured_image->getRealPath())->resize(800, 500)->save($path);
        }else{
            $featured = NULL;
        }

        Post::create([
            'title' => $title,
            'slug' => Str::slug($title,'-'),
            'body' => $body,
            'author' => $author,
            'featured_image' => $featured,
        ]);
        $message = "<div class='alert alert-success'>Post Created successfully.</div>";
        
        return redirect()->back()->with('message',$message);

    }

    public function updatePostShow($id)
    {
        $post = Post::findOrFail($id);
        return view('pages.backend.update-post',['post' => $post]);
    }

    public function savePost(Request $request)
    {
        $post_id = $request->post_id;
        $author = $request->author;
        $title = $request->title;
        $body =  $request->body;
        $featured_image = $request->featured_image;
        $post_image = Post::where('id',$post_id)->first();
        //dd($post_image->featured_image);
        if(isset($featured_image) == true){
            File::delete(public_path('/uploads/post_images/'.$post_image->featured_image));
            $featured = Str::random(30). '.' . $featured_image->getClientOriginalExtension();
            $path = public_path('uploads/post_images/'. $featured);
            Image::make($featured_image->getRealPath())->resize(800, 500)->save($path);
            Post::where('id',$post_id)->update([
                'title' => $title,
                'slug' => Str::slug($title,'-'),
                'body' => $body,
                'author' => $author,
                'featured_image' => $featured,
            ]);
        }else{
            Post::where('id',$post_id)->update([
                'title' => $title,
                'slug' => Str::slug($title,'-'),
                'body' => $body,
                'author' => $author,
            ]);
        }
        $message = "<div class='alert alert-success'>Post Saved successfully.</div>";

        return redirect('/admin/post')->with('message',$message);
    }

    public function destroyPost(Request $request)
    {
        $delete_id = $request->delete_id;
        $post = Post::where('id',$delete_id)->first();
        File::delete(public_path('/uploads/post_images/'.$post->featured_image));
        Post::where('id',$delete_id)->delete();

        $result = '{"message": "Posts Deleted Successfully"}';
        
        $result = json_decode($result);
        

        return response()->json(['result' => $result]);  
    }

    public function settings()
    {
        $settings = SiteSetting::where('name','<>','api_user_id')->where('name','<>','api_pass')->get();
        return view('pages.backend.settings',['settings' => $settings]);
    }

    public function updateSettings(Request $request)
    {
        $count_arr = count($request->name);
        $name = $request->name;
        $end_user_price = $request->end_user_price;
        $vendor_price = $request->vendor_price;
        $detail = $request->detail;

        for ($i=0; $i <$count_arr ; $i++) { 
            SiteSetting::where('name',$name[$i])->update([
                'end_user_price' => $end_user_price[$i],
                'vendor_price' => $vendor_price[$i],
                'detail' => $detail[$i]
            ]);
        }
        $message ="<div class='alert alert-success'>Settings saved successfully</div>";

        return redirect()->back()->with('message',$message);

    }
}
