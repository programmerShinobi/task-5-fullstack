<div class="align-content-justify">
    <table id="posts-trash" class="table table-hover table-border table-condensed table-responsive">
        <thead class="table-dark">
            <th data-orderable="true">#</th>
            <th data-orderable="true">Title</th>
            <th data-orderable="true">Category</th>
            <th data-orderable="false">Action</th>
        </thead>
        <tbody>
            @php $no3=1 @endphp
            @foreach ($posts3 as $post3)
                @if ($post3->status == "trash")
                <tr>
                    <td>{{ $no3++ }}</td>
                    <td><a href='posts/{{ $post3->id }}/'>{{ $post3->title }}</a></td>
                    <td>{{ $post3->category }}</td>
                    <td class="d-grid d-md-flex">
                        <div>
                            <form class="form-delete" action="{{ route('posts.destroy', $post3->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <a class='btn btn-sm btn-outline-dark m-1' href='posts/{{ $post3->id }}/draft'><em class='fa-solid fa-sheet-plastic'></em> Draft</a>
                                <button type="submit" class="btn btn-sm btn-outline-danger m-1" onclick="return confirm('Are you sure?')"><em class="fa-solid fa-trash"></em> Delete</button>
                            </form>
                        </div>
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
            $('#posts-trash').DataTable({
                processing: true,
                serverSide: false
            });
        });
    </script>
@endpush
