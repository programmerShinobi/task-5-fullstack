<div class="align-content-justify">
    <table id="posts-publish" class="table table-hover table-condensed table-responsive">
        <thead class="table-dark">
            <th data-orderable="true">#</th>
            <th data-orderable="true">Title</th>
            <th data-orderable="true">Category</th>
            <th data-orderable="false">Action</th>
        </thead>
        <tbody>
            @php $no1=1 @endphp
            @foreach ($posts1 as $post1)
                @if ($post1->status == "publish")
                    <tr>
                        <td>{{ $no1++ }}</td>
                        <td><a href='posts/{{ $post1->id }}/'>{{ $post1->title }}</a></td>
                        <td>{{ $post1->category }}</td>
                        <td>
                            <a class='btn btn-sm btn-outline-dark m-1' href='posts/{{ $post1->id }}/draft'><em class='fa-solid fa-sheet-plastic'></em> Draft</a>
                            <a class='btn btn-sm btn-outline-danger m-1' href='posts/{{ $post1->id }}/trash'><em class='fa-solid fa-trash'></em> Trash</a>
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
            $('#posts-publish').DataTable({
                processing: true,
                serverSide: false
            });
        });
    </script>
@endpush
