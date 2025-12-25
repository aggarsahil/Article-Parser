<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {

        return Article::orderByDesc('created_at')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'      => 'required|string',
            'slug'       => 'nullable|string|unique:articles,slug',
            'source_url' => 'nullable|url',
            'content'    => 'required|string',
            'published_at' => 'nullable|date',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $article = Article::create($data);

        return response()->json($article, 201);
    }

    public function show(Article $article)
    {
        return $article;
    }

    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title'      => 'sometimes|required|string',
            'slug'       => 'sometimes|nullable|string|unique:articles,slug,' . $article->id,
            'source_url' => 'sometimes|nullable|url',
            'content'    => 'sometimes|required|string',
            'published_at' => 'sometimes|nullable|date',
        ]);

        $article->update($data);

        return $article;
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return response()->noContent();
    }
}
