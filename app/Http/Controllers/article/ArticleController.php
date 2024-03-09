<?php

namespace App\Http\Controllers\article;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles  = Article::latest()->paginate(5);
        $categories = Category::all();

        // store the filtered url's state as session variable
        Session::put('pre_url', request()->fullUrl());

        return view('articles.index', ['articles' => $articles, 'categories' => $categories, 'filtered' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view("articles.add", ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = new Article();

        $article->title = $request->title;
        $article->body = $request->body;
        $article->slug = strtolower(str_replace(' ', '-', $request->title));
        $article->category_id = $request->category_id;

        $article->save();

        return redirect(route('articles.index', $article))->with('message', 'An Article created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('articles.detail', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $categories = Category::all();

        return view('articles.edit', ['article' => $article, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article->update([
            'title' => $request->title,
            'slug' => strtolower(str_replace(' ', '-', $request->title)),
            'body' => $request->body,
            'category_id' => $request->category_id
        ]);

        // if (session('pre_url')) {
        //     return redirect(session('pre_url'));
        // }

        return redirect(route('articles.show', $article))->with('message', 'An Article updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        if (session('pre_url')) {
            return redirect(session('pre_url'))->with('message', 'An Article deleted successfully');
        }

        return redirect(route('articles.index'))->with('message', 'An Article deleted successfully');
    }
}
