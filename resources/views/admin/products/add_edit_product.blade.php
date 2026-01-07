@extends('layouts.admin_layout.admin_layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Каталог</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">მთავარი</a></li>
                            <li class="breadcrumb-item active">პროდუქტები</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                @if($errors->any())
                    <div class="alert alert-danger" style="margin-top: 10px;">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(Session::get('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                        {{ Session::get('success_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form @if(empty($productdata['id'])) action="{{ url('admin/add-edit-product') }}" @else action="{{ url('admin/add-edit-product/'.$productdata['id']) }}"  @endif name="productForm" id="productForm" method="post" enctype="multipart/form-data">@csrf
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">{{ $title }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>აირჩიეთ კატეგორია</label>
                                        <select name="category_id" id="category_id" class="form-control select2" style="width: 100%;">
                                            <option value="">არჩევა</option>
                                            @foreach($categories as $section)
                                                <optgroup label="{{ $section['name'] }}"></optgroup>
                                                @foreach($section['categories'] as $category)
                                                    <option value="{{ $category['id'] }}" @if(!empty(@old('category_id')) && $category['id']==@old('category_id')) selected="" @elseif(!empty($productdata['category_id']) && $productdata['category_id']==$category['id']) selected="" @endif>&nbsp;&nbsp;&nbsp;---&nbsp;&nbsp;&nbsp;{{ $category['category_name'] }}</option>
                                                    @foreach($category['subcategories'] as $subcategory)
                                                        <option value="{{ $subcategory['id'] }}" @if(!empty(@old('category_id')) && $subcategory['id']==@old('category_id')) selected="" @elseif(!empty($productdata['category_id']) && $productdata['category_id']==$subcategory['id']) selected="" @endif>&nbsp;&nbsp;&nbsp;---&nbsp;&nbsp;&nbsp;{{ $subcategory['category_name'] }}</option>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>აირჩიეთ ბრენდი</label>
                                        <select name="brand_id" id="brand_id" class="form-control select2" style="width: 100%;">
                                            <option value="">არჩევა</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand['id'] }}" @if(!empty($productdata['brand_id']) && $productdata['brand_id']==$brand['id']) selected="" @endif>{{ $brand['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="product_name">სახელი</label>
                                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="შეიყვანეთ პროდუქტის სახელი" @if(!empty($productdata['product_name'])) value="{{ $productdata['product_name'] }}" @else value="{{ old('product_name') }}" @endif>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="product_code">კოდი</label>
                                        <input type="text" class="form-control" id="product_name" name="product_code" placeholder="შეიყვანეთ პროდუქტის კოდი" @if(!empty($productdata['product_code'])) value="{{ $productdata['product_code'] }}" @else value="{{ old('product_code') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label class="product_color">ფერი</label>
                                        <input type="text" class="form-control" id="product_color" name="product_color" placeholder="შეიყვანეთ პროდუქტის ფერი" @if(!empty($productdata['product_color'])) value="{{ $productdata['product_color'] }}" @else value="{{ old('product_color') }}" @endif>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="product_price">ფასი</label>
                                        <input type="text" class="form-control" id="product_price" name="product_price" placeholder="შეიყვანეთ პროდუქტის ფასი" @if(!empty($productdata['product_price'])) value="{{ $productdata['product_price'] }}" @else value="{{ old('product_price') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label class="product_discount">ფასდაკლება</label>
                                        <input type="text" class="form-control" id="product_discount" name="product_discount" placeholder="შეიყვანეთ პროდუქტის ფასდაკლება" @if(!empty($productdata['product_discount'])) value="{{ $productdata['product_discount'] }}" @else value="{{ old('product_discount') }}" @endif>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="product_weight">წონა</label>
                                        <input type="text" class="form-control" id="product_weight" name="product_weight" placeholder="შეიყვანეთ პროდუქტის წონა" @if(!empty($productdata['product_weight'])) value="{{ $productdata['product_weight'] }}" @else value="{{ old('product_weight') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="main_image">ფოტო</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="main_image" name="main_image">
                                                <label class="custom-file-label" for="main_image">აირჩიეთ ფაილი</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">ატვირთვა</span>
                                            </div>
                                        </div>
                                        <div>ფოტოს რეკომენდირებული ზომაა: Width=1040px, Height=1200px</div>
                                        @if(!empty($productdata['main_image']))
                                            <div>
                                                <img style="width: 60px; margin-top: 5px;" src="{{ asset('images/product_images/small/'.$productdata['main_image']) }}" alt="">
                                                &nbsp;
                                                <a class="confirmDelete" href="javascript:void(0)" record="product-image" recordid="{{ $productdata['id'] }}">ფოტოს წაშლა</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="product_video">ვიდეო</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="product_video" name="product_video">
                                                <label class="custom-file-label" for="product_video">აირჩიეთ ფაილი</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">ატვირთვა</span>
                                            </div>
                                        </div>
                                        @if($productdata['product_video'])
                                            <div>
                                                <a href="{{ url('videos/product_videos/'.$productdata['product_video']) }}" download="">გადმოწერა</a>
                                                &nbsp;|&nbsp;
                                                <a class="confirmDelete" href="javascript:void(0)" record="product-video" recordid="{{ $productdata['id'] }}">ვიდეოს წაშლა</a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="product_name">აღწერა</label>
                                        <textarea name="description" id="description" rows="3" class="form-control" placeholder="შეიყვანეთ პროდუქტის აღწერა">
                                        @if(!empty($productdata['description'])) {{ $productdata['description'] }} @else {{ old('description') }} @endif
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="wash_care">მოვლა</label>
                                        <textarea name="wash_care" id="wash_care" rows="3" class="form-control" placeholder="შეიყვანეთ პროდუქტის მოვლა">
                                        @if(!empty($productdata['wash_care'])) {{ $productdata['wash_care'] }} @else {{ old('wash_care') }} @endif
                                    </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>აირჩიეთ მასალა</label>
                                        <select name="fabric" id="fabric_id" class="form-control select2" style="width: 100%;">
                                            <option value="">არჩევა</option>
                                            @foreach($fabricArray as $fabric)
                                                <option value="{{ $fabric }}" @if(!empty($productdata['fabric']) && $productdata['fabric']==$fabric) selected="" @endif>{{ $fabric }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>აირჩიეთ სახელო</label>
                                        <select name="sleeve" id="sleeve_id" class="form-control select2" style="width: 100%;">
                                            <option value="">არჩევა</option>
                                            @foreach($sleeveArray as $sleeve)
                                                <option value="{{ $sleeve }}" @if(!empty($productdata['sleeve']) && $productdata['sleeve']==$sleeve) selected="" @endif>{{ $sleeve }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>აირჩიეთ დაპრინტვა</label>
                                        <select name="pattern" id="pattern_id" class="form-control select2" style="width: 100%;">
                                            <option value="">არჩევა</option>
                                            @foreach($patternArray as $pattern)
                                                <option value="{{ $pattern }}" @if(!empty($productdata['pattern']) && $productdata['pattern']==$pattern) selected="" @endif>{{ $pattern }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>აირჩიეთ სტილი</label>
                                        <select name="fit" id="fit_id" class="form-control select2" style="width: 100%;">
                                            <option value="">არჩევა</option>
                                            @foreach($fitArray as $fit)
                                                <option value="{{ $fit }}" @if(!empty($productdata['fit']) && $productdata['fit']==$fit) selected="" @endif>{{ $fit }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>აირჩიეთ სპეცია</label>
                                        <select name="occasion" id="occasion_id" class="form-control select2" style="width: 100%;">
                                            <option value="">Выделить</option>
                                            @foreach($occasionArray as $occasion)
                                                <option value="{{ $occasion }}" @if(!empty($productdata['occasion']) && $productdata['occasion']==$occasion) selected="" @endif>{{ $occasion }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="product_name">მეტა სახელი</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="შეიყვანეთ მეტა სახელი" @if(!empty($productdata['meta_title'])) value="{{ $productdata['meta_title'] }}" @else value="{{ old('meta_title') }}" @endif>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="product_name">მეტა აღწერა</label>
                                        <textarea name="meta_description" id="meta_description" rows="3" class="form-control" placeholder="შეიყვანეთ მეტა აღწერა">
                                        @if(!empty($productdata['meta_description'])) {{ $productdata['meta_description'] }} @else {{ old('meta_description') }} @endif
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="product_name">მეტა საკვანძო სიტყვები</label>
                                        <textarea name="meta_keywords" id="meta_keywords" rows="3" class="form-control" placeholder="შეიყვანეთ მეტა საკვანძო სიტყვები">
                                        @if(!empty($productdata['meta_keywords'])) {{ $productdata['meta_keywords'] }} @else {{ old('meta_keywords') }} @endif
                                    </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="product_name">გაყიდვაშია</label>
                                        <input type="checkbox" name="is_featured" id="is_featured" value="Yes" @if(!empty($productdata['is_featured']) && $productdata['is_featured']=="Yes") checked="" @endif>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">დადასტურება</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

