const REGEX_MEMBER_ID = new RegExp('^\\d{6}$');
const REGEX_NUMBER    = new RegExp('^\\d+$');

export default {
	memberId: function(value) {
		let r = `${value}`.match(REGEX_MEMBER_ID);
		return !!r;
	},
	length: function(value, n) {
		return `${value}`.length <= n;
	},
	number: function(value) {
		let r = `${value}`.match(REGEX_NUMBER);
		return !!r;
	},
};
