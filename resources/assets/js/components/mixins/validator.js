const REGEX_MEMBER_ID = new RegExp('^\\d{6}$');
const REGEX_NUMBER    = new RegExp('^\\d+$');

export default {
	data() {
		return {
			validationErrors: [],
		}
	},
	methods: {
		/*==================================
		 * ruleの定義
		 * ルール名:オプション
		 * {ruleName}:{key=value},{key=value}
		 ===================================*/
		validate(rules, value) {
			let result = false;
			rules.forEach(v => {
				const rule = v.split(':');
				const func = 'validate_' + rule[0];

				if (!this[func]) return;

				let options = {};
				if (rule[1]) {
					rule[1].split(',').forEach(v => {
						let opt = v.split('=');
						options[opt[0]] = opt[1];
					});
				}
				result = result || this[func](value, options);
			});
			return result;
		},

		resetValidationErrors() {
			this.validationErrors = [];
		},

		/*==================================
		 * ruleメソッド
		 * validate_{ruleName}で定義
		 * 引数 opt: opt.keyでvalueを取得
		 ===================================*/
		validate_memberId(value) {
			let r = `${value}`.match(REGEX_MEMBER_ID);
			return !!r;
		},
		validate_maxLength(value, opt) {
			console.log([opt,  `${value}`.length,opt.n,  parseInt(opt.n) ]);
			return `${value}`.length <= Number(opt.n);
		},
		validate_number(value) {
			let r = `${value}`.match(REGEX_NUMBER);
			return !!r;
		},
	},
	computed: {
		isValidationError() {
			return this.validationErrors.size() > 0;
		}
	},

};
