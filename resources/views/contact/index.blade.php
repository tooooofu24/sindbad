@extends('layouts.app')

@section('title','シンドバッド - お問い合わせ')
@section('nav-title','お問い合わせ')

@section('content')
@include('layouts.public-nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">お問い合わせ</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('contact.store') }}" class="px-3">
                        @csrf

                        <div class="row mb-3">
                            <label for="password" class="col-md-5 col-lg-4 col-xl-3 col-form-label text-md-right">お問い合わせ内容</label>

                            <div class="col">
                                <textarea class="form-control" id="content" name="content" required rows="5" placeholder="ここに内容を入力してください。"></textarea>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                送信する
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection