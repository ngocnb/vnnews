<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="posts-table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Link</th>
                <th>Source</th>
                <th>Content</th>
                <th>Score Time</th>
                <th>Score Click</th>
                <th>Score Like</th>
                <th>Score Hot</th>
                <th>Is New</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->description }}</td>
                    <td>{{ $post->link }}</td>
                    <td>{{ $post->source }}</td>
                    <td>{{ $post->content }}</td>
                    <td>{{ $post->score_time }}</td>
                    <td>{{ $post->score_click }}</td>
                    <td>{{ $post->score_like }}</td>
                    <td>{{ $post->score_hot }}</td>
                    <td>{{ $post->is_new }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('posts.show', [$post->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('posts.edit', [$post->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $posts])
        </div>
    </div>
</div>
