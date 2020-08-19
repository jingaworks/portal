<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Place;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Region;
use App\Models\Subcategory;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Product::with(['category', 'subcategory'])->select(sprintf('%s.*', (new Product)->table));
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'product_show';
                $editGate      = 'product_edit';
                $deleteGate    = 'product_delete';
                $crudRoutePart = 'products';

                return view('partials.userDatatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : "";
            });

            $table->addColumn('category_name', function ($row) {
                return $row->category ? $row->category->name : '';
            });

            $table->addColumn('subcategory_name', function ($row) {
                return $row->subcategory ? $row->subcategory->name : '';
            });

            $table->rawColumns(['actions', 'category', 'subcategory']);

            return $table->make(true);
        }

        $categories    = Category::has('categoryProducts')->get();
        $subcategories = Subcategory::has('subcategoryProducts')->get();

        return view('user.products.index', compact('categories', 'subcategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regions = Region::all()->pluck('denj', 'id')->prepend(trans('global.pleaseSelect'), '');

        $places = Place::whereNotIn('codp', [0])->orderBy('denloc')->get()->pluck('denloc', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subcategories = Subcategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $profiles = Profile::all()->pluck('phone', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('user.products.create', compact('regions', 'places', 'categories', 'subcategories', 'profiles'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());

        foreach ($request->input('images', []) as $file) {
            $product->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $product->id]);
        }

        return redirect()->route('user.products.index');
    }

    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regions = Region::all()->pluck('denj', 'id')->prepend(trans('global.pleaseSelect'), '');

        $places = Place::whereNotIn('codp', [0])->orderBy('denloc')->get()->pluck('denloc', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subcategories = Subcategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $profiles = Profile::all()->pluck('phone', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product->load('region', 'place', 'category', 'subcategory', 'profile', 'created_by');

        return view('user.products.edit', compact('regions', 'places', 'categories', 'subcategories', 'profiles', 'product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());

        if (count($product->images) > 0) {
            foreach ($product->images as $media) {
                if (!in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }

        $media = $product->images->pluck('file_name')->toArray();

        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $product->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('images');
            }
        }

        return redirect()->route('user.products.index');
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->load('region', 'place', 'category', 'subcategory', 'profile', 'created_by');

        return view('user.products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $product->delete();
        
        return back();
    }
    
    public function massDestroy(MassDestroyProductRequest $request)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Product::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_create') && Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Product();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}