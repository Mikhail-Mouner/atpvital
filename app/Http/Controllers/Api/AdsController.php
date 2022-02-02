<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AdsRequest;
use App\Http\Resources\Api\AdsResource;
use App\Models\Ads;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdsRequest $request)
    {
        $keyword = $request->keyword ?? null;
        $tag = $request->tag_id ?? null;
        $category = $request->category_id ?? null;

        $ads = Ads::with('user')->with('category')->with('tags')
            ->when($keyword, function ($q) use ($keyword) {
                return $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%");
            })->when($category, function ($q) use ($category) {
                return $q->whereCategoryId($category);
            })->when($tag, function ($q) use ($tag) {
                return $q->whereHas('tags', function ($sub_q) use ($tag) {
                    return $sub_q->whereTagId($tag);
                });
            })->get();

        return AdsResource::collection($ads);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdsRequest $request)
    {
        $ads = Ads::create($request->except('tag_id'));
        $ads->tags()->attach($request->tag_id);
        return response()->json(['status' => 'success', 'message' => 'Record Insert Successfully!', 'data' => AdsResource::make($ads)], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  Ads $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ads $ad)
    {
        return AdsResource::make($ad);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdsRequest $request, Ads $ad)
    {
        $ad->update($request->except('tag_id'));
        $ad->tags()->sync($request->tag_id);
        return response()->json(['status' => 'success', 'message' => 'Record Updated Successfully!', 'data' => AdsResource::make($ad)], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ads $ad)
    {
        $ad->delete();
        return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!'], 200);
    }
}
