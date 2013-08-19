@layout('layouts.common')

@section('extheader')
<link rel="stylesheet" href="/css/colorbox.css" />
<script type="text/javascript" src="/js/jquery.colorbox-min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.videolink').colorbox();
    });
</script>
@endsection

@section('body')
<div class="container">
        @foreach ($database_result as $url_array)
        <div class="row">
            @foreach ($url_array as $url_data)
            <div class="span4">
                <div class="videocontent">
                    <div class="title">
                        <strong>{{$url_data->title}}</strong>
                    </div>
                    <a href="videoshow?url={{$url_data->videoshowlize()}}" class="videolink">
                        <img src="{{$url_data->thumb}}" />
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
</div>
@endsection
