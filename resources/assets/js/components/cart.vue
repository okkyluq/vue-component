<template>
    <div class="container" style="margin-top :100px;">
        <table id="cart" class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width:50%">Product</th>
                    <th style="width:10%">Price</th>
                    <th style="width:8%">Quantity</th>
                    <th style="width:22%" class="text-center">Subtotal</th>
                    <th style="width:10%" class="text-center"><i class="fa fa-gear"></i></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="cart in carts">
                    <td>{{cart.product_name}}</td>
                    <td>Rp.{{formatPrice(cart.price)}}</td>
                    <td>
                        <input type="number" class="form-control text-center" value="1" v-model="cart.qty" min="1">
                    </td>
                    <td class="text-center">Rp.{{formatPrice(cart.qty * cart.price)}}</td>
                    <td class="actions text-center">
                        <button class="btn btn-danger btn-sm" type="button" v-on:click="deleteCart(cart.id)"><i class="fa fa-trash-o"></i></button>                                
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="visible-xs">
                    <td class="text-center"><strong>Total Rp.{{formatPrice(total)}}</strong></td>
                </tr>
                <tr>
                    <td>
                    <router-link to="/" tag="a" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shoping</router-link>
                    </td>
                    <td colspan="2" class="hidden-xs"></td>
                    <td class="hidden-xs text-center"><strong>Total Rp.{{formatPrice(total)}}</strong></td>
                    <td><a href="#" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
                </tr>
            </tfoot>
        </table>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                carts:{},
            }
        },
        mounted() {
            this.getCart();
            if (!this.$cookies.isKey("id_cookie")) {
                var cookie = Date.now();
                this.$cookies.set("id_cookie", cookie,"1d");
            }
        },
        methods:{
            getCart: function(){
                let vm = this;
                var cookie = this.$cookies.get("id_cookie");
                axios.get("data/cart?id="+cookie)
                .then(function(respon){
                    vm.carts = respon.data;
                    console.log(respon.data);
                })  
                .catch(function(error){
                    console.log(error);
                });
            },
            formatPrice(value) {
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
            deleteCart: function(id){
                let vm = this;
                axios.post("delete/cart", {id_product: id, cookie: this.$cookies.get("id_cookie")})
                .then(function(respon){
                    vm.getCart();
                })
                .catch(function(error){
                    console.log(error);
                });
            }
        },
        computed:{
            total: function(){
                return this.carts.reduce(function(carry, carts){
                    return carry + (parseFloat(carts.qty) * parseFloat(carts.price));
                }, 0);
            }
        }
    }
</script>
