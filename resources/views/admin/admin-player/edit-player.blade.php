@extends('layout/layouts')

@section('space-work')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Player</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('managePlayers') }}">Player list</a></li>
                        <li class="breadcrumb-item active">Edit Player</li>
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
                    {{-- <h3 class="card-title">Edit Player</h3> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('posteditplayer', $player->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="username" placeholder="User Name/Alias"
                                        name="username" value="{{ $player->username }}">
                                    @if ($errors->has('username'))
                                        <span class="text-danger">{{ $errors->first('username') }}</span>
                                    @endif
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password" placeholder="Password"
                                        name="password">
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif

                                </div>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Url</label>
                                    <input type="text" class="form-control" id="url" placeholder="Url"
                                        name="url" value="{{ $player->url }}">
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>IP</label>
                                    <input type="text" class="form-control" id="ip" placeholder="IP"
                                        name="ip" value="{{ $player->IP }}">

                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Credits $</label>
                                    <input type="text" class="form-control" id="credits" placeholder="credits"
                                        name="credits" value="{{ $player->credits }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Agent</label>
                                    <select class="form-control select2" style="width: 100%;" name="agent">
                                        <option value="">Select agent</option>
                                        @foreach ($agents as $agent)
                                            <option value="{{ $agent['id'] }}"
                                                {{ $agent['id'] == $player->agent_id ? 'selected' : '' }}>
                                                {{ $agent['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Max Bet $</label>
                                    <input type="number" class="form-control" id="max_bet" placeholder="%" name="max_bet"
                                        value="{{ $player->max_bet }}">
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Max Win $</label>
                                    <input type="number" class="form-control" id="max_win" placeholder="%" name="max_win"
                                        value="{{ $player->max_win }}">
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- /.row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Account Status</label>
                                    <select class="form-control select2" style="width: 100%;" name="account_status">
                                        <option value="0" @if ($player->account_status == '0') selected @endif>Active
                                        </option>
                                        <option value="1" @if ($player->account_status == '1') selected @endif>Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" value="Update Role" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
