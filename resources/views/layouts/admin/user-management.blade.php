@extends('layouts.admin.admin-master')
@section('title-page','User Management')
@section('header')
    <i class="pe-7s-user"></i>&nbsp;&nbsp;User Management
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Striped Table with Hover</h4>
                        <p class="category">Here is a subtitle for this table</p>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="content">
                            <table class="table table-hover table-striped table-responsive table-full-width" id="myTable">
                                <thead>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email Account</th>
                                    <th>Total Post</th>
                                    <th>Total Download</th>
                                    <th>Lastest Login</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Thikamporn Simud</td>
                                        <td>thikamporn.s@ku.th</td>
                                        <td>5</td>
                                        <td>12</td>
                                        <td>Sun, 14 April 2019</td>
                                        <td><button href="#" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-fw"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Thikamporn Simud</td>
                                        <td>thikamporn.s@ku.th</td>
                                        <td>5</td>
                                        <td>12</td>
                                        <td>Sun, 14 April 2019</td>
                                        <td><button href="#" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-fw"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Thikamporn Simud</td>
                                        <td>thikamporn.s@ku.th</td>
                                        <td>5</td>
                                        <td>12</td>
                                        <td>Sun, 14 April 2019</td>
                                        <td><button href="#" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-fw"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Thikamporn Simud</td>
                                        <td>thikamporn.s@ku.th</td>
                                        <td>5</td>
                                        <td>12</td>
                                        <td>Sun, 14 April 2019</td>
                                        <td><button href="#" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-fw"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Thikamporn Simud</td>
                                        <td>thikamporn.s@ku.th</td>
                                        <td>5</td>
                                        <td>12</td>
                                        <td>Sun, 14 April 2019</td>
                                        <td><button href="#" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-fw"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Thikamporn Simud</td>
                                        <td>thikamporn.s@ku.th</td>
                                        <td>5</td>
                                        <td>12</td>
                                        <td>Sun, 14 April 2019</td>
                                        <td><button href="#" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-fw"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Thikamporn Simud</td>
                                        <td>thikamporn.s@ku.th</td>
                                        <td>5</td>
                                        <td>12</td>
                                        <td>Sun, 14 April 2019</td>
                                        <td><button href="#" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-fw"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Thikamporn Simud</td>
                                        <td>thikamporn.s@ku.th</td>
                                        <td>5</td>
                                        <td>12</td>
                                        <td>Sun, 14 April 2019</td>
                                        <td><button href="#" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-fw"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Thikamporn Simud</td>
                                        <td>thikamporn.s@ku.th</td>
                                        <td>5</td>
                                        <td>12</td>
                                        <td>Sun, 14 April 2019</td>
                                        <td><button href="#" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-fw"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Thikamporn Simud</td>
                                        <td>thikamporn.s@ku.th</td>
                                        <td>5</td>
                                        <td>12</td>
                                        <td>Sun, 14 April 2019</td>
                                        <td><button href="#" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-fw"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Thikamporn Simud</td>
                                        <td>thikamporn.s@ku.th</td>
                                        <td>5</td>
                                        <td>12</td>
                                        <td>Sun, 14 April 2019</td>
                                        <td><button href="#" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt fa-fw"></i></button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <script type="text/javascript">
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@endsection
