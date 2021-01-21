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
        config: {
            locale: '',
            baseURL: '',
        },
        role: '',
    },

    modules: {
        lot,
        agent,
        applicant,
        transaction,
        user
    },

    getters: {
        config: state => state.config,
        supplierLayout: state => state.supplierLayout,
    },

    mutations: {
        setConfig (state, payload) {
            var role = ''
            if(payload.is_admin == true) {
                role = 'admin'
            }
            if(payload.is_mid == true) {
                role = 'mid'
            }
            if(payload.is_view_only == true) {
                role = 'view_only'
            }
            state.role = role
            console.log(payload.user)
        },
        setSupplierLayout (state, payload) {
            state.supplierLayout = payload
        }
    }
})

export default store