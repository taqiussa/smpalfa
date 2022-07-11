<div>
    <div class="col-md-12">
        <x-card>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Judul</th>
                            <th>Kreator</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_post as $key => $post)
                            <tr>
                                <td>{{ $list_post->firstItem() + $key }}</td>
                                <td>{{ date('d M Y', strtotime($post->tanggal)) }}</td>
                                <td>{{ $post->judul }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>
                                    <a href="{{ route('kreator.post.list-post.detail',['slug' => $post->slug]) }}" class="badge text-primary mx-2 my-2"><i class="fas fa-eye"></i></a>
                                    <a wire:click.prevent="confirm({{ $post->id }})" class="badge text-danger mx-2 my-2"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{ $list_post->links() }}
            </div>
        </x-card>
    </div>
</div>
