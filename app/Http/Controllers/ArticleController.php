<?php

namespace App\Http\Controllers;

use App\Enums\ArticleStatus;
use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Article;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // TODO: Prevent editor from accessing this page

        // Get the list of companies
        return view('article.create', [
            'companies' => Company::latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleStoreRequest $request)
    {
        // Get the data
        $data = $request->validated();

        // Save the image file
        $imagePath = $request->file('image_path')->store('images', 'public');
        $data['image'] = $imagePath;

        // Save the writer id 
        $data['writer_id'] = Auth::user()->id;

        // Set the status
        $data['status'] = ArticleStatus::FOR_EDIT;

        // Create the article and save it in the database
        Article::create($data);

        return Redirect::route('dashboard')->with('status', 'article-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        // TODO: Show different edit page for editor 

        return view('article.writer.edit', [
            'article' => $article,
            'companies' => Company::latest()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        // TODO: Perform different update for editor 

        // Update the article
        $article->fill($request->validated());

        // Upload new image if given
        if ($request->file('image_path')) {
            $imagePath = $request->file('image_path')->store('images', 'public');
            Storage::disk('public')->delete($article->image);
            $article->image = $imagePath;
        }

        // Save changes to the article
        $article->save();

        return Redirect::route('article.edit', $article)->with('status', 'article-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
