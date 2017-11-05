<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private function getAllArticles($maxPerPage) {
        return Article::manage()
            ->orderBy('created_at', 'desc')
            ->paginate($maxPerPage);
    }

    public function getAllCategories() {
        return Category::all();
    }

    public function listArticles(Request $request) {
        $queryString = $request->get('q');
        $categoryId = $request->get('cat_id');
        $publishStatus = $request->get('pub_status');
        $featuredStatus = $request->get('feat_status');

        $categories = $this->getAllCategories();
        $articles = $this->getAllArticles(3);

        // Handles querying for search
        if($queryString) {
            $articles = Article::adminSearch($request->input('q'))->paginate(1);

            if(!$articles) {
                return redirect()
                    ->back()
                    ->with('info', 'No results found for your search');
            }

            return view('admin.articles.manage', compact(['articles', 'categories', 'queryString']));
        } elseif($categoryId || $publishStatus || $featuredStatus) {
            $articles = Article::sortArticles($categoryId, $publishStatus, $featuredStatus)->paginate(3);
            return view('admin.articles.manage', compact([
                'articles', 'categories', 'categoryId', 'publishStatus', 'featuredStatus'
            ]));
        }

        return view('admin.articles.manage', compact(['articles', 'categories']));

    }

    public function createArticlePage(Request $request) {
        $category = $this->getAllCategories();
        return view('admin.articles.create', [
           'categories' => $category,
            'action' => 'create',
            'request' => $request,
        ]);
    }

    public function editArticlePage($id) {
        $category = $this->getAllCategories();

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
