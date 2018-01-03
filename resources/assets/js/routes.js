import VueRouter from 'vue-router'
import helper from './services/helper' 

let routes = [
    {
        path: '/',
        component: require('./layouts/default-page'),
        meta: { requiresGuest: true },
        children: [
			{
                path: '/',
                component: require('./views/pages/home')
            },
			{
                path: '/login',
                component: require('./views/auth/login')
            },
			{
                path: '/register',
                component: require('./views/auth/register')
            },
			{
                path: '/contact',
                component: require('./views/pages/contact')
            },
			{
				path: '/aboutus',
                component: require('./views/pages/aboutus')
			},
			{
				path: '/seller',
				component:require('./views/pages/seller')
			},
			{
				path: '/product',
				component:require('./views/pages/seller_product')
			},
			{
				path: '/charityfba',
                component: require('./views/pages/charityfba')
			},
			{
				path: '/sellerfab',
				component:require('./views/pages/sellersearch')
			},
			{
				path : '/my_account',
				component:require('./views/pages/my_account')
			},
			{
				path : 'my_ads',
				component:require('./views/pages/my_ads')
			},
			{
				path : 'my_notification',
				component:require('./views/pages/my_notification')
			},
			{
				path : 'my_message',
				component:require('./views/pages/my_message')
			},
             
        ]
    },
	 
    {
        path: '*',
        component : require('./layouts/error-page'),
        children: [
            {
                path: '*',
                component: require('./views/errors/page-not-found')
            }
        ]
    }
];

const router = new VueRouter({
	routes,
    linkActiveClass: 'active',
    mode: 'history'
});

 

export default router;
