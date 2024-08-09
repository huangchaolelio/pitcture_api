<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

use App\Models\Article;

class ArticleController extends Controller
{
    // 文章列表
    public function article()
    {
        $articles = Article::orderByDesc('orders')->paginate(15);
        Paginator::useBootstrapFive();

        return view('admin.article',array(
            'articles' => $articles
        ));
    }

    // 添加|编辑文章
    public function postArticle(Request $request)
    {
        $article = Article::find($request->id);

        return view('admin.post_article',array(
            'article' => $article
        ));
    }

    // 保存添加|编辑的文章内容
    public function saveArticle(Request $request)
    {
        if($request->id != '')
        {
            // 编辑文章内容
            $article = Article::find($request->id);

        } else {
            // 添加文章内容
            $article = new Article();
        }        

        $article->title = $request->title;
        $article->content = $request->content;
        $article->orders = $request->orders;
        $article->is_show = $request->is_show;
        $article->created_time = time();
        $article->updated_time = time();

        $article->save();

        // return '文章添加|编辑成功';
        return redirect('admin/article');
    }

    // 文章批量审核通过
    public function articleShowIds(Request $request)
    {
        $ids = $request->ids;
        $article = Article::whereIn('id', $ids)->update(['is_show'=> 1]);
        return ['code' => 1, 'msg' => '文章审核通过显示'];
    }

    // 文章批量审核隐藏
    public function articleHidenIds(Request $request)
    {
        $ids = $request->ids;
        $article = Article::whereIn('id', $ids)->update(['is_show'=> 0]);
        return ['code' => 1, 'msg' => '文章审核隐藏'];
    }

    // 设置是否启用状态
    public function articleStatus(Request $request)
    {
        $id = $request->id;
    
        $article = Article::find($id);

        if($article->is_show == 1)
        {
            $article->is_show = 0;
        } else {
            $article->is_show = 1;
        }
        
        $article->save();

        return redirect('admin/article');
    }

    // 文章批量删除
    public function articleDelIds(Request $request)
    {
        $ids = $request->ids;

        foreach($ids as $id)
        {

            $article = Article::where('id', $id)->first();

            // 删除数据表记录
            $article->delete();
        }

        return ['code' => 1, 'msg' => '文章批量删除成功'];
    }
}
