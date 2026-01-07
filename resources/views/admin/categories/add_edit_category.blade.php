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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Категории</li>
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
                                    <label class="category_name">Название категории</label>
                                    <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Введите название категории" @if(!empty($categorydata['category_name'])) value="{{ $categorydata['category_name'] }}" @else value="{{ old('category_name') }}" @endif>
                                </div>
                                <div id="appendCategoriesLevel">
                                    @include('admin.categories.append_categories_level')
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Выделить секцию</label>
                                    <select name="section_id" id="section_id" class="form-control select2" style="width: 100%;">
                                        <option value="">Выделить</option>
                                        @foreach($getSections as $section)
                                            <option value="{{ $section->id }}" @if(!empty($categorydata['section_id']) && $categorydata['section_id']==$section->id) selected="" @endif>{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Фото Категории</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="category_image" name="category_image">
                                            <label class="custom-file-label" for="category_image">Выберите файл</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Загрузить</span>
                                        </div>

                                    </div>
                                    @if(!empty($categorydata['category_image']))
                                        <div>
                                            <img style="width: 60px; margin-top: 5px;" src="{{ asset('images/category_images/'.$categorydata['category_image']) }}" alt="">
                                            &nbsp;
                                            <a class="confirmDelete" href="javascript:void(0)" record="category-image" recordid="{{ $categorydata['id'] }}">Удалить фото</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="category_name">Скидка категории</label>
                                    <input type="text" class="form-control" id="category_discount" name="category_discount" placeholder="Скидка категории" @if(!empty($categorydata['category_discount'])) value="{{ $categorydata['category_discount'] }}" @else value="{{ old('category_discount') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label class="category_name">Описание категории</label>
                                    <textarea name="description" id="description" rows="3" class="form-control" placeholder="Описание категории">
                                        @if(!empty($categorydata['description'])) {{ $categorydata['description'] }} @else {{ old('description') }} @endif
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="category_name">URL категории</label>
                                    <input type="text" class="form-control" id="url" name="url" placeholder="URL категории" @if(!empty($categorydata['url'])) value="{{ $categorydata['url'] }}" @else value="{{ old('url') }}" @endif>
                                </div>
                                <div class="form-group">
                                    <label class="category_name">Meta Название категории</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Введите meta название категории" @if(!empty($categorydata['meta_title'])) value="{{ $categorydata['meta_title'] }}" @else value="{{ old('meta_title') }}" @endif>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="category_name">Meta Описание категории</label>
                                    <textarea name="meta_description" id="meta_description" rows="3" class="form-control" placeholder="Meta Описание категории">
                                        @if(!empty($categorydata['meta_description'])) {{ $categorydata['meta_description'] }} @else {{ old('meta_description') }} @endif
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label class="category_name">Meta Ключевые слова</label>
                                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Введите Meta Ключевые слова" @if(!empty($categorydata['meta_keywords'])) value="{{ $categorydata['meta_keywords'] }}" @else value="{{ old('meta_keywords') }}" @endif>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Согласиться</button>
                    </div>
                </div>
                </form>
            </div>
        </section>
    </div>
@endsection
