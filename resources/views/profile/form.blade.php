@extends('layout.app')

@section('content')
    <h2 class="fs-2">{{empty($profile) ? "Criar" : "Editar" }} Perfil</h2>
    <form action="{{
            empty($profile) ?
            route('profile.management.store') :
             route('profile.management.update', ['profileUuid' => $profile->uuid])
          }}" method="POST"
    >
        @method(empty($profile) ? "POST" : "PUT")
        @csrf
        <div class="form-group">
            <label class="form-label" for="name">Nome</label>
            <input class="form-control" type="text" name="name" value="{{empty($profile) ? '' : $profile->name}}"/>
        </div>

        <div class="my-2">Permissões</div>
        <div class="form-group">
            @foreach($permissions as $permission)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="{{$permission->slug_name}}" name="permissions[]"
                           value="{{$permission->id}}"
                        {{
                            !empty($profile) && $profile->permissions?->contains($permission) ? "checked" : ""
                        }}
                    />
                    <label class="form-check-label" for="{{$permission->slug_name}}">{{$permission->name}}</label>
                </div>
            @endforeach
        </div>

        <div class="d-flex flex-row align-self-end">
            <a href="{{route('profile.management.index')}}" class="btn btn-secondary mr-2">Cancelar</a>
            <button class="btn btn-primary" type="submit">Salvar</button>
        </div>
    </form>
@endsection
