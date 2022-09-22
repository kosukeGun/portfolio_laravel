<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Memo;
use App\Models\Tag;
use App\Models\Title;
use App\Models\Image;
use App\Models\Problem;
use App\Models\Review;

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

        $users = User::all();
        //ASC:昇順、DESC:降順
        $memos = Memo::where("user_id",$user["id"])->where("status",1)->orderBy("updated_at","DESC")->get();
        // dd($memos);

        $titles = Title::all();

        return view('questionList',compact("user","memos","titles","users"));
    }

    public function index2()
    {
        //メモ一覧を取得
        $user = \Auth::user();
        //ASC:昇順、DESC:降順
        $memos_noanswer = Memo::where("user_id",$user["id"])->where("status",1)->where("answer", 0)->orderBy("updated_at","DESC")->get();
        // dd($memos);

        $titles = Title::where("user_id",$user["id"])->get();

        return view('questionList2',compact("user","memos_noanswer","titles"));
    }

    public function tag()
    {
        $tags = Tag::all();

        return view('tagList', compact("tags"));
    }

    public function myPage()
    {
        $user = \Auth::user();

        $problems = Problem::all();

        $memos_answered = Memo::where("user_id", $user["id"])->where("answer",1)->where("status",1)->get();

        $titles = Title::all();

        $count_question = Memo::where("user_id", $user["id"])->count();

        $count_answer = Problem::where("user_id", $user["id"])->count();

        return view('myPage', compact("user","memos_answered" ,"count_question", "count_answer","titles"));
    }

    public function answerList()
    {
        $users = User::all();

        $problems = Problem::all();

        return view("answerList", compact("problems","users"));
    }

    public function create()
    {
        //ログインしているユーザ
        $user = \Auth::user();
        $memos = Memo::where("user_id",$user["id"])->where("status",1)->orderBy("updated_at","DESC")->get();
        $titles = Title::where("user_id",$user["id"])->get();
        return view('create',compact("user","memos","titles"));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);//デバッグ関数
        // POSTされたデータをDB（memosテーブル）に挿入
        // MEMOモデルにDBへ保存する命令を出す

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
        $memo_id = Memo::insertGetId(['content' => $data['content'],'user_id' => $data['user_id'], "title_id"=>$title_id,"image" => $path[1], 'status' => 1]);
        
        // リダイレクト処理
        return redirect()->route('home')->with("success", "新規データが送信されました！");
    }

    public function edit($id){
        $user = \Auth::user();
        $memo = Memo::where('status',1)->where('id',$id)->where('user_id',$user["id"])->first();

        // dd($memo);

        $memos = Memo::where("user_id",$user["id"])->where("status",1)->orderBy("updated_at","DESC")->get();

        $tags = Tag::where("user_id",$user["id"])->get();

        $title = Title::where("user_id",$user["id"])->where("id",$memo["title_id"])->get();

        $titles = Title::where("user_id",$user["id"])->get();

        $problems = Problem::all();

        return view("edit",compact("memo","user","memos","tags","title","titles","problems"));
        // 変数をviewへ受け渡す関数

        
    }

    public function update(Request $request, $id)// 優先度：POST >> GET
    {
        $inputs=$request->all();
        // dd($inputs);
        $user = \Auth::user();

        //同じタグがあるか確認
        $exist_problem=Problem::where("name",$inputs["problem"])->where("explain", $inputs["explain"])->where("user_id",$user["id"])->first();
        // dd($exist_tag);
        // whereを使って条件を絞る（第一引数：対象のカラム　第二引数：条件となる値）
        // 

        if(empty($exist_problem["id"]))// $exist_tag["id"]が空である場合は新たにデータを挿入する
        {
            $problem_id=Problem::insertGetId(["name"=>$inputs["problem"], "explain"=>$inputs["explain"], "user_id"=>$user["id"]]);
        }
        else // 既に同じユーザにおいて同じタグが存在する場合はそれを使う 
        {
            $problem_id=$exist_problem["id"];

        }

        Memo::where("id",$id)->update(["content" => $inputs["content"],"tag_id"=>$inputs["tag_id"], "problem_id"=>$problem_id, "answer"=>$inputs["answer"]]);
        return redirect()->route("home")->with("primary", "更新が完了しました！");
    }

    public function addTag(Request $request)
    {
        $data = $request->all();

        $user = \Auth::user();

        //同じタグがあるか確認
        $exist_tag=Tag::where("name",$data["new_tag"])->where("user_id",$user["id"])->first();
        // dd($exist_tag);
        // whereを使って条件を絞る（第一引数：対象のカラム　第二引数：条件となる値）
        // 

        if(empty($exist_tag["id"]))// $exist_tag["id"]が空である場合は新たにデータを挿入する
        {
            $tag_id=Tag::insertGetId(["name"=>$data["new_tag"],"user_id"=>$user["id"]]);
        }
        else // 既に同じユーザにおいて同じタグが存在する場合はそれを使う 
        {
            $tag_id=$exist_tag["id"];

        }
        

        // Tag::insertGetId(["name"=>$data["new_tag"],"user_id"=>$user["id"]]);

        return redirect("/tagList");
    }

    public function delete(Request $request, $id)
    {
        $inputs = $request->all();

        Memo::where("id",$id)->update(["status" => 2]);

        return redirect()->route("home")->with("danger","メモの削除が完了しました！");
    }

    public function upload()
    {
        $user = \Auth::User();
        // $memo = Memo::where('status',1)->where('id',$id)->where('user_id',$user["id"])->first();

        $memos = Memo::where("user_id",$user["id"])->where("status",1)->orderBy("updated_at","DESC")->get();



        return view("upload",compact("user","memos"));    
    }

}
