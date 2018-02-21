    <template>
    <app-menu></app-menu>
    <div class="container">
        <div class="row text-center" style="margin-top: 50px;">
            <div class="col-lg-3 col-md-6 mb-4" v-for="product in products">
                <div class="card">
                    <img class="card-img-top" src="https://cdn2.macworld.co.uk/cmsdata/reviews/3625110/iphone_se_review_08.jpg" alt="">
                    <div class="card-body">
                        <h4 class="card-title">{{product.product_name}}</h4>
                        <p class="card-text">{{product.description}}</p>
                    </div>
                    <div class="card-footer">
                        <div class="pull-left">
                            <span class="badge">Rp.{{product.price}}</span>
                        </div>
                        <div class="pull-right">
                            <a href="#" class="btn btn-sm btn-primary" v-on:click.prevent="storeCart(product.id)">Add To Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </template>  
<script>
    import Menu from './nav.vue'
    export default {
        components: {
            'appMenu': Menu
        },
        data(){
            return{
                products:{},
                cart:{},
            }
        },
        mounted() {
            this.getProducts();
            // set cookie
            if (!this.$cookies.isKey("id_cookie")) {
                var cookie = Date.now();
                this.$cookies.set("id_cookie", cookie,"1d");
            }
        },
        methods: {
            getProducts: function(){
                let vm = this;
                axios.get('data/product')
                .then(function(respon){
                    vm.products = respon.data;
                })  
                .catch(function(error){
                    console.log(error);
                });
            },

            storeCart: function(id){
                axios.post('store/product', {id_product : id, id_cookie: this.$cookies.get("id_cookie")})
                .then(function(respon){

                })
                .catch(function(error){
                    Vue.swal({
                        type: 'error',
                        title: 'Oops...',
                        text: error.response.data.error,
                    });
                });
            }
            
        },
        computed: {
            
        },

    }
</script>
