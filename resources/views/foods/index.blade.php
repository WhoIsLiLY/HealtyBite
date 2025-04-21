@extends("layouts.adminlte")

@section("sidebar:food", "active")
@section("content")
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Simple Tables</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Simple Tables</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Bordered Table</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>name</th>
                                        <th>category</th>
                                        <th>description</th>
                                        <th>nutrition fact</th>
                                        <th>price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($food as $f)
                                        <tr>
                                            <td>{{ $f->id }}</td>
                                            <td>{{ $f->name }}</td>
                                            <td>{{ $f->category }}</td>
                                            <td>{{ $f->description }}</td>
                                            <td>{{ $f->nutrition_fact }}</td>
                                            <td>{{ $f->price }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card -->
                    </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
@endsection