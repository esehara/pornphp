@layout('layouts.common')

@section('body')
<div class="container">
    <h1>Debug Mode</h1>
    <h2>Database Result</h2>
                <table class="table table-striped">
                    <tr>
                        <th>URL</th>
                        <th>title</th>
                        <th>thumbnail</th>
                    </tr>

            @foreach ($database_result as $url_array)
                @foreach ($url_array as $url_data)
                    <tr>
                        <td><a href="{{$url_data->url}}">■</a></td>
                        <td>{{$url_data->title}}</td>
                        <td><a href="{{$url_data->thumb}}">thumbnail</a></td>
                    </tr>
                @endforeach
            @endforeach
                
                </table>    
</div>
@endsection
