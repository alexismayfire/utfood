@extends('layouts.base')

@section('content')
    <div>
        <h3>{{ $usuario->name }}</h3>
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('editar_conta') }}">
                            @csrf
                            <div class="form-group">
                                <label for="nome">Nome: </label>
                                <input
                                    type="text" id="nome" class="form-control"
                                    placeholder="{{ $usuario->name }}"
                                />
                            </div>
                            <div class="form-group">
                                <label for="email">Nome: </label>
                                <input
                                    type="email" id="email" class="form-control"
                                    placeholder="{{ $usuario->email }}"
                                />
                            </div>
                            <div class="form-group">
                                <label for="email">Telefone: </label>
                                <input
                                    type="text" id="telefone" class="form-control"
                                    placeholder="{{ $usuario->telefone }}"
                                />
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
