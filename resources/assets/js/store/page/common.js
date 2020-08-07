import Vue from 'vue';
import Vuex from 'vuex'
Vue.use(Vuex)

import api from 'store/modules/common/api'

export default new Vuex.Store({
	modules: {
		api: api,
	},
});