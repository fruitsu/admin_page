<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Exception;
use Illuminate\Contracts\View\View;
use App\Http\Requests\PageSavingRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin.pages.index', [
            'pages' => Page::paginate(25)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Page $page
     * @return View
     */
    public function edit(Page $page): View
    {   
        return view ('admin.pages.edit', compact('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Page $page
     * @return View
     */
    public function create(Page $page): View
    {
        return view('admin.pages.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PageSavingRequest $request
     * @return RedirectResponse
     */
    public function store(PageSavingRequest $request): RedirectResponse
    {   
        $page = Page::create($request->only('slug', 'title', 'body'));

        $page->metas()->create([
            'title' => $request->input('meta.title', $request->input('title')),
            'description' => $request->input('meta.description', $request->input('description'))
        ]);
        
        if ($request->hasFile('images')) {
            foreach($request->images as $image) {
                $page->addMedia($image)->toMediaCollection('images');
            }
        }
        return redirect(route('admin.pages.edit', $page))
            ->with('success', __('admin.pages.messages.created'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PageSavingRequest $request
     * @param Page $page
     * @return RedirectResponse
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(PageSavingRequest $request, Page $page): RedirectResponse

    {
        $page->fill($request->only('title','body'));

        if ($request->has('update_slug')) {
            $page->slug = null;
        }

        $page->save();

        $page->metas()->update([
            'title' => $request->input('meta.title', $request->input('title')),
            'description' => $request->input('meta.description', $request->input('description'))
        ]);

        if ($request->hasFile('images')) {
            foreach($request->images as $image) {
                $page->addMedia($image)->toMediaCollection('images');
            }
        }

        return back()->with('success', __('admin.pages.messages.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception
     */
    public function destroy(Page $page ): RedirectResponse
    {
        $page->delete();
        $page->metas()->delete();

        return redirect(route('admin.pages.index'))->with('success', __('admin.pages.messages.deleted'));
    }

}
