<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function dashboard(){
        $articles = auth()->user()->articles()->with('category')->get();
        return view('articles.dashboard', [
            'articles'       => $articles,
            'totalArticles'  => $articles->count(),
            'publishedCount' => $articles->where('statut', 'publie')->count(),
            'draftCount'     => $articles->where('statut', 'brouillon')->count(),
            'totalViews'     => $articles->sum('views') ?? 0,
        ]);
    }

    public function create(){
        $categories = Category::all();
        return view('articles.create', ['categories' => $categories]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'titre' => 'required',
            'contenu' => 'required',
            'category_id' => 'required|exists:categories,id',
            'statut' => 'required|in:publie,brouillon',
        ]);

        $validated['user_id'] = auth()->user()->id;
        if($validated['statut'] == 'publie'){
            $validated['date_publication'] = now();
        }

        Article::create($validated);
        return redirect()->route('dashboard');
    }

    public function edit(Article $article){
        $categories = Category::all();
        return view('articles.edit', ['article' => $article, 'categories' => $categories]);
    }

    public function update(Request $request, Article $article){
        $validated = $request->validate([
            'titre' => 'required',
            'contenu' => 'required|string',
            'category_id' => 'required',
            'statut' => 'required|in:brouillon,publie',
        ]);

        if($validated['statut'] === 'publie' && $article->statut === 'brouillon'){
            $validated['date_publication'] = now();
        }

        $article->update($validated);
        return redirect()->route('dashboard')->with('success', 'Article modifié !');
    }

    public function show(Article $article){
        $article->increment('views');
        return view('articles.show', ['article' => $article]);
    }

    public function destroy(Article $article){
        $article->delete();
        return redirect()->route('dashboard')->with('success', 'Article supprimé');
    }
}
