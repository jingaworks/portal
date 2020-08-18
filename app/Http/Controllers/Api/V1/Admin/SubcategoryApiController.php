<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSubcategoryRequest;
use App\Http\Requests\UpdateSubcategoryRequest;
use App\Http\Resources\Admin\SubcategoryResource;
use App\Models\Subcategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubcategoryApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('subcategory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SubcategoryResource(Subcategory::with(['category'])->get());
    }

    public function store(StoreSubcategoryRequest $request)
    {
        $subcategory = Subcategory::create($request->all());

        if ($request->input('image', false)) {
            $subcategory->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        return (new SubcategoryResource($subcategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Subcategory $subcategory)
    {
        abort_if(Gate::denies('subcategory_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SubcategoryResource($subcategory->load(['category']));
    }

    public function update(UpdateSubcategoryRequest $request, Subcategory $subcategory)
    {
        $subcategory->update($request->all());

        if ($request->input('image', false)) {
            if (!$subcategory->image || $request->input('image') !== $subcategory->image->file_name) {
                if ($subcategory->image) {
                    $subcategory->image->delete();
                }

                $subcategory->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($subcategory->image) {
            $subcategory->image->delete();
        }

        return (new SubcategoryResource($subcategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Subcategory $subcategory)
    {
        abort_if(Gate::denies('subcategory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subcategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}