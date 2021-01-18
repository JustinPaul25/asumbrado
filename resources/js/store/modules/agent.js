export default {
    namespaced: true,
    state: {
        agents: {},
        agentsSelect: {},
        errors: [],
        pagination: {
            meta: {
                last_page: 1
            }
        }
    },
    getters: {
        agents: state => state.agents,
        agentsSelect: state => state.agentsSelect,
        errors: state => state.errors,
        pagination: state => state.pagination
    },
    mutations: {
        setAgents (state, payload) {
            state.agents = payload
        },
        setAgentsSelect (state, payload) {
            state.agentsSelect = payload
        },
        setErrors (state, payload) {
            state.errors = payload
        },
        setPagination (state, payload) {
            if (payload == {}) {
                state.pagination = {
                    meta: {
                        last_page: 1
                    }
                }
            } else {
                state.pagination = payload
            }
        },
    },
    actions: {
        async agentSelect ({commit}) {
            await axios.get(`/getAgentsSelect`)
            .then(response => {
                commit('setAgentsSelect', response.data)
            })
        },
        async saveAgent ({ dispatch, commit }, payload = {}) {
            try {
                const response = await axios.post(`/agent`, payload)
                commit('setErrors', {})
            } catch (error) {
                if (error.response.status == 422){
                    commit('setErrors', error.response.data.errors)
                    return error.response.data.errors
                } else {
                    return Promise.reject(error);
                }
            }
        },
        async updateAgent ({ dispatch, commit }, payload = {}) {
            try {
                const response = await axios.put(`/agent/${payload.id}`, payload)
                commit('setErrors', {})
                return response
            } catch (error) {
                if (error.response.status == 422){
                    commit('setErrors', error.response.data.errors)
                    return error.response.data.errors
                } else {
                    return Promise.reject(error);
                }
            }
        },
        async getAgents ({ commit }, payload = {}) {
            await axios.get(`/getAgents?page=` + payload.params.page, {
                params: payload.params
            })
            .then(response => {
                commit('setAgents', response.data)
                commit('setPagination', response.data)
            })
        },
        async deleteAgent ({ commit }, payload = {}) {
            try {
                const response = await axios.delete(`/${payload.id}/agent`)
                return response
            } catch (error) {
                return Promise.reject(error);
            }
        },
    }
}