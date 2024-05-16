@php use App\Models\User;use Illuminate\Support\Facades\Auth; @endphp
@extends('layout.app')

@section('content')
    <a href="{{route('home')}}" class="btn btn-secondary">Voltar</a>
    <div class="d-flex flex-row justify-content-between align-items-center px-3 py-2 mt-4">
        <h2 class="fs-2">Lista de Usuários</h2>
        @can('create', User::class)
            <a href="{{route('user.management.create')}}" class="btn btn-primary">Criar Novo</a>
        @endcan
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Perfil</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->username }}</td>
                <td class="">
                    <div>{{$user->profile->name}}</div>
                <td>
                    <div class="d-flex flex-row justify-content-end">
                        @can('update',User::class )
                            <a class="btn mr-2 btn-primary"
                               href="{{route('user.management.edit', ['userUuid'=>$user->uuid])}}">Editar</a>
                        @endcan
                        @if(Auth::getUser()->uuid != $user->uuid)
                            @can('delete', User::class)
                                <button data-btndel class="btn btn-danger" data-uuid="{{$user->uuid}}">
                                    Deletar
                                </button>
                            @endcan
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <script>
        $('[data-btndel]').on('click', function () {
            var uuid = $(this).data('uuid');
            let url = "{{route('user.management.delete', ['userUuid'=> ':uuid'])}}";
            url = url.replace(':uuid', uuid);

            $.ajax({
                url: url,
                method: "DELETE",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function () {
                    Swal.fire({
                        title: 'Usuário deletado!',
                        icon: 'success',
                        showConfirmButton: false,
                    }).then(() => window.location.reload())
                }
            })
        });
    </script>
@endsection
