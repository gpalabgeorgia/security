@extends("layouts.admin_layout.admin_layout")
@section("content")
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">მონაცემები</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url("/") }}">მთავარი</a></li>
                            <li class="breadcrumb-item"><a href="#">ინფოს გაახლება</a></li>
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
                                <h3 class="card-title">ინფოს გაახლება</h3>
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
                            @if($errors->any())
                                <div class="alert alert-danger" style="margin-top: 10px;">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form role="form" method="post" action="{{ url('/admin/update-admin-details') }}" name="updateAdminDetails" id="updateAdminDetails" enctype="multipart/form-data">@csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email მისამართი</label>
                                        <input class="form-control" readonly="" value="{{ Auth::guard("admin")->user()->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">როლი</label>
                                        <input class="form-control" readonly="" value="{{ Auth::guard("admin")->user()->type }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">სახელი/გვარი</label>
                                        <input type="text" class="form-control" id="admin_name" name="admin_name" placeholder="შეიყვანეთ სახელი/გვარი" required="" value="{{ Auth::guard("admin")->user()->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">ტელეფონი</label>
                                        <input type="text" class="form-control" id="admin_mobile" name="admin_mobile" placeholder="შეიყვანეთ ტელეფონის ნომერი" required="" value="{{ Auth::guard("admin")->user()->mobile }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">ფოტო</label>
                                        <input type="file" class="form-control" id="admin_image" name="admin_image" accept="image/*">
                                        @if(!empty(Auth::guard('admin')->user()->image))
                                            <a target="_blank" href="{{ url('images/admin_images/admin_photos/'.Auth::guard('admin')->user()->image) }}">ფოტოს ნახვა</a>
                                            <input type="hidden" name="current_admin_image" value="{{ Auth::guard('admin')->user()->image }}">
                                        @endif
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">შეცვლა</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
