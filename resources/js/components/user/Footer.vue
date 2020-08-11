<template>
    <div>
        <footer>
            <div class="footy-sec mn no-margin">
                <div class="container">
                    <ul>
                        <li><a href="help-center.html" title="">Help Center</a></li>
                        <li><a href="about.html" title="">About</a></li>
                        <li><router-link to="/policy">Policy</router-link></li>
                        <li><router-link to="/question">Forum</router-link></li>
                        <li><a href="#" title="">Language</a></li>
                        <li><a href="#" title=""></a></li>
                    </ul>
                    <p>Copyright {{ new Date().getFullYear() }}</p>
                </div>
            </div>
        </footer>
    </div>
</template>


<script src="https://unpkg.com/vue/dist/vue.min.js"></script>
<script>
export default {
    name: 'Footer',
}
</script>