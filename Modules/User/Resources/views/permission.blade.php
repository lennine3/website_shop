<div class="row">
    @foreach ($role as $item)
        <div class="col-xl-2"></div>
        <div class="col-xl-8 col-lg-6 col-md-6 layout-spacing">

            <div class="card">
                <div class="card-header">
                    {{ $item->name }}
                </div>
                <div class="card-body">
                    @foreach (@$item->permissions as $value)
                        <div class="form-check form-check-primary form-check-inline">
                            <input class="form-check-input form-permission-change" type="checkbox"
                                id="{{ $item->name }}-{{ $value->id }}"
                                {{ $user->hasPermissionTo($value->name) ? 'checked' : '' }} data-id="{{ $value->id }}">
                            <label class="form-check-label" for="{{ $item->name }}-{{ $value->id }}">
                                {{ $value->title }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-xl-2"></div>
    @endforeach
</div>
<input type="text" value="{{ $user->id }}" id="userIdPermission" hidden>
