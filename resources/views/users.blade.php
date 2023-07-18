@extends("layouts.app")
@section("content")
<html>
<head>
<style>
    #container{
        text-align:center;
    }
    .modal-header{
        text-align:center;
        justify-content:center;
    }
    .form-group{
        text-align:left;
    }
</style>
</head>
<body>
<div id="container">
 <h1>All Users</h1>
 <table class="table">
        <thead class="thead-dark">
            <tr>
                <th class="text-center">User Id</th>
                <th class="text-center">Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Role</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td class="td">{{ $user->id }}</td>
                    <td class=td>{{ $user->name }}</td>
                    <td class=td>{{ $user->email }}</td>
                    <td class=td>{{ $user->role }}</td>
                    <td class=td>
                        <a class="btn btn-info mx-1 btn-xs" href="{{ route('edituser',['id'=>$user->id]) }}">Edit</a>
                        <a class="btn btn-success mx-1 btn-xs" href="{{ route('userdetails',['id'=>$user->id]) }}">Details</a>
                        @if($user->role == "user")
                        <a class="btn btn-danger mx-1 btn-xs userDelete" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete User</a>
                        @endif
                        @if($user->role == "admin")
                        <button class="btn btn-danger mx-1 btn-xs adminDelete" data-bs-toggle="modal" data-bs-target="#exampleModal1">Delete Admin</button>
                        @endif
                    </td>
                </tr>

                
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="text-center" id="exampleModalLabel">Are you sure?</h5>
                    </div>
                    <form method="post" action="{{route('deleteuser')}}">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        This User will be permanently deleted from the database and cannot be recovered.
                    </div>
                    <div class="modal-footer">
                        <input type=hidden id=deluserid name=user_id />
                        <button type="button" class="btn btn-secondary userDelete" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Confirm Delete</button>
                    </div>
                    </form>
                    </div>
                </div>
                </div>
               
                
                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Admin</h5>
                    </div>
                    <div class="modal-body">
                        <p>Authentication required to delete admin account</p>
                        <form method="post" action="{{route('deleteadmin')}}">
                        {{ csrf_field() }}
                        <input type=hidden id=deladminid name=tbd_id />
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="text" name=email id=email class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="password" name=password id=password class="form-control">
                        </div>
                        
                            <input type="submit" class="btn btn-danger my-2" value=Delete>
                        
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        
                    </div>
                    </div>
                </div>
                </div>
               
            @endforeach
        </tbody>
    </table>

    



</div>
<script>
   
    var boxList = document.querySelectorAll(".userDelete");
      boxList.forEach(box => {
        box.addEventListener('click', function b(){boxOperation(this)});
      });
    function boxOperation(e){
        var val= e.closest('tr').children[0].innerText;
        document.getElementById("deluserid").value=val;  
    }
    var boxList2 = document.querySelectorAll(".adminDelete");
      boxList2.forEach(box => {
        box.addEventListener('click', function b(){boxOperation2(this)});
      });
    function boxOperation2(e){
        var val= e.closest('tr').children[0].innerText;
        document.getElementById("deladminid").value=val;  
    }
</script>
</body>
</html>
@endsection



