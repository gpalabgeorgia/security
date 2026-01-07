@extends('layouts.admin_layout.admin_layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Бренды</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Главная</a></li>
                            <li class="breadcrumb-item active">Бренды</li>
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
                                <h3 class="card-title">Брэнд</h3>
                                <a href="{{ url('admin/add-edit-brand') }}" style="max-width: 150px; float: right; display: inline-block;" class="btn btn-block btn-success">Добавить</a>
                            </div>
                            <div class="card-body">
                                <table id="brands" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Название</th>
                                        <th>Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($brands as $brand)
                                        <tr>
                                            <td>{{ $brand->id }}</td>
                                            <td>{{ $brand->name }}</td>
                                            <td>
                                                @if($brand->status==1)
                                                    <a class="updateBrandStatus" id="brand-{{ $brand->id }}" brand_id="{{ $brand->id }}" href="javascript:void(0);"><i class="fas fa-toggle-on" aria-hidden="true" status="Активный"></i></a>
                                                @else
                                                    <a class="updateBrandStatus" id="brand-{{ $brand->id }}" brand_id="{{ $brand->id }}" href="javascript:void(0);"><i class="fas fa-toggle-off" aria-hidden="true" status="Неактивный"></i></a>
                                                @endif
                                                    &nbsp;&nbsp;
                                                    <a title="Редактировать Бренд" href="{{ url("admin/add-edit-brand/".$brand->id) }}"><i class="fas fa-edit"></i></a>
                                                    &nbsp;&nbsp;
                                                    <a title="Удалить Бренд" href="javascript:void(0)" class="confirmDelete" record="brand" recordid="{{ $brand->id }}"><i class="fas fa-trash"></i></a>
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
