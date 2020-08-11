
<div class="container">
    <div class="row">
        <div class="offset-2">
        <h1 class="text-light">Welcome to Textile Today Network</h1> 

        <div class="col-4">
        <img width="200" src="https://www.textiletoday.com.bd/wp-content/uploads/2018/08/textile-today-logo-1.png" alt="">
        </div>
         <div class="col-12">
            <p>Hi <span>{{$user->name}}!</span></p>
             <hr>
             <hr>

            <p class="text-justify"> Thanks for getting started with TEXTILE TODAY! We need a litle more information to complete
             your registration, including confirmation of your email address, Click below to confirm your email
            address.</p>
         <a href="http://ttnweb.test/active-admin-account/{{$user->id}}/{{$token}}">Activation Link</a></td> 

         <p>if you have problems,please paste the above URL into your web browser." </p>
     
         </div>   
        </div>
    </div>
</div>