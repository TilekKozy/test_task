<?php

namespace App\Http\Controllers;

use App\DTO\Post\PostStoreData;
use App\DTO\Post\PostUpdateData;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function __construct(
        private readonly PostRepositoryInterface $postRepository
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view(
            view: 'posts.index',
            data: [
                      'posts' => $this->postRepository->paginate(10)
                  ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view(
            view: 'posts.create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request): RedirectResponse
    {
        $this->postRepository->create(
            PostStoreData::from([
                                    'user_id' => Auth::id(),
                                    ...$request->validated()
                                ])

        );
        return redirect()->route('posts.index')->with('success', 'Пост создан!');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $post): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view(
            view: 'posts.edit',
            data: [
                      'post' => $this->postRepository->findOrFail($post)
                  ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, int $post): RedirectResponse
    {
        $this->postRepository->update($post,
            PostUpdateData::from([
                                    'user_id' => Auth::id(),
                                    ...$request->validated()
                                ])

        );
        return redirect()->route('posts.index')->with('success', 'Пост обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $post): RedirectResponse
    {
        $this->postRepository->delete($post);
        return redirect()->route('posts.index')->with('success', 'Пост удален!');
    }
}
