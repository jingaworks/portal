<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCertificateRequest;
use App\Http\Requests\StoreCertificateRequest;
use App\Http\Requests\UpdateCertificateRequest;
use App\Models\Certificate;
use App\Models\Place;
use App\Models\Profile;
use App\Models\Region;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CertificateController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('certificate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Certificate::with(['region', 'place', 'profile', 'created_by'])->select(sprintf('%s.*', (new Certificate)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'certificate_show';
                $editGate      = 'certificate_edit';
                $deleteGate    = 'certificate_delete';
                $crudRoutePart = 'certificates';

                return view('partials.userDatatablesActions', compact(
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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('serie', function ($row) {
                return $row->serie ? $row->serie : "";
            });
            $table->addColumn('region_denj', function ($row) {
                return $row->region ? $row->region->denj : '';
            });

            $table->addColumn('place_denloc', function ($row) {
                return $row->place ? $row->place->denloc : '';
            });

            $table->addColumn('created_by_name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'region', 'place', 'created_by']);

            return $table->make(true);
        }

        $regions  = Region::has('regionCertificates')->get();
        $places   = Place::has('placeCertificates')->whereNotIn('codp', [0])->get();
        $profiles = Profile::has('profileCertificates')->get();
        $users    = User::has('createdByCertificates')->get();

        return view('user.certificates.index', compact('regions', 'places', 'profiles', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('certificate_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regions = Region::all()->pluck('denj', 'id')->prepend(trans('global.pleaseSelect'), '');

        $places = Place::whereNotIn('codp', [0])->orderBy('denloc')->get()->pluck('denloc', 'id')->prepend(trans('global.pleaseSelect'), '');

        $profiles = Profile::all()->pluck('phone', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('user.certificates.create', compact('regions', 'places', 'profiles'));
    }

    public function store(StoreCertificateRequest $request)
    {
        $certificate = Certificate::create($request->all());

        foreach ($request->input('validation_images', []) as $file) {
            $certificate->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('validation_images');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $certificate->id]);
        }

        return redirect()->route('user.certificates.index');
    }

    public function edit(Certificate $certificate)
    {
        abort_if(Gate::denies('certificate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regions = Region::all()->pluck('denj', 'id')->prepend(trans('global.pleaseSelect'), '');

        $places = Place::whereNotIn('codp', [0])->orderBy('denloc')->get()->pluck('denloc', 'id')->prepend(trans('global.pleaseSelect'), '');

        $profiles = Profile::all()->pluck('phone', 'id')->prepend(trans('global.pleaseSelect'), '');

        $certificate->load('region', 'place', 'profile', 'created_by');

        return view('user.certificates.edit', compact('regions', 'places', 'profiles', 'certificate'));
    }

    public function update(UpdateCertificateRequest $request, Certificate $certificate)
    {
        $certificate->update($request->all());

        if (count($certificate->validation_images) > 0) {
            foreach ($certificate->validation_images as $media) {
                if (!in_array($media->file_name, $request->input('validation_images', []))) {
                    $media->delete();
                }
            }
        }

        $media = $certificate->validation_images->pluck('file_name')->toArray();

        foreach ($request->input('validation_images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $certificate->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('validation_images');
            }
        }

        return redirect()->route('user.certificates.index');
    }

    public function show(Certificate $certificate)
    {
        abort_if(Gate::denies('certificate_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $certificate->load('region', 'place', 'profile', 'created_by');

        return view('user.certificates.show', compact('certificate'));
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('certificate_create') && Gate::denies('certificate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Certificate();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}