import VueRouter from 'vue-router'


let routes = [
	
	{
		path: '/',
		component: require('./components/home.vue')
	},

	{
		path: '/product/:id',
		component: require('./components/product.vue')
	},

	{
		path: '/cart',
		component: require('./components/cart.vue')
	}
	

]


export default new VueRouter({
	routes,
	mode: 'history',
});