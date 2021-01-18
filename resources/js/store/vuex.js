import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import lot from './modules/lot'
import agent from './modules/agent'
import applicant from './modules/applicant'
import transaction from './modules/transaction'
import user from './modules/user'

const store = new Vuex.Store({
    state: {
    },

    modules: {
        lot,
        agent,
        applicant,
        transaction,
        user
    },

    getters: {
    },

    mutations: {
    }
})

export default store