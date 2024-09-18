@extends('layouts.header')
@vite('resources/css/app.css')
@section('content')
<div class="min-h-screen flex flex-col">
    <div class="flex-grow">
        <div class="container container-register">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Shop Information Section -->
                    <div class="col-md-6 form-section">
                        <h4><strong>SHOP INFORMATION SECTION:</strong></h4>
                        <div class="form-group">
                            <label for="S_name">Shop Name:</label>
                            <input type="text" class="form-control" id="S_name" name="S_name" value="{{ old('S_name') }}" placeholder="Name of your shop" required>
                        </div>
                        <div class="form-group">
                            <label for="L_name">Brand Name:</label>
                            <input type="text" class="form-control" id="L_name" name="L_name" value="{{ old('L_name') }}" placeholder="Location name" required>
                        </div>
                        <div class="form-group">
                            <label for="L_address">Address:</label>
                            <input type="text" class="form-control" id="L_address" name="L_address" placeholder="Shop address" required>
                        </div>
                        <div class="form-group">
                            <label for="L_contact">Location Contact:</label>
                            <input type="text" class="form-control" id="L_contact" name="L_contact" value="{{ old('L_contact') }}" placeholder="Location Contact" required>
                        </div>
                        <div class="form-group">
                            <label for="S_logo">Logo:</label>
                            <div>
                                <button class="select-logo" onclick="document.getElementById('S_logo').click()">Browse</button>
                                <input type='file' id="S_logo" name="S_logo" style="display:none">
                            </div>
                        </div>

                        <!-- Owner Information Section -->
                        <div class="pt-4">
                            <h4><strong>OWNER INFORMATION SECTION:</strong></h4>
                            <div class="form-group">
                                <label for="O_name">Name:</label>
                                <input type="text" class="form-control" id="O_name" name="O_name" value="{{ old('O_name') }}" placeholder="Owner's name" required>
                            </div>
                            <div class="form-group">
                                <label for="O_email">Email:</label>
                                <input type="email" class="form-control" id="O_email" name="O_email" value="{{ old('O_email') }}" placeholder="Email address" required>
                            </div>
                            <div class="form-group">
                                <label for="O_contact">Phone:</label>
                                <input type="text" class="form-control" id="O_contact" name="O_contact" value="{{ old('O_contact') }}" placeholder="Owner's contact number" required>
                            </div>
                            <div class="form-group">
                                <label for="O_address">Address:</label>
                                <input type="text" class="form-control" id="O_address" name="O_address" value="{{ old('O_address') }}" placeholder="Owner's address" required>
                            </div>
                        </div>
                    </div>

                    <!-- User Section -->
                    <div class="col-md-6 form-section">
                        <h4><strong>USER SECTION:</strong></h4>
                        <div class="form-group">
                            <label for="U_name">Name:</label>
                            <input id="U_name" type="text" class="form-control @error('U_name') is-invalid @enderror" name="U_name" value="{{ old('U_name') }}" placeholder="User's name" required autocomplete="U_name" autofocus>
                            @error('U_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="U_photo">User Photo:</label>
                            <div>
                                <button class="select-logo" onclick="document.getElementById('U_photo').click()">Browse</button>
                                <input type='file' id="U_photo" name="U_photo" style="display:none">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="U_contact">Phone:</label>
                            <input type="text" class="form-control" id="U_contact" name="U_contact" value="{{ old('U_contact') }}" placeholder="09283774" required>
                        </div>
                        <div class="form-group">
                            <label for="sys_name">System Name:</label>
                            <input type="text" class="form-control" id="sys_name" name="sys_name" value="{{ old('sys_name') }}" placeholder="System Name" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="*********" name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Confirm Password:</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <label for="R_id">System Role:</label>
                            <select class="form-control" id="R_id" name="R_id" required>
                                <option value="" disabled selected>Select a role</option>
                                @foreach ($invRole as $role)
                                <option value="{{ $role->R_id }}">{{ $role->R_type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="submit-button pt-4">
                            <button type="submit" class="btn btn-primary">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('layouts.footer')
</div>


@endsection
<style>
.form-group {
    display: flex;
    align-items: center; 
    margin-bottom: 15px; 
}
label {
    min-width: 100px;
    margin-right: 15px; 
}
.select-logo{
    display: block;
    width: 120px;
    height: 30px;
    border-radius: 5px;
    background-clip: padding-box;
    border: 0.25px solid #ced4da;
    background-color: #fff;
}
</style>
