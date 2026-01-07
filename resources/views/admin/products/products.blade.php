@extends('layouts.admin_layout.admin_layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Продукты</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Главная</a></li>
                            <li class="breadcrumb-item active">Продукты</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if(Session::get('success_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                                {{ Session::get('success_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Продукты</h3>
                                <a href="{{ url('admin/add-edit-product') }}" style="max-width: 150px; float: right; display: inline-block;" class="btn btn-block btn-success">Добавить</a>
                            </div>
                            <div class="card-body">
                                <table id="products" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Название</th>
                                        <th>Код</th>
                                        <th>Цвет</th>
                                        <th>Фото</th>
                                        <th>Категория</th>
                                        <th>Секция</th>
                                        <th>Статус</th>
                                        <th>Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->product_code }}</td>
                                            <td>{{ $product->product_color }}</td>
                                            <td>
                                                <?php $product_image_path = 'images/product_images/small/'.$product->main_image; ?>
                                                @if(!empty($product->main_image) && file_exists($product_image_path))
                                                    <img style="width: 80px;" src="{{ asset('images/product_images/small/'.$product->main_image) }}" alt="Product Image">
                                                @endif
                                            </td>
                                            <td>{{ $product->category->category_name }}</td>
                                            <td>{{ $product->section->name }}</td>
                                            <td>
                                                @if($product->status==1)
                                                    <a class="updateProductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}" href="javascript:void(0);">Активный</a>
                                                @else
                                                    <a class="updateProductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}" href="javascript:void(0);">Неактивный</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a title="Добавить/Редактировать Аттрибуты" href="{{ url("admin/add-attributes/".$product->id) }}"><i class="fas fa-plus"></i></a>
                                                &nbsp;&nbsp;
                                                <a title="Добавить Изображения" href="{{ url("admin/add-images/".$product->id) }}"><i class="fas fa-plus-circle"></i></a>
                                                &nbsp;&nbsp;
                                                <a title="Редактировать Продукт" href="{{ url("admin/add-edit-product/".$product->id) }}"><i class="fas fa-edit"></i></a>
                                                &nbsp;&nbsp;
                                                <a title="Удалить Продукт" href="javascript:void(0)" class="confirmDelete" record="product" recordid="{{ $product->id }}"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
