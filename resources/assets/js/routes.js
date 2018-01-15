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
                path: '/home',
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
                path: '/password',
                component: require('./views/auth/change_password')
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
				path: '/product',
				component:require('./views/pages/manage_seller/seller_product')
			},
			{
				path: '/charityfba',
                component: require('./views/Charity/charityfba')
			},
			{
				path: '/sellerfab',
				component:require('./views/pages/manage_seller/sellersearch')
			},
			{
				path : '/my_account',
				component:require('./views/pages/users/my_account')
			},
			{
				path : '/edit_account',
				component:require('./views/pages/users/edit_profile')
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
             {
				path : 'charity_organisation',
				component:require('./views/Charity/charity_organisation')
			},
			{
				path : 'charity_category',
				component:require('./views/Charity/charity_category')
			},
			{
				name:'charity_list',
				path : 'charity_list',
				component:require('./views/Charity/charity_list')
			},
			{
				name:'edit_charity',
				path : '/edit_charity',
				component:require('./views/Charity/edit_charity')
			},
			{
				name:'charity_details',
				path : '/charity_details',
				component:require('./views/Charity/charity_details')
			},
			{
				path: '/vender_organisation',
				component:require('./views/pages/manage_seller/vender_organisation')
			},
			{
				name:'seller_list',
				path : 'seller_list',
				component:require('./views/pages/manage_seller/seller_list')
			},
			{
				name:'edit_seller',
				path : '/edit_seller',
				component:require('./views/pages/manage_seller/edit_seller')
			},
			{
				path: '/product_list',
				component:require('./views/pages/manage_seller/product_list')
			},
			{
				name:'edit_product',
				path : '/edit_product',
				component:require('./views/pages/manage_seller/edit_product')
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
