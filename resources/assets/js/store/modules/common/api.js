import axios from 'axios'

const MUTATIONS = {
	PUSH_ERROR   : 'pushError',
	PUSH_ERRORS  : 'pushErrors',
	RESET_ERROR  : 'resetErrors',
	SET_IS_LODING: 'setIsLoading',
	SET_IS_NETWORK_ERROR: 'setIsNetworkError',
}

export default {
	namespaced: true,
	state: {
		isLoading: false,
		isNetworkError: false,
		errors: [],
	},
	mutations: {
		[MUTATIONS.PUSH_ERROR] (state, value) {
			state.error.push(value);
		},
		[MUTATIONS.PUSH_ERRORS] (state, values) {
			values.forEach(e => { state.errors.push(e) });
		},
		[MUTATIONS.RESET_ERROR] (state) {
			state.errors = []
		},
		[MUTATIONS.SET_IS_LODING] (state, value) {
			state.isLoading = value;
		},
		[MUTATIONS.SET_IS_NETWORK_ERROR] (state, value) {
			state.isNetworkError = value;
		}
	},
	actions: {
		get({ commit }, payload) {
			commit(MUTATIONS.SET_IS_LODING, true);
			commit(MUTATIONS.SET_IS_NETWORK_ERROR, false);
			axios.get(payload.url)
				.then(response => {
					if (payload.success) payload.success(response.data);
				})
				.catch(error => {
					if (payload.error) payload.error(error);
					commit(MUTATIONS.SET_IS_NETWORK_ERROR, true);
				})
				.then(() => {
					if (payload.always) payload.always();
					commit(MUTATIONS.SET_IS_LODING, false);
				});
		},
		post({ commit }, payload) {
			commit(MUTATIONS.SET_IS_LODING, true);
			commit(MUTATIONS.SET_IS_NETWORK_ERROR, false);
			axios.post(payload.url, payload.params)
				.then(response => {
					if (payload.success) payload.success(response.data);
				})
				.catch(error => {
					if (payload.error) payload.error(error);
					commit(MUTATIONS.SET_IS_NETWORK_ERROR, true);
				})
				.then(() => {
					if (payload.always) payload.always();
					commit(MUTATIONS.SET_IS_LODING, false);
				});
		},
		pushError(context, value) {
			context.commit('pushError', value)
		},
		pushError(context, values) {
			context.commit('pushErrors', values)
		},
		resetErrors(state) {
			context.commit('resetErrors', values)
		},
		setIsLoading(state, value) {
			context.commit(MUTATIONS.SET_IS_LODING, value)
		},
		setIsNetworkError(state, value) {
			context.commit(MUTATIONS.SET_IS_NETWORK_ERROR, value)
		}
	}
}