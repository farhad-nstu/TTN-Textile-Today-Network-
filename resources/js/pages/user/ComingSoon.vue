<template>
  <div>
    <div class="main-bg">
        <div class="row">
            <div class="container">
                <div class="col message-section text-center">
                    <h1 class="title">THIS MODULE WILL BE COMING SOON</h1>
                    <p class="sub-heading mb-6">Currently we are working on this...</p>
                    <router-link to="/">Home</router-link>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>
<style scoped>
.title{
    font-size: 63px;
    text-align: center;
    color: #fff;
}
.main-bg{
    background-image: url("/images/home/main-bg2.jpg");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
.message-section{
    min-height: 768px;
    top: 30%;
}
.message-section a{
    color: #fff;
    border: 1px solid #fff;
    padding: 8px 21px;
    font-size: 22px;
    border-radius: 25px;
}
.sub-heading{
    color: #fff;
    font-size: 32px;
    margin-top: 22px;
    margin-bottom: 49px;
}
</style>

