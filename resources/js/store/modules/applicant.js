export default {
    namespaced: true,
    state: {
        applicants: {},
        errors: [],
        pagination: {
            meta: {
                last_page: 1
            }
        }
    },
    getters: {
        applicants: state => state.applicants,
        errors: state => state.errors,
        pagination: state => state.pagination
    },
    mutations: {
        setApplicants (state, payload) {
            state.applicants = payload
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
        async applyLot({ commit }, payload = {}) {
            try {
                const response = await axios.put(`/applicant/${payload.applicant_id}/apply-lot`, payload)
                commit('setErrors', {})
                return response;
            } catch (error) {
                if (error.response.status == 422){
                    commit('setErrors', error.response.data.errors)
                    return error.response.data.errors
                } else {
                    return Promise.reject(error);
                }
            }
        },
        async saveApplicant ({ dispatch, commit }, payload = {}) {
            try {
                const response = await axios.post(`/applicant`, payload)
                commit('setErrors', {})
                return response;
            } catch (error) {
                if (error.response.status == 422){
                    commit('setErrors', error.response.data.errors)
                    return error.response.data.errors
                } else {
                    return Promise.reject(error);
                }
            }
        },
        async updateApplicant ({ dispatch, commit }, payload = {}) {
            try {
                const response = await axios.put(`/applicant/${payload.id}`, payload)
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
        async getApplicants ({ commit }, payload = {}) {
            await axios.get(`/getApplicants?page=` + payload.params.page, {
                params: payload.params
            })
            .then(response => {
                commit('setApplicants', response.data)
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