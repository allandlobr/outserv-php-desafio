@extends('layout.app')

@section('content')
    <div class="d-flex flex-row justify-content-between align-items-center px-3 py-2">
        <h2 class="fs-2">Olá, {{$user->username}}</h2>
        <button class="btn btn-danger" id="logbtn">Sair</button>
    </div>
        <div class=" container text-center mt-4 row">
            <a href="{{  Auth::user()->can('view', \App\Models\User::class) ? route('user.management.index'): ""}}" class="col border border-primary-subtle p-4 {{ Auth::user()->can('view', \App\Models\User::class) ? "" : "disabled text-muted"}}">
                Gerenciamento de Usuários
            </a>
            <a href="{{  Auth::user()->can('view', \App\Models\Profile::class) ? route('profile.management.index'): ""}}" class="col col  border border-primary-subtle p-4 {{ Auth::user()->can('view', \App\Models\Profile::class) ? "" : "disabled text-muted"}}">
                Gerenciamento de Perfis
            </a>

            <a href="{{  Auth::user()->can('view', \App\Models\Permission::class) ? route('permission.management.index'): ""}}" class="col col border border-primary-subtle p-4 {{ Auth::user()->can('view', \App\Models\Permission::class) ? "" : "disabled text-muted"}}">
                Gerenciamento de Permissões
            </a>

        </div>

<script>
    $('#logbtn').on('click', function () {
        $.ajax({
            url: "/logout",
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function () {
                window.location.href = "{{route('login')}}";
            }
        })
    });
</script>
@endsection
