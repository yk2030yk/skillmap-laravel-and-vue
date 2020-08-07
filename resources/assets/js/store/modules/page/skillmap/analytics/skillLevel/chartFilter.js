const MUTATIONS = {
	SET_SKILL_LARGE_CATEGORY_ID: 'setSkillLargeCategoryId',
	SET_KIND                   : 'setKind',
	SET_SORT                   : 'setSort',
}
export default {
	namespaced: true,
	state: {
		filter: {
			skillLargeCategoryId: '',
			kind                : 0, // 0: 1: 2:
			sort                : 0, // 0: 1:
		}
	},
	mutations: {
		[MUTATIONS.SET_SKILL_LARGE_CATEGORY_ID] (state, value) {
			state.filter.skillLargeCategoryId = value;
		},
		[MUTATIONS.SET_KIND] (state, value) {
			state.filter.kind = value;
		},
		[MUTATIONS.SET_SORT] (state, value) {
			state.filter.sort = value;
		},
	},
	actions: {
		setSkillLargeCategoryId({ commit }, value) {
			commit(MUTATIONS.SET_SKILL_LARGE_CATEGORY_ID, value)
		},
		setKind({ commit }, value) {
			commit(MUTATIONS.SET_KIND, value)
		},
		setSort({ commit }, value) {
			commit(MUTATIONS.SET_SORT, value)
		},
	},
}