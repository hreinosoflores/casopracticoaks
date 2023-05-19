<div>
    {{-- <x-loading-indicator /> --}}
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Buscar</h3>
                    </div>
                    <div class="card-body">
                        @include('partials.search')
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary btn-block" href="{{ route('users.create') }}">
                            Crear nuevo usuario
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Total de resultados: {{ $data->total() }}</h3>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success" style="width: 100%">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Nombre de usuario</th>
                                        <th>Nombres</th>
                                        <th>Apellido paterno</th>
                                        <th>Apellido materno</th>
                                        <th>Correo electrónico</th>
                                        <th>Roles</th>
                                        {{-- <th>Área</th> --}}
                                        <th width="280px" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $user)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $user->nombreUser }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->primerApellido }}</td>
                                            <td>{{ $user->segundoApellido }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if (!empty($user->getRoleNames()))
                                                    @foreach ($user->getRoleNames() as $v)
                                                        <label class="badge badge-success">{{ $v }}</label>
                                                    @endforeach
                                                @endif
                                            </td>
                                            {{-- <td>{{ $user->area_nombre }}</td> --}}
                                            <td class="text-center">
                                                @if (!$user->hasRole('alumno') && $user->perfil)
                                                    <button wire:click.prevent="abrirModal({{ $user->id }})"
                                                        type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#modelId">
                                                        <i class="fas fa-user-tag"></i>
                                                    </button>
                                                @endif
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('users.show', $user->id) }}">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('users.edit', $user->id) }}">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <button wire:click="deleteRecord({{ $user->id }})"
                                                    type="button" class="btn btn-danger btn-sm">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! $data->render() !!}
                    </div>
                </div>
            </div>
        </div>

        <div wire:ignore.self class="modal fade" id="modelId" tabindex="-1" role="dialog"
            aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Asignar área</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{-- <div class="modal-body">
                        <div class="form-group">
                            <label>Seleccione un área</label>
                            <select wire:model="area_id" class="form-control @error('area_id') is-invalid @enderror">
                                <option value="default">Seleccionar</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                                @endforeach
                            </select>
                            @error('area_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> --}}
                    <div class="modal-footer">
                        <button type="button" wire:click.prevent="asignarArea" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
{{-- @push('js')
    @include('partials.alerts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.livewire.on('close_modal', Msg => {
                $('#modelId').modal('hide');
            });
            window.livewire.on('open_modal', Msg => {
                $('#modelId').modal('show');
            });
        });
    </script>
@endpush --}}
