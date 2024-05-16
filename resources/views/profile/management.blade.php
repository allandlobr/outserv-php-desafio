@extends('layout.app')

@section('content')
    <a href="{{route('home')}}" class="btn btn-secondary">Voltar</a>
    <div class="d-flex flex-row justify-content-between align-items-center px-3 py-2 mt-4">
        <h2 class="fs-2">Lista de Perfis</h2>
        @can('create', \App\Models\Profile::class)
            <a href="{{route('profile.management.create')}}" class="btn btn-primary">Criar Novo</a>
        @endcan
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Permissões</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($profiles as $profile)
            <tr>
                <td>{{ $profile->name }}</td>
                <td class="">
                    @foreach ($profile->permissions as $permission)
                        <div>
                            <span class="badge badge-secondary">{{$permission->name}}</span>
                        </div>
                    @endforeach</td>
                <td>
                    <div class="d-flex flex-row justify-content-end">
                        @can('update',\App\Models\Profile::class )
                            <a class="btn btn-primary mr-2"
                               href="{{route('profile.management.edit', ['profileUuid'=>$profile->uuid])}}">Editar</a>
                        @endcan
                        @if(Auth::getUser()->profile->uuid != $profile->uuid)
                            @can('delete',\App\Models\Profile::class )
                                <button data-btndel class="btn btn-danger" data-btndel
                                        data-uuid="{{$profile->uuid}}">
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
            let url = "{{route('profile.management.delete', ['profileUuid'=> ':uuid'])}}";
            url = url.replace(':uuid', uuid);

            $.ajax({
                url: url,
                method: "DELETE",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function () {
                    Swal.fire({
                        title: 'Perfil deletado!',
                        icon: 'success',
                        showConfirmButton: false,
                    }).then(() => window.location.reload())
                }
            })
        });
    </script>
@endsection
