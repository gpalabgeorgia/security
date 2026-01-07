@extends('layouts.admin_layout.admin_layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>კატალოგი</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">მთავარი</a></li>
                            <li class="breadcrumb-item active">კატეგორიები</li>
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
                <form @if(empty($categorydata['id'])) action="{{ url('admin/add-edit-category') }}" @else action="{{ url('admin/add-edit-category/'.$categorydata['id']) }}"  @endif name="categoryForm" id="categoryForm" method="post" enctype="multipart/form-data">@csrf
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
                                    <label class="category_name">სახელი</label>
                                    <input type="text" class="form-control" id="category_name" name="category_name" placeholder="შეიყვანეთ კატეგორიის სახელი" @if(!empty($categorydata['category_name'])) value="{{ $categorydata['category_name'] }}" @else value="{{ old('category_name') }}" @endif>
                                </div>
                                <div id="appendCategoriesLevel">
                                    @include('admin.categories.append_categories_level')
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>აირჩიეთ სექცია</label>
                                    <select name="section_id" id="section_id" class="form-control select2" style="width: 100%;">
                                        <option value="">არჩევა</option>
                                        @foreach($getSections as $section)
                                            <option value="{{ $section->id }}" @if(!empty($categorydata['section_id']) && $categorydata['section_id']==$section->id) selected="" @endif>{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">ფოტო</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="category_image" name="category_image">
                                            <label class="custom-file-label" for="category_image">აირჩიეთ ფაილი</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">ატვირთვა</span>
                                        </div>

                                    </div>
                                    @if(!empty($categorydata['category_image']))
                                        <div>
                                            <img style="width: 60px; margin-top: 5px;" src="{{ asset('images/category_images/'.$categorydata['category_image']) }}" alt="">
                                            &nbsp;
                                            <a class="confirmDelete" href="javascript:void(0)" record="category-image" recordid="{{ $categorydata['id'] }}">ფოტოს წაშლა</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="category_name">ფასდაკლება</label>
                                    <input type="text" class="form-control" id="category_discount" name="category_discount" placeholder="შეიყვანეთ კატეგორიის ფასდაკლება" @if(!empty($categorydata['category_discount'])) value="{{ $categorydata['category_discount'] }}" @else value="{{ old('category_discount') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label class="category_name">აღწერა</label>
                                    <textarea name="description" id="description" rows="3" class="form-control" placeholder="შეიყვანეთ კატეგორიის აღწერა">
                                        @if(!empty($categorydata['description'])) {{ $categorydata['description'] }} @else {{ old('description') }} @endif
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="category_name">კატეგორიის URL</label>
                                    <input type="text" class="form-control" id="url" name="url" placeholder="შეიყვანეთ კატეგორიის URL" @if(!empty($categorydata['url'])) value="{{ $categorydata['url'] }}" @else value="{{ old('url') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label class="category_name">მეტა სახელი</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="შეიყვანეთ კატეგორიის მეტა სახელი" @if(!empty($categorydata['meta_title'])) value="{{ $categorydata['meta_title'] }}" @else value="{{ old('meta_title') }}" @endif>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="category_name">მეტა აღწერა</label>
                                    <textarea name="meta_description" id="meta_description" rows="3" class="form-control" placeholder="შეიყვანეთ კატეგორიის მეტა აღწერა">
                                        @if(!empty($categorydata['meta_description'])) {{ $categorydata['meta_description'] }} @else {{ old('meta_description') }} @endif
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="category_name">მეტა საკვანძო სიტყვები</label>
                                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="შეიყვანეთ კატეგორიის მეტა საკვანძო სიტყვები" @if(!empty($categorydata['meta_keywords'])) value="{{ $categorydata['meta_keywords'] }}" @else value="{{ old('meta_keywords') }}" @endif>
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
