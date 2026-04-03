@extends('layouts.app')

@section('content')

<div class="container">
    <div class="top-actions">
        <div><b>Invite new team member</div>
    </div>

    <!-- URL Table -->
    <table class="url-table">
    <tr>
        <td>

            @if(session('success'))
                <p class="success-msg">{{ session('success') }}</p>
            @endif

            <form method="POST" action="{{ route('invite.send') }}">
                @csrf

                <div class="form-row">
                    
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" required>
                    </div>

                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label>Role:</label>
                        <select name="role" required>
                            <option value="member">Member</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                </div>

                <br>
               
                <button type="submit" class="invite">Send Invitation</button>

            </form>

        </td>
    </tr>
</table>
</div>

@endsection