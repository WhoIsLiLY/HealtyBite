@extends('layouts.adminlte')

@section('sidebar:categories', 'active')
@section('content')
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
                        {{-- <h3 class="card-title">Bordered Table</h3> --}}
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Launch demo modal
                        </button>

                        <img src="/storage/categories/image.png" alt="" width="250px">
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body p-0">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Show Food List</th>
                                    <th>Show Image</th>
                                    <th>id</th>
                                    <th>name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $c)
                                    <tr>
                                        <td>
                                            <button type="button" class="btn btn-primary w-25" data-bs-toggle="modal"
                                                data-bs-target="#food-list-modal"
                                                onclick="showFoodList({{ $c->id }})">
                                                Show
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary w-25" data-bs-toggle="modal"
                                                data-bs-target="#image-modal-{{ $c->id }}">
                                                Show
                                            </button>
                                            @push('modals')
                                                <div class="modal fade" id="image-modal-{{ $c->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Image for {{ $c->name }}</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <img src="/storage/categories/{{ $c->image }}" alt="">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endpush
                                        </td>
                                        <td>{{ $c->id }}</td>
                                        <td>{{ $c->name }}</td>
                                        <td><img src="/storage/categories/{{ $c->image }}" alt=""
                                                width="250px"></td>
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
        <div class="modal fade" id="food-list-modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="modal-title-food-category">Food list for category -</h5>
                        <div id="modal-body-food-list"></div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function showFoodList(idcat) {
                $.ajax({
                    type: "GET",
                    // url: "/categories/showListFoods?idcat=" + idcat,
                    url: "/categories/showListFoods",
                    data: {
                        idcat: idcat,
                        _token: '<?php echo csrf_token(); ?>'
                    },
                    success: function(data) {
                        console.log(data);
                        $("#modal-title-food-category").html("Food list for category " + data.category);
                        let list = "<ul>";
                        for (let i = 0; i < data.foods.length; i++) {
                            list += "<li>" + data.foods[i].name + "</li>";
                        }
                        list += "<li>test</li>";
                        list += "</ul>";
                        $("#modal-body-food-list").html(list);
                    }
                })

            }
        </script>

    @endsection
