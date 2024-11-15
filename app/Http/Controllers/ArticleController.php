<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::where('user_id', Auth::id())->get();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('articles.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tags' => 'required|array',
            'category_id' => 'required',
        ]);

        $article = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
        ]);

        for($i=0;$i<count($request->tags);$i++){
            ArticleTag::create([
                'article_id' => $article->id,
                'tag_id' => $request->tags[$i]    
            ]);
        }

        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $articleTags = ArticleTag::where('article_id','=',$article->id)->get();
        return view('articles.edit', compact('article','categories','tags','articleTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required',
            'tags' => 'required|array',
        ]);

        $article->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ]);
        
        $articleTags = ArticleTag::where('article_id', $article->id)->get();

        $tagsFromRequest = $request->tags;

        foreach ($articleTags as $articleTag) {
            if (!in_array($articleTag->tag_id, $tagsFromRequest)) {
                $articleTag->delete();
            }
        }

        foreach ($tagsFromRequest as $tagId) {
            $existingArticleTag = $articleTags->firstWhere('tag_id', $tagId);

            if (!$existingArticleTag) {
                ArticleTag::create([
                    'article_id' => $article->id,
                    'tag_id' => $tagId,
                ]);
            }
        }

        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index');
    }
}
