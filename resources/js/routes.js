const showForo = ()=>import('./components/foro/Show.vue');
const showforoall = ()=>import('./components/Foro.vue');
const addforo = ()=>import('./components/foro/Add.vue');
const editforo = ()=>import('./components/foro/Edit.vue');
const showitem = ()=>import('./components/ShowItem.vue');


const showcategory = ()=>import('./components/category/Show.vue');
const editcategory = ()=>import('./components/category/Edit.vue');
const addcategory = ()=>import('./components/category/Add.vue');


const showuser = ()=>import('./components/user/Show.vue');
const register = ()=>import('./components/user/Register.vue');
const login = ()=>import('./components/user/Login.vue');
const edituser = ()=>import('./components/user/Edit.vue');
const logout = ()=>import('./components/user/Logout.vue');


export const routes = [
    {
        name: 'showforoall',
        path: '/',
        component: showforoall
    },
    {
        name: 'showforo',
        path: '/showforo',
        component: showForo
    },
    {
        name: 'showitem',
        path: '/:id',
        component: showitem
    },
    {
        name: 'addforo',
        path: '/addforo',
        component: addforo
    },
    {
        name: 'editforo',
        path: '/editforo/:id',
        component: editforo
    },
    {
        name: 'showcategory',
        path: '/showcategory',
        component: showcategory
    },
    {
        name: 'addcategory',
        path: '/addcategory',
        component: addcategory
    },
    {
        name: 'editcategory',
        path: '/editcategory/:id',
        component: editcategory
    },
    {
        name: 'showuser',
        path: '/showuser',
        component: showuser
    },
    {
        name: 'register',
        path: '/register',
        component: register
    },
    {
        name: 'login',
        path: '/login',
        component: login
    },
    {
        name: 'logout',
        path: '/logout',
        component: logout
    },
    {
        name: 'edituser',
        path: '/edituser/:id',
        component: edituser
    }


];