<h1>Category: {{ $category->name }}</h1>

<h2>Banners:</h2>

@foreach($banners as $banner)
    <li>{{ $banner->name }}</li>
    <a href="{{ $banner->redirect_link }}"><img src="{{ asset($banner->local_path) }}" alt="Not found"></a>
    <br/><br/>
@endforeach