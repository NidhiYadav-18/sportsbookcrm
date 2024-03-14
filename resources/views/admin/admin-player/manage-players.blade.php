@extends('layout/layouts')

@section('space-work')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Player List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Player List</li>
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

                        <div class="card-header">
                            {{-- <h3 class="card-title">Players List</h3> --}}
                            <div style="float:right">
                                <a href="{{ route('addPlayers') }}" class="btn btn-block btn-primary"
                                    style="float:right;">Add Players</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>S no.</th>
                                        <th>User Name</th>
                                        <th>Agent Name</th>
                                        <th>Website URL</th>
                                        <th>IP Address</th>
                                        <th>Credits</th>
                                        <th>Maximum win</th>
                                        <th>Maximum bet</th>
                                        <th>Account Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    use App\Models\User;
                                    ?>
                                    @foreach ($players as $user)
                                        <?php
                                        
                                        $agent = App\Models\User::find($user->agent_id);
                                        ?>
                                        <tr>

                                            <td>{{ $i }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>
                                                @if ($agent)
                                                    {{ $agent->name }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>

                                            <td>{{ $user->url }}</td>
                                            <td>{{ $user->IP }}</td>
                                            <td>{{ $user->credits }}</td>
                                            <td>{{ $user->max_win }}</td>
                                            <td>{{ $user->max_bet }}</td>

                                            @if ($user->account_status == 0)
                                                <td><button type="button"
                                                        class="btn btn-block btn-success btn-sm">Active</button></td>
                                            @else
                                                <td><button type="button"
                                                        class="btn btn-block btn-danger btn-sm">Inactive</button></td>
                                            @endif

                                            <td>
                                                <button class="btn btn-dark p-2">
                                                    <a href="{{ route('editplayer', [$user->id]) }}" class="text-white"
                                                        style=" color: #FFFFFF;"><i class="fa fa-edit"></i></button></a>
                                                <button class="btn  btn-dark p-2">
                                                    <a href="{{ route('deleteplayer', [$user->id]) }}" data-id=""
                                                        class="text-white delete-cat" style=" color: #FFFFFF;"><i
                                                            class="fa fa-trash"></i></button></a>
                                                <button class="btn btn-dark p-2"><a
                                                        href="{{ route('viewplayer', [$user->id]) }}" class="text-white"
                                                        style=" color: #FFFFFF;"><i class="fa fa-eye"></i></button></a>
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
