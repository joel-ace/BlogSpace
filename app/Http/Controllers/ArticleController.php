<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private function getArticles($maxPerPage) {
        return Article::manage()
            ->orderBy('created_at', 'desc')
            ->paginate($maxPerPage);
    }

    public function listArticles() {
        $category = Category::all();;
        return view('admin.articles.manage', [
            'articles' => $this->getArticles(3),
            'categories' => $category
        ]);
    }

    public function createArticlePage(Request $request) {
        $category = Category::all();
        return view('admin.articles.create', [
           'categories' => $category,
            'action' => 'create',
            'request' => $request,
        ]);
    }

    public function editArticlePage($id) {
        $category = Category::all();

        $article = Article::find($id);

        return view('admin.articles.create', [
            'categories' => $category,
            'action' => 'edit',
            'article' => $article
        ]);
    }

    public function deleteArticle($id) {
        $article = Article::find($id);

        if($article) {
            $article->delete();
            return redirect()
                ->back()
                ->with('success', 'Article successfully deleted');
        }

        return redirect()
            ->back()
            ->with('error', 'This article does not exist or has been previously deleted');
    }

    public function createArticle(Request $request) {
        $this->validate($request, [
            'title' => 'required|min:5',
            'cat_id' => 'required|integer',
            'content' => 'required|min:10',
            'status' => 'required|integer',
        ]);

        $user = Auth::user();

        $post = new Article([
            'title' => $request->input('title'),
            'cat_id' => $request->input('cat_id'),
            'content' => $request->input('content'),
            'status' => $request->input('status'),
        ]);

        $user->posts()->save($post);

        return redirect()
            ->back()
            ->with('success', 'Article successfully created!');
    }

    public function editArticle(Request $request) {
        $this->validate($request, [
            'title' => 'required|min:5',
            'cat_id' => 'required|integer',
            'content' => 'required|min:10',
            'status' => 'required|integer',
        ]);

        $article = Article::find($request->input('id'));
        $articleEditor = $user = Auth::user();

        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->cat_id = $request->input('cat_id');
        $article->status = $request->input('status');
        $article->last_modified_by = $articleEditor->id;

        $article->save();

        return redirect()
            ->back()
            ->with('success', 'Article successfully edited');

    }

}
