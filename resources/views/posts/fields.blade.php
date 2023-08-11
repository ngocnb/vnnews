<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'required', 'maxlength' => 500, 'maxlength' => 500, 'maxlength' => 500]) !!}
</div>

<!-- Link Field -->
<div class="form-group col-sm-6">
    {!! Form::label('link', 'Link:') !!}
    {!! Form::text('link', null, ['class' => 'form-control', 'required', 'maxlength' => 1000, 'maxlength' => 1000, 'maxlength' => 1000]) !!}
</div>

<!-- Source Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('source', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('source', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('source', 'Source', ['class' => 'form-check-label']) !!}
    </div>
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

<!-- Score Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('score_time', 'Score Time:') !!}
    {!! Form::number('score_time', null, ['class' => 'form-control']) !!}
</div>

<!-- Score Click Field -->
<div class="form-group col-sm-6">
    {!! Form::label('score_click', 'Score Click:') !!}
    {!! Form::number('score_click', null, ['class' => 'form-control']) !!}
</div>

<!-- Score Like Field -->
<div class="form-group col-sm-6">
    {!! Form::label('score_like', 'Score Like:') !!}
    {!! Form::number('score_like', null, ['class' => 'form-control']) !!}
</div>

<!-- Score Hot Field -->
<div class="form-group col-sm-6">
    {!! Form::label('score_hot', 'Score Hot:') !!}
    {!! Form::number('score_hot', null, ['class' => 'form-control']) !!}
</div>

<!-- Is New Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_new', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_new', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_new', 'Is New', ['class' => 'form-check-label']) !!}
    </div>
</div>