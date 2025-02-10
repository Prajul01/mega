<?php
if (request()->routeIs('*.adminUsers.*')) {
    $url = route('admin.adminUsers.update', base64_encode($user->id));
} else {
    $url = route('admin.admin-management.update', base64_encode($user->id));
}
?>
<form method="post" autocomplete="off" action="{{ $url }}">
    @csrf
    @method('PUT')
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="min-width: 100px; background-color: #e1e8ed">
                            <i class="fa fa-text-width"></i> &nbsp; Name
                        </span>
                    </div>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control"
                        aria-label="Default" aria-describedby="inputGroup-sizing-default" required
                        placeholder="eg: John Doe">
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="min-width: 100px; background-color: #e1e8ed">
                            <i class="fa fa-envelope"></i> &nbsp;Email
                        </span>
                    </div>
                    <input type="email" name="email" class="form-control" aria-label="Default"
                        aria-describedby="inputGroup-sizing-default" required value="{{ $user->email }}"
                        placeholder="eg: hello@example.com">
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="min-width: 100px; background-color: #e1e8ed">
                            <i class="fa fa-lock"></i> &nbsp;Password
                        </span>
                    </div>
                    <input type="password" name="password" class="form-control" aria-label="Default"
                        autocomplete="new-password" aria-describedby="inputGroup-sizing-default">
                </div>
            </div>
            <div class="col-md-6">
                <div class="alert alert-warning">
                    Leave Blank If you don't change Password .
                </div>
            </div>
            @if (request()->routeIs('*.adminUsers.*'))
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="min-width: 100px; background-color: #e1e8ed">
                                <i class="fa fa-user"></i> &nbsp;Role
                            </span>
                        </div>
                        <select name="role" class="form-control">
                            <option disabled>--Select Role--</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $role->id == $user->roles[0]->id? 'selected': ''}}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
        </div>

    </div>
    <div class="card-footer">

        <a href="{{ url()->previous() }}" class="btn btn-outline-danger">CANCEL</a>

        <button type="submit" style="float: right;" class="btn btn-outline-success"> Save</button>


    </div>
</form>
