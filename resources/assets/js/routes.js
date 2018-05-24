import VueRouter from 'vue-router'
import helper from './services/helper' 

let routes = [
{
        path: '/dashboard',
        component: require('./layouts/default-page'),
        meta: { requiresAuth: true },
        children: [
             {
				path : '/my_account',
				component:require('./views/pages/users/my_account')
			},
			{
				path : '/edit_account',
				component:require('./views/pages/users/edit_profile')
			},
			{
				path : '/my_ads',
				component:require('./views/pages/my_ads')
			},
			
			{
				path : '/create_ads',
				component:require('./views/pages/my_ads/create_ads')
			},
				{ 
				name : 'edit_ads',
                path: '/edit_ads/:id',
                component: require('./views/pages/my_ads/edit_ads')
            },
			{
				path : '/my_notification',
				component:require('./views/pages/my_notification')
			},
			
			{
				path : '/user_chat',
				component:require('./views/pages/message/user_chat')
			},
			
			{
				path : '/users_detail',
				component:require('./views/pages/message/users_detail')
			},
			{
				
				path : '/sent_message',
				component:require('./views/pages/message/sent_message')
			},
			
			{
				name:'users_message',
				path : '/users_message/:id',
				component:require('./views/pages/message/users_message')
			},
			{
				
				path : '/activity_log',
				component:require('./views/pages/manage_seller/activity_log')
			},
			
            {
				path : '/charity_organisation',
				component:require('./views/Charity/charity_organisation')
			},
			
			{
				path : '/charity_category',
				component:require('./views/Charity/charity_category')
			},
			{
				name:'charity_list',
				path : '/charity_list',
				component:require('./views/Charity/charity_list')
			},
			{
				name:'edit_charity',
				path : '/edit_charity/:id',
				component:require('./views/Charity/edit_charity')
			},
			{
				path : '/donaters',
				component:require('./views/Charity/donaters_list')
			},
			{
				name:'change_status',
				path : '/change_status/:id',
				component:require('./views/Charity/change_status')
			},
			
			{
				path:'/request',
				component:require('./views/pages/seller_notification')
				
			},
			
			{
				path: '/vender_organisation',
				component:require('./views/pages/manage_seller/vender_organisation')
			},
			{
				path: '/product',
				component:require('./views/pages/manage_seller/seller_product')
			},
			{
				name:'edit_product',
				path : '/edit_product/:id',
				component:require('./views/pages/manage_seller/edit_product')
			},
			
			{
				path : '/seller_category',
				component:require('./views/pages/manage_seller/seller_category')
			},
			{
				name:'seller_list', 
				path : '/seller_list',
				component:require('./views/pages/manage_seller/seller_list')
			},
			
			{
				name:'edit_seller',
				path : '/edit_seller/:id',
				component:require('./views/pages/manage_seller/edit_seller')
			},
			
			{
				path: '/product_list',
				component:require('./views/pages/manage_seller/product_list')
			},
			{
				name:'report_detail',
				path: '/report_detail/:id',
				component:require('./views/pages/manage_seller/report_detail')
			},
			{
				path: '/donation_list',
				component:require('./views/pages/manage_seller/donation_list')
			},
			{
				name:'edit_donation',
				path: '/edit_donation',
				component:require('./views/pages/manage_seller/edit_donation')
			},
			
        ]
    },
	
	
	
    {
        path: '/',
        component: require('./layouts/guest-page'),
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
                path: '/auth/:token',
                component: require('./views/auth/activate')
            },
            {
                path: '/password:token',
                component: require('./views/auth/reset')
            },
			{
				path: '/aboutus',
                component: require('./views/pages/aboutus')
			},
			{
                path: '/contact',
                component: require('./views/pages/contact')
            },
			{
				path: '/charityfba',
                component: require('./views/Charity/charityfba')
			},
			{
				name:'charity_details',
				path : '/charity_details/:id',
				component:require('./views/Charity/charity_details')
			},
			{
				path: '/sellerfba',
				component:require('./views/pages/manage_seller/Sellerfba')
			},
			{
				
				name:'seller_details',
				path : '/seller_details/:id',
				component:require('./views/pages/manage_seller/seller_details')
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
