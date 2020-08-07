export default [
	{
		path: '/skillmap',
		component: require('page/skillmap/index').default,
		title: 'スキルマップ',
		indent: 0,
	},
	{
		path: '/skillmap/form/create/skill',
		component: require('page/skillmap/form/create/skill').default,
		title: 'スキル登録',
		indent: 0,
	},
	{
		path: '/skillmap/form/create/skillLargeCategory',
		component: require('page/skillmap/form/create/skillLargeCategory').default,
		title: 'スキル大カテゴリ登録',
		indent: 1,
	},
	{
		path: '/skillmap/form/create/skillSmallCategory',
		component: require('page/skillmap/form/create/skillSmallCategory').default,
		title: 'スキル小カテゴリ登録',
		indent: 1,
	},
	{
		path: '/skillmap/form/create/certification',
		component: require('page/skillmap/form/create/certification').default,
		title: '資格登録',
		indent: 0,
	},
	{
		path: '/skillmap/form/create/certificationCategory',
		component: require('page/skillmap/form/create/certificationCategory').default,
		title: '資格カテゴリ登録',
		indent: 1,
	},
	{
		path: '/skillmap/form/create/member',
		component: require('page/skillmap/form/create/member').default,
		title: '社員登録',
		indent: 0,
	},
	{
		path: '/skillmap/analytics/skillLevel',
		component: require('page/skillmap/analytics/skillLevel').default,
		title: 'スキルレベル分析',
		indent: 0,
	},
]