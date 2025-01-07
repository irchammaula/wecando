<!-- resources/views/admin/edituser.blade.php -->
{{-- @extends('layouts.app') --}}

@section('content')
    <div class="container">
        <h2>Edit User</h2>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
            </div>

            <div class="form-group">
                <label for="balance">Balance:</label>
                <input type="number" class="form-control" id="balance" name="balance" value="{{ old('balance', $user->balance) }}" min="0">
            </div>

            <div class="form-group">
                <label for="quota">Quota:</label>
                <input type="number" class="form-control" id="quota" name="quota" value="{{ old('quota', $user->quota) }}" min="0">
            </div>

            <div class="form-group">
                <label for="role_id">Role:</label>
                <select name="role_id" class="form-control" required>
                    <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Admin</option>
                    <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>User</option>
                    <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
{{-- @endsection --}}
