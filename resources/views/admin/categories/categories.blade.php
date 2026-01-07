@extends('layouts.admin_layout.admin_layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Категории</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Главная</a></li>
                            <li class="breadcrumb-item active">Категории</li>
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
                                <h3 class="card-title">Категории</h3>
                                <a href="{{ url('admin/add-edit-category') }}" style="max-width: 150px; float: right; display: inline-block;" class="btn btn-block btn-success">Добавить</a>
                            </div>
                            <div class="card-body">
                                <table id="categories" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Категория</th>
                                        <th>Родительская Категория</th>
                                        <th>Секция</th>
                                        <th>URL</th>
                                        <th>Статус</th>
                                        <th>Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        @if(!isset($category->parentcategory->category_name))
                                            <?php $parent_category = "Родительская"; ?>
                                        @else
                                                <?php $parent_category = $category->parentcategory->category_name; ?>
                                        @endif
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->category_name }}</td>
                                            <td>{{ $parent_category }}</td>
                                            <td>{{ $category->section->name }}</td>
                                            <td>{{ $category->url }}</td>
                                            <td>
                                                @if($category->status==1)
                                                    <a class="updateCategoryStatus" id="category-{{ $category->id }}" category_id="{{ $category->id }}" href="javascript:void(0);">Активный</a>
                                                @else
                                                    <a class="updateCategoryStatus" id="category-{{ $category->id }}" category_id="{{ $category->id }}" href="javascript:void(0);">Неактивный</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url("admin/add-edit-category/".$category->id) }}">Редактировать</a>
                                                &nbsp;&nbsp;
                                                <a href="javascript:void(0)" class="confirmDelete" record="category" recordid="{{ $category->id }}">Удалить</a>
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
