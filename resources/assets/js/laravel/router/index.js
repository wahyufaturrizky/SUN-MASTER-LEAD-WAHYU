import Vue from 'vue'
import Router from 'vue-router'
import Meta from 'vue-meta'

Vue.use(Router)
Vue.use(Meta)

import Home from '../pages/Index'
import SunEduWeb from '../pages/sun-edu-web/Index'
import SunEngWeb from '../pages/sun-eng-web/Index'
import ApplyProgram from '../pages/apply-program/Index'
import SunEngProgram from '../pages/sun-eng-program/Index'
import SunEngSimple from '../pages/sun-eng-web/Simple'
import SunEngAdvanced from '../pages/sun-eng-web/Advanced'
import SunEngSchedule from '../pages/sun-eng-schedule/Index'

export default new Router({
	mode: 'history',
	routes: [
	  {
			path: '/registration',
			name: 'Home',
			component: Home
	  },
	  {
			path: '/registration/sun-edu-web',
			name: 'SunEduWeb',
			component: SunEduWeb
		},
		{
			path: '/registration/apply-program',
			name: 'ApplyProgram',
			component: ApplyProgram
		},
		{
			path: '/registration/sun-eng-web',
			name: 'SunEngWeb',
			component: SunEngWeb,
			children: [
				{
					path: 'simple',
					component: SunEngSimple
				},
				{
					path: 'advanced',
					component: SunEngAdvanced
				}
			]
		},
		{
			path: '/registration/sun-eng-program/:program',
			component: SunEngProgram
		},
		{
			path: '/registration/sun-eng-schedule/:type',
			component: SunEngSchedule
		}
	]
})