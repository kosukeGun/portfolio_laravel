<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;
use App\Models\Tag;
use App\Models\Title;
use App\Models\Image;

// モデルに相当するファイルのパスを指定する

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //メモ一覧を取得
        $user = \Auth::user();
        //ASC:昇順、DESC:降順
        $memos = Memo::where("user_id",$user["id"])->where("status",1)->orderBy("updated_at","DESC")->get();
        // dd($memos);
        return view('create',compact("user","memos"));
    }

    public function create()
    {
        //ログインしているユーザ
        $user = \Auth::user();
        $memos = Memo::where("user_id",$user["id"])->where("status",1)->orderBy("updated_at","DESC")->get();
        return view('create',compact("user","memos"));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);//デバッグ関数
        // POSTされたデータをDB（memosテーブル）に挿入
        // MEMOモデルにDBへ保存する命令を出す


        //同じタグがあるか確認
        $exist_tag=Tag::where("name",$data["tag"])->where("user_id",$data["user_id"])->first();
        // dd($exist_tag);
        // whereを使って条件を絞る（第一引数：対象のカラム　第二引数：条件となる値）
        // 

        if(empty($exist_tag["id"]))// $exist_tag["id"]が空である場合は新たにデータを挿入する
        {
            $tag_id=Tag::insertGetId(["name"=>$data["tag"],"user_id"=>$data["user_id"]]);
        }
        else // 既に同じユーザにおいて同じタグが存在する場合はそれを使う 
        {
            $tag_id=$exist_tag["id"];

        }

        $title_id=Title::insertGetId(["name"=>$data["title"],"user_id"=>$data["user_id"]]);

        $image = $request->file("sample_image");

        if($request->hasFile("sample_image"))
        {
            $path = \Storage::put("/public",$image);
            $path = explode("/",$path);
        }
        else
        {
            $path = null;
        }


        //先にタグをインサート
        
        // dd($tag_id);

        
        //タグのIDが判明する
        // タグIDをmemosテーブルに入れてあげる
        $memo_id = Memo::insertGetId(['content' => $data['content'],'user_id' => $data['user_id'],"tag_id"=>$tag_id, "title_id"=>$title_id,"image" => $path[1], 'status' => 1]);
        
        // リダイレクト処理
        return redirect()->route('home');
    }

    public function edit($id){
        $user = \Auth::user();
        $memo = Memo::where('status',1)->where('id',$id)->where('user_id',$user["id"])->first();

        // dd($memo);

        $memos = Memo::where("user_id",$user["id"])->where("status",1)->orderBy("updated_at","DESC")->get();

        $tags = Tag::where("user_id",$user["id"])->get();

        $title = Title::where("user_id",$user["id"])->where("id",$memo["title_id"])->get();

        

        return view("edit",compact("memo","user","memos","tags","title"));
        // 変数をviewへ受け渡す関数

        
    }

    public function update(Request $request, $id)// 優先度：POST >> GET
    {
        $inputs=$request->all();
        // dd($inputs);
        Memo::where("id",$id)->update(["content" => $inputs["content"],"tag_id"=>$inputs["tag_id"],"answer"=>$inputs["answer"]]);
        return redirect()->route("home");
    }

    public function delete(Request $request, $id)
    {
        $inputs = $request->all();

        Memo::where("id",$id)->update(["status" => 2]);

        return redirect()->route("home")->with("success","メモの削除が完了しました！");
    }

    public function upload()
    {
        $user = \Auth::User();
        // $memo = Memo::where('status',1)->where('id',$id)->where('user_id',$user["id"])->first();

        $memos = Memo::where("user_id",$user["id"])->where("status",1)->orderBy("updated_at","DESC")->get();



        return view("upload",compact("user","memos"));    
    }

}
