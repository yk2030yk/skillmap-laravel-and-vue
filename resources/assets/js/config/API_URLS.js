let names = [
	'skillLargeCategory',
	'skillSmallCategory',
	'skill',
	'certificationCategory',
	'certification',
	'member',
	'team',
];
let actions = ['search', 'create', 'update', 'delete'];

let urls = {};
names.forEach(function (name) {
	urls[name] = {};
	actions.forEach(function(act) {
		urls[name][act] = `/api/${name}/${act}`;
	});
});

export default urls;