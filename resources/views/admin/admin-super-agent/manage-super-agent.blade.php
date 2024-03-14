@extends('layout/layouts')

@section('space-work')
    <!-- Content Header (Page header) -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Super Agent List</h1>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="{{ route('Dashboard') }}">Dashboard</a></li>

                        <li class="breadcrumb-item active">Super Agent List</li>

                    </ol>

                </div>

            </div>

        </div><!-- /.container-fluid -->

    </section>



    <!-- Main content -->

    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-12">

                    <div class="card">

                        @if (Session::has('success'))
                            <div class="alert alert-success alert-block">

                                <button type="button" class="close" data-dismiss="alert">×</button>

                                <strong>{{ Session::get('success') }}</strong>

                                @php

                                    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

                                    header('Cache-Control: post-check=0, pre-check=0', false);

                                    header('Pragma: no-cache');

                                @endphp



                            </div>
                        @endif



                        @if (Session::has('failed'))
                            <div class="alert alert-danger alert-block">

                                <button type="button" class="close" data-dismiss="alert">×</button>

                                <strong>{{ Session::get('failed') }}</strong>

                                @php

                                    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

                                    header('Cache-Control: post-check=0, pre-check=0', false);

                                    header('Pragma: no-cache');

                                @endphp



                            </div>
                        @endif



                        <div class="card-header">

                            {{-- <h3 class="card-title">Users List</h3> --}}

                            <div style="float:right">

                                <a href="{{ route('addSuperAgent') }}" class="btn btn-block btn-primary"
                                    style="float:right;">
                                    Add</a>

                            </div>

                        </div>

                        <!-- /.card-header -->

                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-hover">

                                <thead>

                                    <tr>
                                        <th></th>
                                        <th>S no.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Telegram Id</th>
                                        <th>Group Telegram Id</th>
                                        <th>Commission on Wins(%)</th>
                                        <th>Commission on Losses(%)</th>
                                        <th>Agents</th>

                                        <th>Action</th>

                                    </tr>

                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($superagents as $agents)
                                        <tr>
                                            <td></td>
                                            <td>{{ $i }}</td>
                                            <td>{{ $agents->name }}</td>
                                            <td>{{ $agents->email }}</td>
                                            <td>{{ $agents->telegram_id }}</td>
                                            <td>{{ $agents->group_tele_id }}</td>
                                            <td>{{ $agents->win_commission }}</td>
                                            <td>{{ $agents->loss_commission }}</td>
                                            <td>
                                                <button class="btn btn-dark p-2">
                                                    <a href="{{ isset($agents->id) ? route('manageMasterAgent', [$agents->id]) : route('manageMasterAgent') }}"
                                                        class="text-white" style="color: #FFFFFF;">
                                                        Master
                                                    </a>
                                                </button>

                                            </td>
                                            <td>
                                                <button class="btn btn-dark p-2"><a
                                                        href="{{ route('editSuperAgent', [$agents->id]) }}"
                                                        class="text-white" style=" color: #FFFFFF;"><i
                                                            class="fa fa-edit"></i></button></a>
                                                <button class="btn  btn-dark p-2"><a
                                                        href="{{ route('deleteSuperAgent', [$agents->id]) }}"
                                                        data-id="" class="text-white delete-agent"
                                                        style=" color: #FFFFFF;"><i class="fa fa-trash"></i></button></a>
                                                <button class="btn btn-dark p-2"><a
                                                        href="{{ route('viewSuperAgent', [$agents->id]) }}"
                                                        class="text-white" style=" color: #FFFFFF;"><i
                                                            class="fa fa-eye"></i></button></a>

                                            </td>

                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                        <!-- /.card-body -->

                    </div>

                    <!-- /.card -->

                    <!-- /.card -->

                </div>

                <!-- /.col -->

            </div>

            <!-- /.row -->

        </div>

        <!-- /.container-fluid -->

    </section>

    <!-- /.content -->
@endsection

@section('other_js')
    <!-- <script></script> -->
@endsection
