@extends('layout.app')

@section('content')
    <a href="{{route('home')}}" class="btn btn-secondary">Voltar</a>
    <div class="d-flex flex-row justify-content-between align-items-center px-3 py-2 mt-4">
        <h2 class="fs-2">Lista de Permissões</h2>
        @can('create', \App\Models\Permission::class)
            <a href="{{route('permission.management.create')}}" class="btn btn-primary">Criar Nova</a>
        @endcan
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Identificação</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($permissions as $permission)
            <tr>
                <td class="w-56">{{ $permission->name }}</td>
                <td class="">
                    <div>{{$permission->slug_name}}</div>
                </td>
                <td>
                    <div class="d-flex flex-row justify-content-end ">
                        @can('update',\App\Models\Permission::class )
                            <a class="btn btn-primary mr-2"
                               href="{{route('permission.management.edit', ['permissionUuid'=>$permission->uuid])}}">Editar</a>
                        @endcan
                        @can('delete',\App\Models\Permission::class )
                            <button class="btn btn-danger" data-btndel
                                    data-uuid="{{$permission->uuid}}">
                                Deletar
                            </button>
                        @endcan
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <script>
        $('[data-btndel]').on('click', function () {
            var uuid = $(this).data('uuid');
            let url = "{{route('permission.management.delete', ['permissionUuid'=> ':uuid'])}}";
            url = url.replace(':uuid', uuid);

            $.ajax({
                url: url,
                method: "DELETE",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function () {
                    Swal.fire({
                        title: 'Permissão deletada!',
                        icon: 'success',
                        showConfirmButton: false,
                    }).then(() => window.location.reload())
                }
            })
        });
    </script>
@endsection
