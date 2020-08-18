<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCertificateRequest;
use App\Http\Requests\UpdateCertificateRequest;
use App\Http\Resources\Admin\CertificateResource;
use App\Models\Certificate;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CertificateApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('certificate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CertificateResource(Certificate::with(['region', 'place', 'created_by'])->get());
    }

    public function store(StoreCertificateRequest $request)
    {
        $certificate = Certificate::create($request->all());

        if ($request->input('validation_images', false)) {
            $certificate->addMedia(storage_path('tmp/uploads/' . $request->input('validation_images')))->toMediaCollection('validation_images');
        }

        return (new CertificateResource($certificate))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Certificate $certificate)
    {
        abort_if(Gate::denies('certificate_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CertificateResource($certificate->load(['region', 'place', 'created_by']));
    }

    public function update(UpdateCertificateRequest $request, Certificate $certificate)
    {
        $certificate->update($request->all());

        if ($request->input('validation_images', false)) {
            if (!$certificate->validation_images || $request->input('validation_images') !== $certificate->validation_images->file_name) {
                if ($certificate->validation_images) {
                    $certificate->validation_images->delete();
                }

                $certificate->addMedia(storage_path('tmp/uploads/' . $request->input('validation_images')))->toMediaCollection('validation_images');
            }
        } elseif ($certificate->validation_images) {
            $certificate->validation_images->delete();
        }

        return (new CertificateResource($certificate))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Certificate $certificate)
    {
        abort_if(Gate::denies('certificate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $certificate->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}