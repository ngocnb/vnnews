<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $post->title }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $post->description }}</p>
</div>

<!-- Link Field -->
<div class="col-sm-12">
    {!! Form::label('link', 'Link:') !!}
    <p>{{ $post->link }}</p>
</div>

<!-- Source Field -->
<div class="col-sm-12">
    {!! Form::label('source', 'Source:') !!}
    <p>{{ $post->source }}</p>
</div>

<!-- Content Field -->
<div class="col-sm-12">
    {!! Form::label('content', 'Content:') !!}
    <p>{{ $post->content }}</p>
</div>

<!-- Score Time Field -->
<div class="col-sm-12">
    {!! Form::label('score_time', 'Score Time:') !!}
    <p>{{ $post->score_time }}</p>
</div>

<!-- Score Click Field -->
<div class="col-sm-12">
    {!! Form::label('score_click', 'Score Click:') !!}
    <p>{{ $post->score_click }}</p>
</div>

<!-- Score Like Field -->
<div class="col-sm-12">
    {!! Form::label('score_like', 'Score Like:') !!}
    <p>{{ $post->score_like }}</p>
</div>

<!-- Score Hot Field -->
<div class="col-sm-12">
    {!! Form::label('score_hot', 'Score Hot:') !!}
    <p>{{ $post->score_hot }}</p>
</div>

<!-- Is New Field -->
<div class="col-sm-12">
    {!! Form::label('is_new', 'Is New:') !!}
    <p>{{ $post->is_new }}</p>
</div>

