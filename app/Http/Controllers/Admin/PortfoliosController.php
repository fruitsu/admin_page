<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PortfolioSavingRequest;
use Illuminate\Http\Response;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;

class PortfoliosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin.portfolios.index', [
            'portfolios' => Portfolio::paginate(25)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Portfolio $portfolio
     * @return View
     */
    public function edit(Portfolio $portfolio): View
    {
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Portfolio $portfolio
     * @return View
     */
    public function create(Portfolio $portfolio): View
    {
        return view('admin.portfolios.create', compact('portfolio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PortfolioSavingRequest $request
     * @return RedirectResponse
     */
    public function store(PortfolioSavingRequest $request): RedirectResponse
    {
        $portfolio = Portfolio::create($request->only('slug', 'title', 'body'));

        $portfolio->metas()->create([
            'title' => $request->input('meta.title', $request->input('title')),
            'description' => $request->input('meta.description', $request->input('description'))
        ]);

        if ($request->hasFile('images')) {
            foreach($request->images as $image) {
                $portfolio->addMedia($image)->toMediaCollection('images');
            }
        }

        return redirect(route('admin.portfolios.edit', $portfolio))
            ->with('success', __('admin.portfolios.messages.created'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PortfolioSavingRequest $request
     * @param Portfolio $portfolio
     * @return RedirectResponse
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(PortfolioSavingRequest $request, Portfolio $portfolio): RedirectResponse

    {
        $portfolio->fill($request->only('title','body'));

        if ($request->has('update_slug')) {
            $portfolio->slug = null;
        }

        $portfolio->save();

        $portfolio->metas()->update([
            'title' => $request->input('meta.title', $portfolio->title),
            'description' => $request->input('meta.description', $portfolio->description)
        ]);

        if ($request->hasFile('images')) {
            foreach($request->images as $image) {
                $portfolio->addMedia($image)->toMediaCollection('images');
            }
        }

        return back()->with('success', __('admin.portfolios.messages.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Portfolio $portfolio
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Portfolio $portfolio ): RedirectResponse
    {
        $portfolio->delete();
        $portfolio->metas()->delete();

        return redirect(route('admin.portfolio.index'))->with('success', __('admin.portfolio.messages.deleted'));
    }

}
