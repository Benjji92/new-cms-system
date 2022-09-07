<x-admin-master>

    @section('content')
        <h1>User Profile for: {{ $user->name }}</h1>

        <div class="row">
            <div class="col-sm-6">
                <form action="{{ route('user.update', $user) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <img class="img-thumbnail rounded-circle"
                            src="{{ $user->avatar }}" alt="">
                    </div>
                    <div class="form-group">
                        <input type="file" name="avatar">
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                            id="username" value="{{ $user->username }}">
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                            value="{{ $user->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            value="{{ $user->email }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_conmfirmation">Confirm Password</label>
                        <input type="password" name="password_conmfirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
                            id="password_conmfirmation">
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                 <div class="card-body">
                         <div class="table-responsive">
                             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                 <thead>
                                     <tr>
                                        <th>Options</th>
                                         <th>ID</th>
                                         <th>Name</th>
                                         <th>Slug</th>
                                         <th>Attach</th>
                                         <th>Detach</th>
                                     </tr>
                                 </thead>
                                 <tfoot>
                                     <tr>
                                        <th>Options</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Attach</th>
                                        <th>Detach</th>
                                     </tr>
                                 </tfoot>
                                 <tbody>
                                     @foreach ($roles as $role)
                                     <tr>
                                        <td><input type="checkbox"
                                            @foreach ($user->roles as $user_role)
                                                @if ($user_role->slug == $role->slug)
                                                    checked
                                                @endif
                                            @endforeach
                                            
                                            name="" id=""></td>
                                         <td>{{ $role->id }}</td>
                                         <td>{{ $role->name }}</td>
                                         <td>{{ $role->slug }}</td>
                                         <td>
                                             <form action="{{ route('user.role.attach', $user) }}" method="post">
                                                     @csrf  
                                                     @method('PUT')
                                                     <input type="hidden" name="role" value="{{ $role->id }}">
                                                     <button class="btn btn-primary
                                                     @if ($user->roles->contains($role))
                                                         disabled
                                                     @endif
                                                     
                                                     ">Attach</button>
                                                     
                                                 </form>

                                         </td>
                                         <td>
                                            <form action="{{ route('user.role.detach', $user->id) }}" method="post">
                                                @csrf  
                                                @method('PUT')
                                                <input type="hidden" name="role" value="{{ $role->id }}">
                                                <button class="btn btn-danger
                                                @if (!$user->roles->contains($role))
                                                         disabled
                                                     @endif
                                                ">Detach</button>
                                            </form>

                                        </td>
                                     </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                         </div>
                     </div>
            </div>
        </div>
    @endsection

</x-admin-master>

