@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <x-card>
        <div
        class="row g-0 border rounded-md shadow overflow-hidden flex-md-row shadow-sm h-md-250 position-relative my-2">
        <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary"><a href="#">{{ $post->user->name }}</a></strong>
            <h3 class="mb-0">{{ $post->judul }}</h3>
            <div class="mb-1 text-muted">{{ date('d M Y', strtotime($post->tanggal)) }}</div>
            @if($post->foto)
            <img src="{{ asset('storage/' . $post->foto) }}" alt="gambar" class="img img-thumbnail my-2">
            @endif
            <p class="card-text mb-auto">
                {!! $post->isi !!}
            </p>
        </div>
        <div class="d-flex justify-content-end p-3">
            <a href="{{ route('kreator.post.list-post') }}"><i class="fas fa-chevron-left"></i> Kembali</a>
        </div>
    </div>
    </x-card>
</div>
@endsection