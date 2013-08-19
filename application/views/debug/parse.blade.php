@layout('layouts.common')

@section('extheader')
@endsection

@section('body')
    <div class="container">
    <h1>Debug Mode</h1>
    <h2>Parse Result</h2>
    <div class="well">
        <ul class="nav nav-list">
        <li class="nav-header">Get Blog URL</li>
            @foreach ($parse_blog_result as $entry)
            <li>
                <a href="{{$entry['url']}}">{{$entry['title']}}</a>
            </li>
            @endforeach
        <li class="nav-header">Filter URL</li>
            @foreach($parse_manager_result as $entry)
            <li>
                <a href="{{$entry['url']}}">{{$entry['title']}}</a>
            </li>
            @endforeach
        <li class="nav-header">URL Info<li>
            @foreach($parse_info_result as $entry)
            <li>
                <img src="{{$entry['thumbnail']}}" />
            </li>
            @endforeach
        </ul>
    </div>
    </div>
@endsection
