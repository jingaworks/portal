<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePlaceRequest;
use App\Http\Resources\Admin\PlaceResource;
use App\Models\Place;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlaceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('place_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PlaceResource(Place::with(['region'])->get());
    }

    public function show(Place $place)
    {
        abort_if(Gate::denies('place_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PlaceResource($place->load(['region']));
    }

    public function update(UpdatePlaceRequest $request, Place $place)
    {
        $place->update($request->all());

        return (new PlaceResource($place))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Place $place)
    {
        abort_if(Gate::denies('place_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $place->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
