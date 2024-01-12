@extends('admin_dashboard')
@section('admin')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h4 class="header-title mb-2">Assign Permission</h4>
                            </div>

                            <form method="POST" action="{{ route('roles_permissions.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Select Roles</label>

                                            <select name="role_id" class="form-select" aria-label="Default select example">
                                                <option selected disabled value="Select Group">Select Roles</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-check mb-2 form-check-primary">
                                            <input class="form-check-input" type="checkbox" value="" id="supercheck">
                                            <label class="form-check-label" for="supercheck">Select All</label>
                                        </div>
                                    </div>
                                </div>


                                @foreach ($permission_groups as $group)
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <div class="form-check mb-2 form-check-primary">
                                                <input class="form-check-input main-check" type="checkbox" value=""
                                                    id="maincheck_{{ $group->id }}"
                                                    data-group="{{ $group->group_name }}">
                                                <label class="form-check-label"
                                                    for="maincheck_{{ $group->id }}">{{ $group->group_name }}</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            @foreach ($permissions->where('group_name', $group->group_name) as $permission)
                                                <div class="form-check mb-2 form-check-primary">
                                                    <input name="permission[]" class="form-check-input sub-check"
                                                        type="checkbox" value="{{ $permission->id }}"
                                                        id="subcheck_{{ $permission->id }}"
                                                        data-group="{{ $group->group_name }}"
                                                        @if ($RoleHasPermission->contains('permission_id', $permission->id)) checked @endif>
                                                    <label class="form-check-label"
                                                        for="subcheck_{{ $permission->id }}">{{ $permission->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                                <div class="text-end">
                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                            class="mdi mdi-content-save"></i> Save</button>
                                </div>

                                <!-- Add other form fields here -->

                            </form>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->

                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th style="width:10%">#</th>
                                        <th style="width:20%">Role Name</th>
                                        <th>Permissions</th>
             
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $key => $role)
                                    <tr>
                                        <td >{{ $key+1 }}</td>
                                        <td >{{ $role->name }}</td>
                                        <td >
                                        @foreach ($role->permissions as $permission)
                                        <span class="badge bg-primary"> {{ $permission->name }}</span>
                                        @endforeach
                                        </td>
                                        
                                    </tr>
                                @endforeach
                                
                                
                                </tbody>
                            </table>
                        </div> <!-- end card -->
                    </div><!-- end col-->



                </div>


            </div>
        </div> <!-- container -->
    </div> <!-- content -->

    <script>
        // Select the "super check" checkbox
        const superCheckbox = document.getElementById('supercheck');

        // Select all main checkboxes and sub checkboxes
        const allCheckboxes = document.querySelectorAll('.main-check, .sub-check');

        superCheckbox.addEventListener('change', function() {
            // Set the state of all checkboxes to match the "super check" checkbox
            allCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Select all main checkboxes
        const mainCheckboxes = document.querySelectorAll('.main-check');

        mainCheckboxes.forEach(mainCheckbox => {
            mainCheckbox.addEventListener('change', function() {
                // Get the group name associated with the main checkbox
                const group = this.getAttribute('data-group');

                // Select all sub checkboxes in the same group
                const subCheckboxes = document.querySelectorAll(`.sub-check[data-group="${group}"]`);

                // Set the state of the sub checkboxes to match the main checkbox
                subCheckboxes.forEach(subCheckbox => {
                    subCheckbox.checked = this.checked;
                });
            });
        });
    </script>
@endsection
