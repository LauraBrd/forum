@extends('layouts.site')

@section('content')

@foreach($topics as $topic)

<div class="col-lg-8 col-md-8">
<!-- POST -->
<div class="post">
<div class="wrap-ut pull-left">
    <div class="userinfo pull-left">
        <div class="avatar">
            <img src="{{ asset('/images/avatar.jpg')}}" alt="">
            <div class="status green">&nbsp;</div>
        </div>
    </div>

    <div class="posttext pull-left">
        <a href="{{ route('topics.show',['id' => $topic->id]) }}"><h2> {{ $topic->titre }}</h2></a>
        <p>{{ $topic->message }}</p>
    </div>
    <div class="clearfix">
        @auth
            <form action="{{ route('topics.edit',['id' => $topic->id]) }}" method="GET" class="form">
            @csrf
                <div class="pull-right"><button class="btn btn-default" type="submit">Modifier</button></div>
            </form>

            <form action="{{ route('topics.destroy', ['id' => $topic->id]) }}" method="POST" class="form">
                    @csrf
                    @method('DELETE')
                    <div class="pull-right"><button class="btn btn-default" type="submit">Supprimer</button></div>
            </form>
        @endauth

    </div>
</div>
<div class="postinfo pull-left">
    <div class="comments">
        <div class="commentbg">
            560
            <div class="mark"></div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
</div><!-- POST -->

</div>

@endforeach

@endsection