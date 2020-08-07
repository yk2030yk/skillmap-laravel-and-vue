const MUTATIONS = {
	SET_SKILL         : 'setSkill',
	SET_CERTIFICATION : 'setCertification',
}
export default {
	namespaced: true,
	state: {
		isShowTable: {
			skill        : true,
			certification: false,
		},
	},
	mutations: {
		[MUTATIONS.SET_SKILL] (state, value) {
			state.isShowTable.skill = value;
		},
		[MUTATIONS.SET_CERTIFICATION] (state, value) {
			state.isShowTable.certification = value;
		},
	},
	actions: {
		setSkill({ commit }, value) {
			commit(MUTATIONS.SET_SKILL, value)
		},
		setCertification({ commit }, value) {
			commit(MUTATIONS.SET_CERTIFICATION, value)
		},
	},
}