const MUTATIONS = {
	SET_ANNUAL  : 'setAnnual',
	SET_TEAM_ID : 'setTeam',
	SET_CC_ID   : 'setCertificationCategory',
}
export default {
	namespaced: true,
	state: {
		filter: {
			annual                  : '',
			teamId                  : '',
			certificationCategoryId : '',
		}
	},
	mutations: {
		[MUTATIONS.SET_ANNUAL] (state, value) {
			state.filter.annual = value;
		},
		[MUTATIONS.SET_TEAM_ID] (state, value) {
			state.filter.teamId = value;
		},
		[MUTATIONS.SET_CC_ID] (state, value) {
			state.filter.certificationCategoryId = value;
		},
	},
	actions: {
		setAnnual({ commit }, value) {
			commit(MUTATIONS.SET_ANNUAL, value)
		},
		setTeamId({ commit }, value) {
			commit(MUTATIONS.SET_TEAM_ID, value)
		},
		setCertificationCategoryId({ commit }, value) {
			commit(MUTATIONS.SET_CC_ID, value)
		},
	},
}