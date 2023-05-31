<div class="row">
    <div class="col-xl-3"></div>
    <div class="col-xl-6 col-lg-12 col-md-12 layout-spacing">
        <div class="card">
            <div class="card-header">@lang('user::user.password.info')</div>
            <div class="card-body">
                <form method="POST" id="userPasswordProcess"
                    data-url="{{ route('users.setting.password.process', ['user' => $user->id]) }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-4">
                                <label for="password" class="form-label">@lang('user::user.password.password')</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">@lang('user::user.password.confirm_password')</label>
                                <input id="password_confirmation" type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" required>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-4">
                                <button class="btn btn-secondary w-100">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-3"></div>
</div>
