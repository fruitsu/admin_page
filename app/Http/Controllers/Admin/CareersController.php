<?php

namespace App\Http\Controllers\Admin;

use App\Models\Career;
use App\Http\Controllers\Controller;
use App\Http\Requests\CareerSavingRequest;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CareersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin.careers.index', [
            'careers' => Career::latest()->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.careers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CareeSavingRequest $request
     * @return RedirectResponse
     */
    public function store(CareeSavingRequest $request): RedirectResponse
    {
        $career = Career::create($request->only('title', 'description'));

        $career->metas()->create([
            'title' => $request->input('meta.title', $request->input('title')),
            'description' => $request->input('meta.description',$request->input('description'))
        ]);

        return redirect(route('admin.careers.edit', $career))
            ->with('success', __('admin.careers.messages.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param Career $career
     * @return View
     */
    public function edit(Career $career): View
    {
        return view('admin.careers.edit', [
            'careers' => $career->load('metas')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CareerSavingRequest $request
     * @param Career $career
     * @return RedirectResponse
     */
    public function update(CareerSavingRequest $request, Career $career): RedirectResponse
    {
        $career->fill($request->only('title','body'));
        $career->save();
        $career->metas()->update([
            'title' => $request->input('meta.title', $request->input('title')),
            'description' => $request->input('meta.description',$request->input('description'))
        ]);

        return back()->with('success', __('admin.careers.messages.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Career $career
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Career $career ): RedirectResponse
    {
        $career->delete();
        $career->metas()->delete();

        return redirect(route('admin.careers.index'))->with('success', __('admin.careers.messages.deleted'));
    }
}
