@extends("layouts.admin_layout.admin_layout")
@section("content")
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Параметры</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url("/") }}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="#">Параметры</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Обновление пароля</h3>
                            </div>
                            @if(Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                                    {{ Session::get('error_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
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
                            <form role="form" method="post" action="{{ url('/admin/update-current-pwd') }}" name="updatePasswordForm" id="updatePasswordForm">@csrf
                                <div class="card-body">
                                    <?php /* <div class="form-group">
                                        <label for="exampleInputEmail1">Имя/Фамилия</label>
                                        <input class="form-control" type="text" value="{{ $adminDetails->name }}" placeholder="Имя/Фамилия" id="admin_name" name="admin_name">
                                    </div> */ ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email адрес</label>
                                        <input class="form-control" readonly="" value="{{ $adminDetails->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Роль</label>
                                        <input class="form-control" readonly="" value="{{ $adminDetails->type }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Текущий Пароль</label>
                                        <input type="password" class="form-control" id="current_pwd" name="current_pwd" placeholder="Текущий Пароль" required="">
                                        <span id="chkCurrentPwd"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Новый Пароль</label>
                                        <input type="password" class="form-control" id="new_pwd" name="new_pwd" placeholder="Новый Пароль" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Повторите Пароль</label>
                                        <input type="password" class="form-control" id="confirm_pwd" name="confirm_pwd" placeholder="Повторите Пароль" required="">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Изменить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
