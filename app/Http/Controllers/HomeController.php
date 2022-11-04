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
use Illuminate\Support\Facades\Log;
use \InterventionImage;

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
        $memos_all = Memo::join("titles", "titles.id" ,"=", "memos.title_id")->join("users", "users.id", "=", "memos.user_id")->select("users.name as user_name", "titles.name as title_name", "memos.id as id", "titles.id as titles_id", "users.id as users_id", "image")->where("status",1)->get();
        // dd($memos);

        // dd($memos_all);

        $titles = Title::all();

        return view('questionList',compact("user","memos_all","titles","users"));
    }

    public function index2()
    {
        //メモ一覧を取得
        $user = \Auth::user();
        //ASC:昇順、DESC:降順
        $memos_noanswer = Memo::join("titles", "titles.id" ,"=", "memos.title_id")->join("users", "users.id", "=", "memos.user_id")->select("users.name as user_name", "titles.name as title_name", "memos.id as id", "titles.id as titles_id", "users.id as users_id", "image")->where("answer", 0)->where("status",1)->get();
        // dd($memos);

        $titles_noanswer = Title::all();

        return view('questionList2',compact("user","memos_noanswer","titles_noanswer"));
    }

    public function tag()
    {
        $tags_list = Tag::all();

        return view('tagList', compact("tags_list"));
    }

    public function myPage()
    {
        $user = \Auth::user();

        $problems = Problem::all();

        $memos_answered = Memo::select("memos.id as id", "titles.name as title_name", "image", "memos.updated_at as updated_at")->join("titles", "titles.id", "=", "memos.title_id")->where("memos.answer", 1)->where("memos.status", 1)->where("memos.user_id", $user["id"])->get();

        // dd($memos_answered);

        $titles = Title::all();

        $count_question = Memo::where("user_id", $user["id"])->count();

        $count_answer = Problem::where("user_id", $user["id"])->count();

        $review_average = round(Review::select()->join("problems", "problems.id", "=", "reviews.problem_id")->where("problems.user_id", $user["id"])->avg("reviews.point"),2,PHP_ROUND_HALF_UP);

        return view('myPage', compact("user","memos_answered" ,"count_question", "count_answer", "review_average", "titles"));
    }

    public function answerList()
    {
        $problems = Problem::join("users", "users.id", "=", "problems.user_id")->select("users.name as user_name", "problems.name as problem_name", "problems.id as id")->get();

        return view("answerList", compact("problems"));
    }

    public function answerDetail($id)
    {
        $problem = Problem::where("id", $id)->first();

        return view("answerDetail", compact("problem"));
    }

    public function create()
    {
        //ログインしているユーザ
        $user = \Auth::user();
        $memos = Memo::where("user_id",$user["id"])->where("status",1)->orderBy("updated_at","DESC")->get();
        $titles = Title::all();
        return view('create',compact("user","memos","titles"));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);//デバッグ関数
        // POSTされたデータをDB（memosテーブル）に挿入
        // MEMOモデルにDBへ保存する命令を出す

        $title_id=Title::insertGetId(["name"=>$data["title"]]);

        // $image_binary = InterventionImage::make($request->file('sample_image'))->resize(500,500);


        if($request->hasFile("sample_image"))
        {
            $image_binary = base64_encode(file_get_contents($request->file("sample_image")->getRealPath()));
            // $image_binary = base64_encode(file_get_contents($image_binary));
            // $image_binary_resize = InterventionImage::make($image_binary)->resize(100,100);
            // $image_binary = base64_encode(file_get_contents(InterventionImage::make($request->file("sample_image")->getRealPath())->resize(100,100)));
        }
        else
        {
            $image_binary = null;
        }

        // $image_binary = InterventionImage::make($image_binary)->resize(500,500);

        // InterventionImage::make($image_binary)->resize(600, 400)->save(public_path($request->file("sample_image")->getRealPath()) );
        InterventionImage::make($image_binary)->resize(200, 120);


        //先にタグをインサート
        
        // dd($tag_id);

        
        //タグのIDが判明する
        // タグIDをmemosテーブルに入れてあげる
        $memo_id = Memo::insertGetId(['content' => $data['content'],'user_id' => $data['user_id'], "title_id"=>$title_id,"image" => $image_binary, 'status' => 1]);
        
        // リダイレクト処理
        return redirect()->route('home')->with("success", "新規データが送信されました！");
    }

    public function edit($id){
        $user = \Auth::user();
        $memo = Memo::leftJoin("problems", "problems.id", "=", "memos.problem_id")->join("titles", "titles.id", "=", "memos.title_id")->select("memos.id as id", "problems.name as problem_name", "problems.explain as problem_explain", "problems.id as problems_id", "titles.id as titles_id", "titles.name as title_name", "content", "memos.tag_id as tag_id", "answer", "image")->where("status", 1)->where("memos.id", $id)->first();

        // $memo_null = Memo::join("titles", "titles.id", "=", "memos.title_id")->select("memos.id as id", "titles.id as titles_id", "titles.name as title_name", "content", "tag_id", "answer", "image")->where("status", 1)->where("memos.id", $id)->get();

        $tags = Tag::all();

        // dd($memo);
        // dd($memo_null);

        return view("edit",compact("memo","user","tags"));
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
        $exist_tag=Tag::where("name",$data["new_tag"])->first();
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

        return back();
    }

    public function ranking()
    {
        $users = User::all();

        $problems_rank = Review::select("problems.user_id as user_id", "users.name as user_name","users.name as user_name")->join("problems", "problems.id", "=", "reviews.problem_id")->join("users", "users.id", "=", "problems.user_id")->selectRaw("ROUND(AVG(reviews.point),1) as average")->groupBy("problems.user_id")->orderByRaw("average DESC")->get();

        // dd($problems_rank);

        return view("ranking", compact("problems_rank", "users"));
    }

    public function delete(Request $request, $id)
    {
        $inputs = $request->all();

        Memo::where("id",$id)->update(["status" => 2]);

        return redirect()->route("home")->with("danger","メモの削除が完了しました！");
    }

    public function review(Request $request, $id)
    {
        $data = $request->all();

        $user = \Auth::user();

        $exist_review = Review::where("problem_id" ,$id)->where("user_id", $user["id"])->first();

        if(empty($exist_review["id"]))
        {
            Review::insertGetId(["point"=>$data["review_point"], "comment"=>$data["review_comment"], "problem_id"=>$id, "user_id"=>$user["id"]]);
        }
        else
        {
            Review::where("problem_id", $id)->where("user_id", $user["id"])->update(["point" => $data["review_point"], "comment" => $data["review_comment"]]);
        }

        return back()->with("review_success", "レビューが完了しました！");
    }

    public function upload()
    {
        $user = \Auth::User();
        // $memo = Memo::where('status',1)->where('id',$id)->where('user_id',$user["id"])->first();

        $memos = Memo::where("status",1)->orderBy("updated_at","DESC")->get();



        return view("upload",compact("user","memos"));    
    }

}
