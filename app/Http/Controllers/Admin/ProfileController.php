<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProfileRequest;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Place;
use App\Models\Profile;
use App\Models\Region;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProfileController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('profile_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Profile::with(['place', 'region', 'created_by'])->select(sprintf('%s.*', (new Profile)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'profile_show';
                $editGate      = 'profile_edit';
                $deleteGate    = 'profile_delete';
                $crudRoutePart = 'profiles';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : "";
            });
            $table->addColumn('place_denloc', function ($row) {
                return $row->place ? $row->place->denloc : '';
            });

            $table->addColumn('region_denj', function ($row) {
                return $row->region ? $row->region->denj : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'place', 'region']);

            return $table->make(true);
        }

        $regions = Region::has('regionProfiles')->get();
        $places  = Place::has('placeProfiles')->whereNotIn('codp', [0])->get();
        $users   = User::has('createdByProfiles')->get();

        return view('admin.profiles.index', compact( 'regions', 'places','users'));
    }

    public function create()
    {
        abort_if(Gate::denies('profile_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $places = Place::all()->pluck('denloc', 'id')->prepend(trans('global.pleaseSelect'), '');

        $regions = Region::all()->pluck('denj', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.profiles.create', compact('places', 'regions'));
    }

    public function store(StoreProfileRequest $request)
    {
        $profile = Profile::create($request->all());

        if ($request->input('avatar', false)) {
            $profile->addMedia(storage_path('tmp/uploads/' . $request->input('avatar')))->toMediaCollection('avatar');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $profile->id]);
        }

        return redirect()->route('admin.profiles.index');
    }

    public function edit(Profile $profile)
    {
        abort_if(Gate::denies('profile_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $places = Place::all()->pluck('denloc', 'id')->prepend(trans('global.pleaseSelect'), '');

        $regions = Region::all()->pluck('denj', 'id')->prepend(trans('global.pleaseSelect'), '');

        $profile->load('place', 'region', 'created_by');

        return view('admin.profiles.edit', compact('places', 'regions', 'profile'));
    }

    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        $profile->update($request->all());

        if ($request->input('avatar', false)) {
            if (!$profile->avatar || $request->input('avatar') !== $profile->avatar->file_name) {
                if ($profile->avatar) {
                    $profile->avatar->delete();
                }

                $profile->addMedia(storage_path('tmp/uploads/' . $request->input('avatar')))->toMediaCollection('avatar');
            }
        } elseif ($profile->avatar) {
            $profile->avatar->delete();
        }

        return redirect()->route('admin.profiles.index');
    }

    public function show(Profile $profile)
    {
        abort_if(Gate::denies('profile_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $profile->load('place', 'region', 'created_by', 'profileProducts', 'profileCertificates');

        return view('admin.profiles.show', compact('profile'));
    }

    public function destroy(Profile $profile)
    {
        abort_if(Gate::denies('profile_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $profile->delete();

        return back();
    }

    public function massDestroy(MassDestroyProfileRequest $request)
    {
        Profile::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('profile_create') && Gate::denies('profile_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Profile();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}