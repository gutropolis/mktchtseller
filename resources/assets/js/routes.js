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
                path: '/forget_password',
                component: require('./views/auth/forget_password')
            },
			{
				path : 'password',
				component:require('./views/auth/change_password')
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
				path: '/vender_organisation',
				component:require('./views/pages/manage seller/vender_organisation')
			},
			{
				path: '/product_list',
				component:require('./views/pages/manage seller/product_list')
			},
			
			{
				path: '/vender_Category',
				component:require('./views/pages/manage seller/vender_category')
			},
			
			
			{ 
				name : 'edit_product',
                path: '/edit',
                component: require('./views/pages/manage seller/edit')
            },
			
			{
				path: '/product',
				component:require('./views/pages/manage seller/seller_product')
			},
			{
				path: '/charityfba',
                component: require('./views/pages/charityfba')
			},
			{
				path: '/sellerfab',
				component:require('./views/pages/manage seller/sellersearch')
			},
			{
				path : '/my_account',
				component:require('./views/pages/users/my_account')
			},
			{
				path : 'my_ads',
				component:require('./views/pages/my_ads')
			},
				{ 
				name : 'edit_ads',
                path: '/edit',
                component: require('./views/pages/my_ads/edit_ads')
            },
			{
				path : 'create_ads',
				component:require('./views/pages/my_ads/create_ads')
			},
			{
				path : 'show_ads',
				component:require('./views/pages/my_ads/show_ads')
			},
			{
				
				path : 'my_notification',
				component:require('./views/pages/my_notification')
			},
			{
				path : 'my_message',
				component:require('./views/pages/my_message')
			},
			{
				path : 'my_profile',
				component:require('./views/pages/users/edit_profile')
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