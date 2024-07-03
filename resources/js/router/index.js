import { createRouter, createWebHistory } from 'vue-router'
import guest from "@/middleware/guest.js";
import auth from "@/middleware/auth.js";
import loadData from "@/middleware/load-data.js";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      redirect: 'login',
      beforeEnter: guest,
      component: () => import('@/views/Auth/Layouts.vue'),
      children: [
        {
          path: 'login',
          name: 'login',
          meta: {title: 'Login'},
          component: () => import('@/views/Auth/Login.vue')
        },
        {
          path: '/register',
          name: 'register',
          meta: {title: 'Register'},
          component: () => import('@/views/Auth/Register.vue')
        },
        {
          path: '/forgot-password',
          name: 'forgot.password',
          meta: {title: 'Forgot Password'},
          component: () => import('@/views/Auth/ForgotPassword.vue')
        }
      ]
    },

    {
      path: '/dashboard',
      beforeEnter: loadData,
      component: () => import('@/layouts/AuthenticateLayouts.vue'),
      children: [
        {
          path: '/dashboard',
          name: 'dashboard.index',
          meta: {title: 'Dashboard'},
          component: () => import('@/views/Backend/Dashboard/Index.vue')
        },

        {
          path: '/doctors',
          name: 'doctors.index',
          meta: {title: 'Doctors'},
          component: () => import('@/views/Backend/Doctors/Index.vue')
        },
        {
          path: '/doctors/create',
          name: 'doctors.create',
          meta: {title: 'Doctors'},
          component: () => import('@/views/Backend/Doctors/CreateOrEdit.vue')
        },
        {
          path: '/doctors/:id/edit',
          name: 'doctors.edit',
          meta: {title: 'Doctors'},
          component: () => import('@/views/Backend/Doctors/CreateOrEdit.vue')
        },
        {
          path: '/doctors/:id/view',
          name: 'doctors.view',
          meta: {title: 'Doctors'},
          component: () => import('@/views/Backend/Doctors/Profile/Index.vue'),
          children: [
              {
                path: '',
                name: 'doctors.view.profile',
                meta: { title: 'Doctor Profile' },
                component: () => import('@/views/Backend/Doctors/Profile/Layout/About.vue'),
              },
              {
                path: 'setting',
                name: 'doctors.view.setting',
                meta: { title: 'Doctor Profile' },
                component: () => import('@/views/Backend/Doctors/Profile/Layout/Setting.vue'),
              }
            ]
        },


        {
          path: '/patients',
          name: 'patients.index',
          meta: {title: 'Patients'},
          component: () => import('@/views/Backend/Patients/Index.vue')
        },
        {
          path: '/patients/create',
          name: 'patients.create',
          meta: {title: 'Patients'},
          component: () => import('@/views/Backend/Patients/CreateOrEdit.vue')
        },
        {
          path: '/patients/:id/edit',
          name: 'patients.edit',
          meta: {title: 'Patients'},
          component: () => import('@/views/Backend/Patients/CreateOrEdit.vue')
        },

        {
          path: '/appointments',
          name: 'appointments.index',
          meta: {title: 'Appointments'},
          component: () => import('@/views/Backend/Appointments/Index.vue')
        },
        {
          path: '/appointments/create',
          name: 'appointments.create',
          meta: {title: 'Appointments'},
          component: () => import('@/views/Backend/Appointments/CreateOrEdit.vue')
        },
        {
          path: '/appointments/:id/edit',
          name: 'appointments.edit',
          meta: {title: 'Appointments'},
          component: () => import('@/views/Backend/Appointments/CreateOrEdit.vue')
        },

        {
          path: '/staff',
          name: 'staff.index',
          meta: {title: 'Staff'},
          component: () => import('@/views/Backend/Staff/Index.vue')
        },
        {
          path: '/staff/create',
          name: 'staff.create',
          meta: {title: 'Staff'},
          component: () => import('@/views/Backend/Staff/CreateOrEdit.vue')
        },
        {
          path: '/staff/:id/edit',
          name: 'staff.edit',
          meta: {title: 'Staff'},
          component: () => import('@/views/Backend/Staff/CreateOrEdit.vue')
        },


        {
          path: '/roles',
          name: 'roles.index',
          meta: {title: 'Roles'},
          component: () => import('@/views/Backend/Staff/Role/Index.vue')
        },
        {
          path: '/roles/create',
          name: 'roles.create',
          meta: {title: 'Roles'},
          component: () => import('@/views/Backend/Staff/Role/CreateOrEdit.vue')
        },
        {
          path: '/roles/:id/edit',
          name: 'roles.edit',
          meta: {title: 'Roles'},
          component: () => import('@/views/Backend/Staff/Role/CreateOrEdit.vue')
        },

        {
          path: '/schedules',
          name: 'schedules.index',
          meta: {title: 'Schedules'},
          component: () => import('@/views/Backend/Schedules/Index.vue')
        },
        {
          path: '/schedules/create',
          name: 'schedules.create',
          meta: {title: 'Schedules'},
          component: () => import('@/views/Backend/Schedules/CreateOrEdit.vue')
        },
        {
          path: '/schedules/:id/edit',
          name: 'schedules.edit',
          meta: {title: 'Schedules'},
          component: () => import('@/views/Backend/Schedules/CreateOrEdit.vue')
        },


        {
          path: '/departments',
          name: 'departments.index',
          meta: {title: 'Departments'},
          component: () => import('@/views/Backend/Departments/Index.vue')
        },
        {
          path: '/departments/create',
          name: 'departments.create',
          meta: {title: 'Departments'},
          component: () => import('@/views/Backend/Departments/CreateOrEdit.vue')
        },
        {
          path: '/departments/:id/edit',
          name: 'departments.edit',
          meta: {title: 'Departments'},
          component: () => import('@/views/Backend/Departments/CreateOrEdit.vue')
        },

        {
          path: '/leaves',
          name: 'leaves.index',
          meta: {title: 'Leaves'},
          component: () => import('@/views/Backend/Staff/Leaves/Index.vue')
        },
        {
          path: '/leaves/create',
          name: 'leaves.create',
          meta: {title: 'Leaves'},
          component: () => import('@/views/Backend/Staff/Leaves/CreateOrEdit.vue')
        },
        {
          path: '/leaves/:id/edit',
          name: 'leaves.edit',
          meta: {title: 'Leaves'},
          component: () => import('@/views/Backend/Staff/Leaves/CreateOrEdit.vue')
        },

        {
          path: '/activities',
          name: 'activities.index',
          meta: {title: 'Activities'},
          component: () => import('@/views/Backend/Activities/Index.vue')
        },

        {
          path: '/accounts',
          redirect: '/accounts/invoices',
          children: [
            {
              path: '/accounts/invoices',
              name: 'invoices.index',
              meta: {title: 'Invoices'},
              component: () => import('@/views/Backend/Accounts/Invoices/Index.vue')
            },
            {
              path: '/accounts/invoices/create',
              name: 'invoices.create',
              meta: {title: 'Invoices'},
              component: () => import('@/views/Backend/Accounts/Invoices/CreateOrEdit.vue')
            },
            {
              path: '/accounts/invoices/:id/edit',
              name: 'invoices.edit',
              meta: {title: 'Invoices'},
              component: () => import('@/views/Backend/Accounts/Invoices/CreateOrEdit.vue')
            },

            {
              path: '/accounts/payments',
              name: 'payments.index',
              meta: {title: 'Payments'},
              component: () => import('@/views/Backend/Accounts/Payments/Index.vue')
            },
            {
              path: '/accounts/payments/create',
              name: 'payments.create',
              meta: {title: 'Payments'},
              component: () => import('@/views/Backend/Accounts/Payments/CreateOrEdit.vue')
            },
            {
              path: '/accounts/payments/:id/edit',
              name: 'payments.edit',
              meta: {title: 'Payments'},
              component: () => import('@/views/Backend/Accounts/Payments/CreateOrEdit.vue')
            },

            {
              path: '/accounts/expenses',
              name: 'expenses.index',
              meta: {title: 'Expenses'},
              component: () => import('@/views/Backend/Accounts/Expenses/Index.vue')
            },
            {
              path: '/accounts/expenses/create',
              name: 'expenses.create',
              meta: {title: 'Expenses'},
              component: () => import('@/views/Backend/Accounts/Expenses/CreateOrEdit.vue')
            },
            {
              path: '/accounts/expenses/:id/edit',
              name: 'expenses.edit',
              meta: {title: 'Expenses'},
              component: () => import('@/views/Backend/Accounts/Expenses/CreateOrEdit.vue')
            },

            {
              path: '/accounts/taxes',
              name: 'taxes.index',
              meta: {title: 'Taxes'},
              component: () => import('@/views/Backend/Accounts/Taxes/Index.vue')
            },
            {
              path: '/accounts/taxes/create',
              name: 'taxes.create',
              meta: {title: 'Taxes'},
              component: () => import('@/views/Backend/Accounts/Taxes/CreateOrEdit.vue')
            },
            {
              path: '/accounts/taxes/:id/edit',
              name: 'taxes.edit',
              meta: {title: 'Taxes'},
              component: () => import('@/views/Backend/Accounts/Taxes/CreateOrEdit.vue')
            }
          ]
        },

        {
          path: '/payroll/salary',
          name: 'employee_salaries.index',
          meta: {title: 'Salary'},
          component: () => import('@/views/Backend/Payroll/Index.vue')
        },
        {
          path: '/payroll/salary/create',
          name: 'employee_salaries.create',
          meta: {title: 'Salary'},
          component: () => import('@/views/Backend/Payroll/CreateOrEdit.vue')
        },
        {
          path: '/payroll/salary/:id/edit',
          name: 'employee_salaries.edit',
          meta: {title: 'Salary'},
          component: () => import('@/views/Backend/Payroll/CreateOrEdit.vue')
        },


        {
          path: '/reports',
          redirect: '/reports/expense-reports',
          children: [
            {
              path: '/reports/expense-reports',
              name: 'expense-reports.index',
              meta: {title: 'Expenses-Reports'},
              component: () => import('@/views/Backend/Reports/Expenses/Index.vue')
            },
            {
              path: '/reports/expense-reports/create',
              name: 'expense-reports.create',
              meta: {title: 'Expenses-Reports'},
              component: () => import('@/views/Backend/Reports/Expenses/CreateOrEdit.vue')
            },
            {
              path: '/reports/expense-reports/:id/edit',
              name: 'expense-reports.edit',
              meta: {title: 'Expenses-Reports'},
              component: () => import('@/views/Backend/Reports/Expenses/CreateOrEdit.vue')
            },

            {
              path: '/reports/invoice-reports',
              name: 'invoice-reports.index',
              eta: {title: 'Invoice-Reports'},
              component: () => import('@/views/Backend/Reports/Invoices/Index.vue')
            },
            {
              path: '/reports/invoice-reports/create',
              name: 'invoice-reports.create',
              eta: {title: 'Invoice-Reports'},
              component: () => import('@/views/Backend/Reports/Invoices/CreateOrEdit.vue')
            },
            {
              path: '/reports/invoice-reports/:id/edit',
              name: 'invoice-reports.edit',
              eta: {title: 'Invoice-Reports'},
              component: () => import('@/views/Backend/Reports/Invoices/CreateOrEdit.vue')
            },
          ]
        },


        {
          path: '/settings',
          name: 'settings.index',
          component: () => import('@/views/Backend/Settings/Layout.vue'),
          children: [
            {
              path: '',
              name: 'general.settings',
              meta: {title: 'General-Settings'},
              component: () => import('@/views/Backend/Settings/General.vue')
            },
            {
              path: '/localization',
              name: 'localization.settings',
              meta: {title: 'Localization-Settings'},
              component: () => import('@/views/Backend/Settings/Localization.vue')
            },
            {
              path: '/business_hours',
              name: 'business_hours.settings',
              meta: {title: 'BusinessHours-Settings'},
              component: () => import('@/views/Backend/Settings/BusinessHours.vue')
            },
            {
              path: '/payment',
              name: 'payment.settings',
              meta: {title: 'Payment-Settings'},
              component: () => import('@/views/Backend/Settings/Payment.vue')
            },

            {
              path: '/email',
              name: 'email.settings',
              meta: {title: 'Email-Settings'},
              component: () => import('@/views/Backend/Settings/Email.vue')
            },
            {
              path: '/social-media',
              name: 'social.media',
              meta: {title: 'Social-Settings'},
              component: () => import('@/views/Backend/Settings/SocialMedia.vue')
            },
            {
              path: '/social-links',
              name: 'social.links',
              meta: {title: 'Social-Links'},
              component: () => import('@/views/Backend/Settings/SocialLinks.vue')
            },
            {
              path: '/seo',
              name: 'seo.settings',
              meta: {title: 'Seo-Settings'},
              component: () => import('@/views/Backend/Settings/Seo.vue')
            },
            {
              path: '/others',
              name: 'others.settings',
              meta: {title: 'others-Settings'},
              component: () => import('@/views/Backend/Settings/Others.vue')
            },
          ]
        },
      ]
    }
  ]
})


router.beforeEach((to, from, next) => {

  if (!to.name.includes('login') && !to.name.includes('register') && !to.name.includes('forgot.password')) {
    auth(to, from, next)
  }  else {
    next();
  }

  document.title = to.meta.title ? ` ${to.meta.title} | Pre Clinic` : '';
});


export default router
