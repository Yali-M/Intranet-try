<div>
    <div>
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Liste des Roles
                </div>
                <div class="text-end">

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3"><i class="ri-search-line"></i></span>
                        <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3"
                               wire:model.live="search">
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center fw-medium">
                                        {{$role->name}}
                                    </div>
                                </th>

                                <td>
                                    <div class="hstack gap-2 flex-wrap">

                                        <a class="text-info fs-14 lh-1" data-bs-toggle="tooltip"
                                           data-bs-custom-class="tooltip-primary" title="" href="">
                                            <i class="ri-login-circle-line"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{ $roles->links() }}
                </div>
            </div>

        </div>

    </div>

</div>
