<form class="post-form" method="post" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    @method($method)
    <div class="row">
        <div class="col-md-6">
            <div class="preview bg-light border">
                @if($profile && $profile->avatar)
                    <img id="image" src="{{ $profile->avatar->url }}" alt="preview" />
                @else
                    <img id="image" src="{{ Vite::asset('resources/images/no-image.jpg')  }}" alt="preview" />
                @endif
            </div>
            @if($errors->has('preview'))
                <div class="alert alert-danger">{{ $errors->first('preview') }}</div>
            @endif
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="avatar" class="form-label">Avatar</label>
                <input name="avatar"
                       class="form-control @if($errors->has('avatar')) is-invalid @endif"
                       type="file"
                       id="avatar"
                />
                @if($errors->has('avatar'))
                    <div class="invalid-feedback">{{ $errors->first('avatar') }}</div>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="name">Title</label>
                <input class="form-control @if($errors->has('name')) is-invalid @endif"
                       type="text"
                       name="name"
                       value="{!! $profile ? old('name', $profile->name): old('name') !!}"
                />
                @if($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="form-group mb-3">
                <label for="name">Title</label>
                <input class="form-control @if($errors->has('email')) is-invalid @endif"
                       type="email"
                       name="email"
                       value="{!! $profile ? old('email', $profile->email): old('email') !!}"
                />
                @if($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </div>
</form>
