@extends('layout.app')

@section('content')
    <h2 class="fs-2">{{empty($permission) ? "Criar" : "Editar" }} Permissão</h2>
    <form
        action="{{
            empty($permission) ?
            route('permission.management.store') :
             route('permission.management.update', ['permissionUuid' => $permission->uuid])
          }}" method="POST">
        @method(empty($permission) ? "POST" : "PUT")
        @csrf
        <label class="form-label" for="name">Nome</label>
        <input class="form-control mb-4" type="text" name="name" value="{{empty($permission) ? '' : $permission->name}}"/>
        <div class="d-flex flex-row align-self-end">
            <a href="{{route('permission.management.index')}}" class="btn btn-secondary mr-2">Cancelar</a>
            <button class="btn btn-primary" type="submit">Salvar</button>
        </div>
    </form>
@endsection
