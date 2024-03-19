<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees Table</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
</head>

<body>

    @if (session('successadd'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "Added!",
                    text: "{{ session('successadd') }}",
                    icon: "success"
                });
            });
        </script>
    @endif

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "Updated!",
                    text: "{{ session('success') }}",
                    icon: "success"
                });
            });
        </script>
    @endif

    @if (session('successdelete'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "Deleted!",
                    text: "{{ session('successdelete') }}",
                    icon: "success"
                });
            });
        </script>
    @endif

    @error('password')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "Exist!",
                    text: "Choose another password",
                    icon: "error"
                });
            });
        </script>
    @enderror

    @error('name')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: "Exist!",
                text: "Choose another Name",
                icon: "error"
            });
        });
    </script>
@enderror

    <div class="container mt-2">

        <button class="btn btn-primary">
            <a href="{{ route('login') }}" class="text-white text-decoration-none">←</a>
        </button>

        <div class="row">
            <!-- Add Employee Button -->
            <div class="col-6 text-right ms-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add Password
                </button>
            </div>
        </div><br>

        <!-- Modal for Adding Employee -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.add') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="employeeName" class="form-label">Employee Name</label>
                                <input type="text" class="form-control" id="name"
                                    placeholder="Enter employee name" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="mobile" class="form-label">Mobile No</label>
                                <input type="text" class="form-control" id="mobile" placeholder="eg 918888001212"
                                    name="mobile">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="text" class="form-control" id="password" placeholder="Enter Password"
                                    name="password" required>
                            </div>


                            <div class="mb-3">
                                <label for="employeeSalary" class="form-label">Permissions</label>
                                <select class="form-control" id="countries" name="permissions[]" multiple required>
                                    <option value="DOCUMENTS">DOCUMENTS</option>
                                    <option value="ATTENDENCE">ATTENDENCE</option>
                                    <option value="CFT">CFT</option>
                                    <option value="PRODUCTS">PRODUCTS</option>
                                    <option value="CHEQUE">CHEQUE</option>
                                    <option value="MISC">MISC</option>
                                    <option value="NILGIRI">NILGIRI</option>
                                    <option value="PEELING">PEELING</option>
                                    <option value="TURNOVER">TURNOVER</option>
                                </select>
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table with Edit Column -->
        <div class="table-responsive">
            <table class="table table-hover table-striped" style="font-size:10px;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Password</th>
                        <th>Permission</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($credentialsWithPermissions as $Credential)
                        <tr>
                            <td>{{ $Credential->name }}</td>
                            <td>{{ $Credential->password }}</td>
                            <td>
                                @php
                                    $permissions = json_decode($Credential->permission->permissions, true);
                                @endphp

                                @if (is_array($permissions))
                                    @foreach ($permissions as $key => $permission)
                                        {{ strtoupper($permission) }}

                                        @if ($key < count($permissions) - 1)
                                            ,
                                        @endif
                                    @endforeach
                                @else
                                    {{ strtoupper($Credential->permission->permissions) }}
                                @endif
                            </td>

                            <td>
                                <button class="btn btn-info" data-bs-toggle="modal"
                                    data-bs-target="{{ '#editModal' . $Credential->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <a href="{{ route('admin.delete', ['id' => $Credential->id]) }}"
                                    class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                            <!-- Edit Modal (You may need to create similar modals for each row) -->
                            <div class="modal fade" id="{{ 'editModal' . $Credential->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Permissions</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.update') }}" method="POST">
                                                @csrf


                                                <input type="hidden" name="id" value="{{ $Credential->id }}">

                                                <div class="mb-3">
                                                    <label for="employeeName" class="form-label">Employee Name</label>
                                                    <input type="text" class="form-control" id="name"
                                                        placeholder="Enter employee name" name="name"
                                                        value="{{ $Credential->name }}">
                                                </div>
                                                <div class="mb-3">
                                                    <div class="mb-3">
                                                        <label for="mobile" class="form-label">Mobile No</label>
                                                        <input type="text" class="form-control" id="password"
                                                            value="{{ $Credential->mobile }}"
                                                            placeholder="eg 918888001212" name="mobile">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="text" class="form-control" id="password"
                                                        value="{{ $Credential->password }}"
                                                        placeholder="Enter Password" name="password">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="employeeSalary" class="form-label">Permissions</label>
                                                    <select class="form-control" name="permissions[]" multiple
                                                        required>
                                                        @foreach (['DOCUMENTS', 'ATTENDENCE', 'CFT', 'PRODUCTS','CHEQUE','MISC','NILGIRI','PEELING','TURNOVER'] as $option)
                                                            <option value="{{ $option }}"
                                                                @if (is_array($Credential->permission->permissions) && in_array($option, $Credential->permission->permissions)) selected @endif>
                                                                {{ ucfirst($option) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save
                                                        Permission</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach



                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap 5 dependencies -->
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <!-- Font Awesome Icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

</body>



</html>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        new MultiSelectTag('countries') // id
    });
</script>
