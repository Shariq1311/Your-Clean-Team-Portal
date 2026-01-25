@extends('cms::layouts.backend')

@section('content')
    <div class="row g-3 align-items-center mb-3">
        <div class="col-auto">
            <span class="status-indicator status-blue status-indicator-animated">
                <span class="status-indicator-circle"></span>
                <span class="status-indicator-circle"></span>
                <span class="status-indicator-circle"></span>
            </span>
        </div>
        <div class="col">
            <h2 class="page-title">
                {{ $title }}
            </h2>
        </div>
        <div class="col-md-auto ms-auto d-print-none">
            <a href="{{ route('admin.ecommerce.my-reviews.index') }}" class="btn btn-tabler">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M5 12l14 0" />
                    <path d="M5 12l6 6" />
                    <path d="M5 12l6 -6" />
                </svg>
                {{ trans('cms::app.back') }}
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('ecomm::content.add_review') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.ecommerce.my-reviews.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label required">{{ trans('ecomm::content.product') }}</label>
                            @if($products->isEmpty())
                                <div class="alert alert-info">
                                    {{ trans('ecomm::content.no_products_to_review') }}
                                </div>
                            @else
                                <select name="object_id" class="form-select" required>
                                    <option value="">{{ trans('ecomm::content.select_option') }}</option>
                                    @foreach($products as $product)
                                        @if(!in_array($product->id, $reviewedProductIds))
                                            <option value="{{ $product->id }}">{{ $product->title }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if($errors->has('object_id'))
                                    <div class="invalid-feedback">{{ $errors->first('object_id') }}</div>
                                @endif
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">{{ trans('ecomm::content.your_rating') }}</label>
                            <div class="rating">
                                @for($i = 5; $i >= 1; $i--)
                                    <input type="radio" name="rating" value="{{ $i }}" id="rating-{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }} required>
                                    <label for="rating-{{ $i }}">{{ $i }}</label>
                                @endfor
                            </div>
                            @if($errors->has('rating'))
                                <div class="invalid-feedback">{{ $errors->first('rating') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">{{ trans('ecomm::content.review') }}</label>
                            <textarea name="content" class="form-control" rows="5" required>{{ old('content') }}</textarea>
                            @if($errors->has('content'))
                                <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M14 4l0 4l-6 0l0 -4" />
                                </svg>
                                {{ trans('cms::app.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('ecomm::content.review_info') }}</h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <p>{{ trans('ecomm::content.review_info_text') }}</p>
                    </div>
                    <div class="mb-2">
                        <strong>{{ trans('ecomm::content.status') }}:</strong> {{ trans('ecomm::content.pending') }}
                    </div>
                    <div class="mb-2">
                        <strong>{{ trans('ecomm::content.review_date') }}:</strong> {{ mc_date_format(now()) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }
        .rating input {
            display: none;
        }
        .rating label {
            cursor: pointer;
            width: 40px;
            height: 40px;
            margin-right: 5px;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 4px;
            color: #666;
            font-weight: bold;
            transition: all 0.2s ease;
        }
        .rating input:checked ~ label,
        .rating label:hover,
        .rating input:checked + label ~ label:hover {
            background-color: #ffca2c;
            color: #fff;
        }
    </style>
@endsection
