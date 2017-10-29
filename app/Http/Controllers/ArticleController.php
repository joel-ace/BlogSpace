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
            'request' => $request
        ]);
    }

    public function createArticle(Request $request) {
        $this->validate($request, [
            'title' => 'required|min:5',
            'cat_id' => 'required|integer',
            'content' => 'required|min:10',
        ]);

        $user = Auth::user();
        $slug = str_slug($request->input('title'), '-');

        $slugs = Article::whereSlug($slug)->count();

        $post = new Article([
            'title' => $request->input('title'),
            'cat_id' => $request->input('cat_id'),
            'content' => $request->input('content'),
            'slug' => $slug
        ]);

        $user->posts()->save($post);

        return redirect()
            ->back()
            ->with('success', 'Post successfully created!');
    }


}
