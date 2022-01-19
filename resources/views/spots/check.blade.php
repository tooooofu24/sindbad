@extends('layouts.header')

@section('content')
<div class="container">
    @if(session('message'))
    <div class="px-1 pt-3">
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    </div>
    @endif
    @if(session('error_message'))
    <div class="px-1 pt-3">
        <div class="alert alert-danger" role="alert">
            エラーが発生しました。<br>
            画面をキャプチャして開発者までお問い合わせください。
            <div style="white-space: pre-wrap;">{{ session('error_message') }}</div>
        </div>
    </div>
    @endif
    <div class="row my-3">
        @foreach($spots as $spot)
        <div class="col-md-3 px-3 py-2">
            <div class="card rounded-3 rounded-top p-0">
                <div class="ratio ratio-16x9">
                    <img @if($spot->thumbnail_url) src="{{ $spot->thumbnail_url }}" @else src="https://www.publicdomainpictures.net/pictures/280000/velka/not-found-image-15383864787lu.jpg" @endif alt="{{$spot->name}}" style="object-fit: cover; border-radius: 0.3rem 0.3rem 0px 0px;"">
                </div>
                <div class="card-body">
                    <div class="card-title d-flex align-items-center">
                        <span class="fw-bold">{{ $spot->name }}</span>
                        @if($spot->status == -10)
                        <i class="fas fa-exclamation-triangle ms-2" style="color: #dc3545;"></i>
                        @endif
                    </div>
                    <div class="text-end mt-2">
                        <form action="{{ route('spots.update', [ 'id' => $spot->id ]) }}" class="d-inline" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="text" value="10" name="status" class="d-none">
                            <button class="btn btn-sm btn-primary">承認する</button>
                        </form>
                        <form action="{{ route('spots.delete', [ 'id' => $spot->id ]) }}" class="d-inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">削除する</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="table-responsive mt-4">
        {{ $spots->appends(request()->query())->links() }}
    </div>
</div>
@endsection