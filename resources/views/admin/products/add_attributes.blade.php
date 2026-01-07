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
                            <li class="breadcrumb-item"><a href="#">Главная</a></li>
                            <li class="breadcrumb-item active">Атрибуты Продукта</li>
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
                @if(Session::get('error_message'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                        {{ Session::get('error_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form name="attributeForm" id="attributeForm" method="post" action="{{ url('admin/add-attributes/'.$productdata['id']) }}">@csrf
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
                                        <label class="product_name">Название Продукта:</label>&nbsp;&nbsp;{{ $productdata['product_name'] }}
                                    </div>
                                    <div class="form-group">
                                        <label class="product_code">Код Продукта:</label>&nbsp;&nbsp;{{ $productdata['product_code'] }}
                                    </div>
                                    <div class="form-group">
                                        <label class="product_color">Цвет Продукта:</label>&nbsp;&nbsp;{{ $productdata['product_color'] }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <img style="width: 120px;" src="{{ asset('images/product_images/small/'.$productdata['main_image']) }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="field_wrapper">
                                            <div>
                                                <input id="size" type="text" name="size[]" value="" placeholder="Размер" style="width: 120px;" required=""/>
                                                <input id="sku" type="text" name="sku[]" value="" placeholder="SKU" style="width: 120px;" required=""/>
                                                <input id="price" type="number" name="price[]" value="" placeholder="Цена" style="width: 120px;" required=""/>
                                                <input id="stock" type="number" name="stock[]" value="" placeholder="Количество" style="width: 120px;" required=""/>
                                                <a href="javascript:void(0);" class="add_button" title="Add field">Добавить</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Согласиться</button>
                        </div>
                    </div>
                </form>
                <form name="editAttributeForm" id="editAttributeForm" method="post" action="{{ url('admin/edit-attributes/'.$productdata['id']) }}">@csrf
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Добавить Аттрибуты</h3>
                        </div>
                        <div class="card-body">
                            <table id="products" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Размер</th>
                                    <th>SKU Код</th>
                                    <th>Цена</th>
                                    <th>Количество</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productdata['attributes'] as $attribute)
                                    <input type="hidden" name="attrId[]" value="{{ $attribute['id'] }}">
                                    <tr>
                                        <td>{{ $attribute['id'] }}</td>
                                        <td>{{ $attribute['size'] }}</td>
                                        <td>{{ $attribute['sku'] }}</td>
                                        <td>{{ $attribute['price'] }}
                                            <input type="number" name="price[]" value="{{ $attribute['price'] }}">
                                        </td>
                                        <td>
                                            <input type="number" name="stock[]" value="{{ $attribute['stock'] }}">
                                        </td>
                                        <td>
                                            @if($attribute['status']==1)
                                                <a class="updateAttributeStatus" id="attribute-{{ $attribute['id'] }}" attribute_id="{{ $attribute['id'] }}" href="javascript:void(0);">Активный</a>
                                            @else
                                                <a class="updateAttributeStatus" id="attribute-{{ $attribute['id'] }}" attribute_id="{{ $attribute['id'] }}" href="javascript:void(0);">Неактивный</a>
                                            @endif
                                            &nbsp;&nbsp;
                                            <a title="Удалить Аттрибут" href="javascript:void(0)" class="confirmDelete" record="attribute" recordid="{{ $attribute['id'] }}"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Обновить Аттрибуты</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

