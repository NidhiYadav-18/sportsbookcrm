@extends('layout/layouts')

@section('space-work')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>view Player</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('managePlayers') }}">Player list</a></li>
                        <li class="breadcrumb-item active">View Player</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    {{-- <h3 class="card-title">View Player</h3> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('posteditplayer', $player->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" id="user_name" placeholder="User Name/Alias"
                                        name="username" value="{{ $player->username }}" readonly>
                                    {{-- @if ($errors->has('user_name'))

                    <span class="text-danger">{{ $errors->first('user_name')}}</span>

                    @endif --}}
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Url</label>
                                    <input type="text" class="form-control" id="url" placeholder="Url"
                                        name="url" value="{{ $player->url }}" readonly>
                                </div>
                            </div>

                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">

                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>IP</label>
                                    <input type="text" class="form-control" id="ip" placeholder="IP"
                                        name="ip" value="{{ $player->IP }}" readonly>

                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Credits $</label>
                                    <input type="text" class="form-control" id="credits" placeholder="credits"
                                        name="credits" value="{{ $player->credits }}" readonly>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Agent</label>
                                    <input type="text" class="form-control" name="agent"
                                        value="@foreach ($agents as $agent){{ $player->agent_id == $agent['id'] ? $agent['id'] : '' }} @endforeach"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Max Bet $</label>
                                    <input type="number" class="form-control" id="max_bet" placeholder="%" name="max_bet"
                                        value="{{ $player->max_bet }}" readonly>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Max Win $</label>
                                    <input type="number" class="form-control" id="max_win" placeholder="%" name="max_win"
                                        value="{{ $player->max_win }}" readonly>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Account Status</label>
                                    <input type="text" class="form-control" style="width: 100%;" name="account_status"
                                        value="@if ($player->account_status == '0') {{ 'Active' }} @else {{ 'InActive' }} @endif"
                                        readonly>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="{{ url()->previous() }}" class="btn btn-block btn-primary"
                                style="float: left; width:100px;">Back</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
