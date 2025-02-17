<div>

    <div class="container">
        @if ($errors->any())
            <div class="pt-3">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if (session()->has('message'))
            <div class="pt-3">
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            </div>
        @endif
        
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <form>
                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" wire:model="name">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" wire:model="email"">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="address" name="address" wire:model="address">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        @if ($updateData == false)
                        <button type="button" wire:click="store()" class="btn btn-primary" name="submit">Save</button>
                        @else
                        <button type="button" wire:click="update()" class="btn btn-primary" name="submit">Update</button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
        <!-- AKHIR FORM -->

        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <h1>Data Mahasiswa</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-4">Name</th>
                        <th class="col-md-3">Email</th>
                        <th class="col-md-2">Address</th>
                        <th class="col-md-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($studentsData as $key => $student)
                    <tr>
                        <td>{{ $studentsData->firstItem() + $key }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->address }}</td>
                        <td>
                            <a wire:click="edit({{ $student->id }})" class="btn btn-warning btn-sm">Edit</a>
                            <a class="btn btn-danger btn-sm">Del</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $studentsData->links() }}
        </div>
        <!-- AKHIR DATA -->
    </div>

</div>
