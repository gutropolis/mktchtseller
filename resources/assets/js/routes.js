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
                path: '/register',
                component: require('./views/auth/register')
            },
			{
                path: '/charityregister',
                component: require('./views/auth/charityregister')
            },
			{
                path: '/social',
                component: require('./views/auth/social-auth')
            },
			{
                path: '/select_role',
                component: require('./views/auth/select_role')
            },
			
			{
                path: '/auth/:token/activate',
                component: require('./views/auth/activate')
            },
            {
                path: '/password/reset/:token',
                component: require('./views/auth/reset')
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
				path: '/sellerfba',
				component:require('./views/pages/manage_seller/Sellerfba')
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
				component:require('./views/pages/message/my_message')
			},
			{
				path : 'create_message',
				component:require('./views/pages/message/create_message')
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
				path : 'seller_category',
				component:require('./views/pages/manage_seller/seller_category')
			},
			{
				name:'seller_list',
				path : 'seller_list',
				component:require('./views/pages/manage_seller/seller_list')
			},
			{
				name:'seller_details',
				path : 'seller_details',
				component:require('./views/pages/manage_seller/seller_details')
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
			
			{
				path : 'user_chat',
				component:require('./views/pages/message/user_chat')
			},
			
			
			{
				path : 'users_detail',
				component:require('./views/pages/message/users_detail')
			},
			
			{
				path : 'users_message',
				component:require('./views/pages/message/users_message')
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

router.beforeEach((to, from, next) => {

    if (to.matched.some(m => m.meta.requiresAuth)){
        return helper.check().then(response => {
            if(!response){
                return next({ path : '/login'})
            }

            return next()
        })
    }
	

 return next()
});

export default router;
