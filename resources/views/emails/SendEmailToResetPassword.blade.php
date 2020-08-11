<div class="container">
    <div class="row">
        <div class="offset-2">
        <h1 class="text-light">Welcome to Textile Today Network</h1> 

        <div class="col-4">
        <img width="200" src="https://www.textiletoday.com.bd/wp-content/uploads/2018/08/textile-today-logo-1.png" alt="">
        </div>
         <div class="col-12">
            <p>name : <span>{{$user->name}}</span></p>
            <p>email : <span>{{$user->email}}</span></p>

            <hr>
            <hr>
            <span> Please click below the link to change password</span>
            <a href="http://ttnweb.test/reset-password/{{$user->id}}/{{$token}}">Change Password</a></td> 
         </div>   
        </div>
    </div>
</div>