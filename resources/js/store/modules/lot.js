export default {
    namespaced: true,
    state: {
        lots: {},
        errors: [],
        pagination: {
            meta: {
                last_page: 1
            }
        }
    },
    getters: {
        lots: state => state.lots,
        errors: state => state.errors,
        pagination: state => state.pagination
    },
    mutations: {
        setLots (state, payload) {
            state.lots = payload
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
        async saveLot ({ dispatch, commit }, payload = {}) {
            try {
                const response = await axios.post(`/lot`, payload)
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
        async updateLot ({ dispatch, commit }, payload = {}) {
            try {
                const response = await axios.put(`/lot/${payload.id}`, payload)
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
        async getLots ({ commit }, payload = {}) {
            await axios.get(`/getLots?page=` + payload.params.page, {
                params: payload.params
            })
            .then(response => {
                commit('setLots', response.data)
                commit('setPagination', response.data)
            })
        },
        async deleteLot ({ commit }, payload = {}) {
            try {
                const response = await axios.delete(`/${payload.id}/lot`)
                return response
            } catch (error) {
                return Promise.reject(error);
            }
        },
    }
}