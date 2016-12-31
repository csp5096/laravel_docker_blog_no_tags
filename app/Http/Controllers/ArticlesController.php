<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Auth;

use App\User;

use App\Article;

use Illuminate\Http\Request;

// use Request;

use Carbon\Carbon;

use App\Http\Requests;

use App\Http\Requests\ArticleRequest;

class ArticlesController extends Controller
{
    /**
     * Authentication middleware to prevent non-user article creation
     *
     * @return Response
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    /**
     * Show all articles.
     *
     * @return Response
     */
    public function index()
    {
        // Date Mutator - Query Scope: Published Articles
    	$articles = Article::latest('created_at')->created()->get();

    	// Date Mutator - Query Scope: Unpublished Articles
        // $articles = Article::latest('created_at')->uncreated()->get();

		return view('articles.index', compact('articles'));
    }

    /**
     * Show a single article.
     *
     * @param Article $article
     *
     * @return Response
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the page to create a new article.
     *
     * @return Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Save a new article
     *
     * @param ArticleRequest $request
     * @return Response
     */
    public function store(ArticleRequest $request)
    {
        // user_id => Auth::user()->id
        Auth::user()->articles()->create($request->all());

        // Session Facade: a flash message that flashes per a page request
        return redirect('articles')->with([
            'flash_message' => 'Your article has been created',
            'flash_message_important' => true
        ]);
    }

    /**
     * Edit an existing article
     *
     * @param Article $article
     *
     * @return Response
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update an existing article with Method Injection plus Reflection.
     *
     * @param Article $article
     * @param ArticleRequest $request
     * @return Response
     */
    public function update(Article $article, ArticleRequest $request)
    {
        $article->update($request->all());

        return redirect('articles');
    }
}
