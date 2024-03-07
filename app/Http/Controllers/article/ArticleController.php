<?php

namespace App\Http\Controllers\article;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles  = Article::latest()->paginate(5);
        return view('articles.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            ["id" => 1, "name" => "News"],
            ["id" => 2, "name" => "Tech"],
            ["id" => 3, "name" => "Football"],
            ["id" => 4, "name" => "Beauty"],
        ];
        return view("articles.add", ['categories' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator(request()->all(), [
            'title' => 'required|min:2',
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

        return redirect(route('articles.show', $article));
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
        dd($article);
        // return view('articles.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect(route('articles.index'))->with('message', 'An Article deleted successfully');
    }
}
