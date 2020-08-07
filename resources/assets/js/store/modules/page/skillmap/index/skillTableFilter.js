const MUTATIONS = {
	SET_ANNUAL               : 'setAnnual',
	SET_TEAM_ID              : 'setTeam',
	SET_SKILL_LARGE_CATEGORY : 'setSkillLargeCategory',
	SET_SKILL_SMALL_CATEGORY : 'setSkillSmallCategory',
}
export default {
	namespaced: true,
	state: {
		filter: {
			annual               : '',
			teamId               : '',
			skillLargeCategoryId : '',
			skillSmallCategoryId : '',
		}
	},
	mutations: {
		[MUTATIONS.SET_ANNUAL] (state, value) {
			state.filter.annual = value;
		},
		[MUTATIONS.SET_TEAM_ID] (state, value) {
			state.filter.teamId = value;
		},
		[MUTATIONS.SET_SKILL_LARGE_CATEGORY] (state, value) {
			state.filter.skillLargeCategoryId = value;
		},
		[MUTATIONS.SET_SKILL_SMALL_CATEGORY] (state, value) {
			state.filter.skillSmallCategoryId = value;
		},
	},
	actions: {
		setAnnual({ commit }, value) {
			commit(MUTATIONS.SET_ANNUAL, value)
		},
		setTeamId({ commit }, value) {
			commit(MUTATIONS.SET_TEAM_ID, value)
		},
		setSkillLargeCategoryId({ commit }, value) {
			commit(MUTATIONS.SET_SKILL_LARGE_CATEGORY, value)
		},
		setSkillSmallCategoryId({ commit }, value) {
			commit(MUTATIONS.SET_SKILL_SMALL_CATEGORY, value)
		},
	},
}