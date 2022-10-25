<div class="align-content-justify">
    <table id="posts-draft" class="table table-hover table-border table-condensed table-responsive">
        <thead class="table-dark">
            <th data-orderable="true">#</th>
            <th data-orderable="true">Title</th>
            <th data-orderable="true">Category</th>
            <th data-orderable="false">Action</th>
        </thead>
        <tbody>
            @php $no2=1 @endphp
            @foreach ($posts2 as $post2)
                @if ($post2->status == "draft")
                <tr>
                    <td>{{ $no2++ }}</td>
                    <td><a href='posts/{{ $post2->id }}/'>{{ $post2->title }}</a></td>
                    <td>{{ $post2->category }}</td>
                    <td>
                        <a href="{{ route('posts.edit', $post2->id) }}" class="btn btn-sm btn-outline-dark m-1"><em class="fa-solid fa-pen-to-square"></em> Edit</a>
                        <a class='btn btn-sm btn-outline-danger m-1' href='posts/{{ $post2->id }}/trash'><em class='fa-solid fa-trash'></em> Trash</a>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

@push('scripts')
    <script>
        $(function () {
            $('#posts-draft').DataTable({
                processing: true,
                serverSide: false
            });
        });
    </script>
@endpush
