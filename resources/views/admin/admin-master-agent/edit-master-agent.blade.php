@extends('layout/layouts')

@section('form_js')
@endsection

@section('space-work')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Master Agent</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('manageMasterAgent') }}">Master Agent list</a></li>
                        <li class="breadcrumb-item active">Edit Master Agent</li>
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
                {{-- <div class="card-header">
        <h3 class="card-title">Add Agent</h3>
        </div> --}}
                <!-- /.card-header -->
                <div class="card-body">
                    <form id="addMasterAgentForm" action="{{ route('updateMasterAgent', $users->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Super Agent<span class="text-danger">*</span></label>
                                    <select class="form-control select2" style="width: 100%;" name="sub_agent_id">
                                        {{-- <option value="">Select agent</option> --}}
                                        @foreach ($superagents as $agent)
                                            <option value="{{ $agent['id'] }}"
                                                {{ $agent['id'] == $users->sub_agent_id ? 'selected' : '' }}>
                                                {{ $agent['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('sub_agent_id'))
                                        <span class="text-danger">{{ $errors->first('sub_agent_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name/Alias<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="first_name"
                                        placeholder="First Name/Alias" name="first_name" value="{{ $users->name }}">
                                    @if ($errors->has('first_name'))
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="email" placeholder="Email"
                                        name="email" value="{{ $users->email }}">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" placeholder="Password"
                                            name="password">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Telegram ID<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="tele_id" placeholder="Telegram ID"
                                        name="tele_id" value="{{ $users->telegram_id }}">
                                    @if ($errors->has('tele_id'))
                                        <span class="text-danger">{{ $errors->first('tele_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Group Telegram ID</label>
                                    <input type="text" class="form-control" id="group_tele_id"
                                        placeholder="Group Telegram ID" name="group_tele_id"
                                        value="{{ $users->group_tele_id }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Commission on Wins(%)</label>
                                    <input type="text" class="form-control" id="win_commission"
                                        placeholder="Commission on Wins(%)" name="win_commission"
                                        value="{{ $users->win_commission }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Commission on Losses(%)</label>
                                    <input type="text" class="form-control" id="loss_commission"
                                        placeholder="Commission on Wins(%)" name="loss_commission"
                                        value="{{ $users->loss_commission }}">
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" id="submitFormBtn" class="btn btn-primary">Update</button>
                        </div>
                    </form>

                </div>
                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
