@extends('layouts.app')

@section('content')

    <div class="container">
        <form action="" method="POST">
            @csrf

            <input type="text" name="title" class="form-control" placeholder="Título">

            <textarea name="body" class="form-control" placeholder="Mensagem"></textarea>

            <input type="text" name="user_id" class="form-control" placeholder="ID do Usuário">

            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>

    </div>


@endsection
