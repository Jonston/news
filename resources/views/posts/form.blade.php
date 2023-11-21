<form class="post-form" method="post" action="{{ $action }}">
    @csrf
    @method($method)
    <div class="row">
        <div class="col-md-6">
            <div class="preview bg-light border mb-3">
                @if($post && $post->preview)
                    <img id="image" src="{{ $post->preview->url }}" alt="preview" />
                @else
                    <img id="image" src="{{ Vite::asset('resources/images/no-image.jpg')  }}" alt="preview" />
                @endif
            </div>
            @if($errors->has('preview'))
                <div class="alert alert-danger">{{ $errors->first('preview') }}</div>
            @endif
            <div class="form-group">
                <button id="generate-image" type="button" class="btn btn-primary">Generate</button>
            </div>
        </div>
        <div class="col-md-6">
            <input id="preview" type="hidden" name="preview">
            <div class="form-group mb-3">
                <label for="title">Title</label>
                <input class="form-control @if($errors->has('title')) is-invalid @endif"
                       type="text"
                       name="title"
                       value="{!! $post ? old('title', $post->title): old('title') !!}"
                />
                @if($errors->has('title'))
                    <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                @endif
            </div>
            <div class="form-group mb-3">
                <label for="body">Content</label>
                <textarea rows="8" class="form-control @if($errors->has('content')) is-invalid @endif" name="content">{!! $post ? old('content', $post->content): old('content') !!}</textarea>
                @if($errors->has('content'))
                    <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                @endif
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </div>
</form>

@section('scripts')
    <script type="text/javascript">
        window.addEventListener('DOMContentLoaded', () => {
            const getRandomImage = async () => {
                const response =  await fetch('/admin/random-image');

                return response.json();
            };

            const btnGenerateImage = document.getElementById('generate-image');

            btnGenerateImage.addEventListener('click', () => {
                btnGenerateImage.disabled = true;

                getRandomImage().then(data => {
                    const image = data.image;

                    const imageElement = document.getElementById('image');
                    imageElement.src = image.url;

                    const previewElement = document.getElementById('preview');
                    previewElement.value = image.id;

                }).finally(() => {
                    btnGenerateImage.disabled = false;
                });
            });
        });
    </script>
@endsection
