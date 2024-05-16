@extends('layout.app')

@section('content')
    <h2 class="fs-2">{{empty($user) ? "Criar" : "Editar" }} Usuário</h2>
    <form action="{{
            empty($profile) ?
            route('user.management.store') :
             route('user.management.update', ['profileUuid' => $user->uuid])
          }}" method="POST"
    >
        @method(empty($user) ? "POST" : "PUT")
        @csrf
        <div class="form-group">
            <label class="form-label" for="name">Nome</label>
            <input class="form-control" type="text" name="username" value="{{empty($user) ? '' : $user->username}}"/>
        </div>
        <div class="form-group">
            <label class="form-label" for="profile">Perfil</label>
            <select name="profile_id" class="form-control" >
                @foreach($profiles as $profile)
                    <option value="{{$profile->id}}"
                        {{
                            !empty($user) && $user->profile->id == $profile->id ? "selected" : ""
                        }}>
                        {{$profile->name}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="d-flex flex-row align-self-end">
            <a href="{{route('user.management.index')}}" class="btn btn-secondary mr-2">Cancelar</a>
            <button class="btn btn-primary" type="submit">Salvar</button>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            $('#myForm').submit(function(event) {
                var username = $('#username').val();
                var password = $('#password').val();

                // Validar comprimento mínimo para o campo de nome de usuário
                if (username.length < 8) {
                    alert('O nome de usuário deve ter pelo menos 8 caracteres.');
                    event.preventDefault(); // Impede o envio do formulário
                }

                // Validar comprimento mínimo e caracteres especiais para a senha
                if (password.length < 6) {
                    alert('A senha deve ter pelo menos 6 caracteres.');
                    event.preventDefault(); // Impede o envio do formulário
                } else if (!/^[a-zA-Z0-9]+$/.test(password)) {
                    alert('A senha não deve conter caracteres especiais.');
                    event.preventDefault(); // Impede o envio do formulário
                }
            });
        });
    </script>
@endsection
