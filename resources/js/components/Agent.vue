<template>
    <div class="text-yellow-500 bg-gray-800 vld-parent">
        <loading :active.sync="isLoading" 
            :can-cancel="false" 
            :is-full-page="fullPage">
        </loading>
        <div class="p-4 flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-bold fali-color">
                    Agents
                </h1>
            </div>
            <div class="flex items-center">
                <div class="relative text-gray-600 mr-4">
                    <input v-model="search" class="border border-yellow-500 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                    type="search" name="search" placeholder="Name">
                    <button type="submit" class="absolute right-0 top-0 mt-5 mr-4">
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                            viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                            width="512px" height="512px">
                            <path
                            d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                        </svg>
                    </div>
                    </button>
                </div>
                <button @click="addAgentModal" class="focus:outline-none ml-auto bg-yellow-500 hover:bg-yellow-300 text-gray-900 font-bold py-2 px-4 rounded inline-flex items-center">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mr-2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                    <span>Add Agent</span>
                </button>
            </div>
        </div>
        <div class="px-3 py-4 flex justify-center">
            <table class="w-full text-md bg-white shadow-md rounded mb-4">
                <tbody>
                    <tr class="border-b text-gray-900">
                        <th class="text-left fali-color p-3 px-5">Agent</th>
                        <th class="text-left fali-color p-3 px-5">Lot(Total Price)</th>
                        <th class="text-left fali-color p-3 px-5">Rate(%)</th>
                        <th class="text-left fali-color p-3 px-5">Commission</th>
                        <th class="text-left fali-color p-3 px-5">Date Purchased(M-D-Y)</th>
                        <th></th>
                    </tr>
                    <tr v-for="agent in agents.data" class="border-b hover:bg-yellow-200 bg-gray-100">
                        <td class="p-3 px-5 text-gray-900 font-semibold">
                            <b>{{ agent.name }}</b>
                        </td>
                        <td class="p-3 px-5 text-gray-900 font-semibold">
                            <b>{{ agent.lot.name+' ('+agent.lot.status+')' }}</b>
                            <p>P {{ agent.lot.total_price }}</p>
                        </td>
                        <td class="p-3 px-5 text-gray-900 font-semibold">
                            <b>{{ agent.rate }} %</b>
                        </td>
                        <td class="p-3 px-5 text-gray-900 font-semibold">
                            <b>P {{ (parseInt(agent.rate) / 100) * parseInt(agent.lot.total_price) }}</b>
                        </td>
                        <td class="p-3 px-5 text-gray-900 font-semibold">
                            <b>{{ agent.date }}</b>
                        </td>
                        <td class="p-3 px-5 flex justify-end">
                            <button @click="editAgentModal(agent)" type="button" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline flex">
                                <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mb-1 mr-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                Edit
                            </button>
                            <button @click="confirmDelete(agent.id)" type="button" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline flex">
                                <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mb-1 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex px-3">
           <paginate
                :page-count="pagination.meta.last_page"
                :click-handler="getAgents"
                :prev-text="`<i class='fas fa-angle-left'></i><b class='focus:outline-none'> Prev</b>`"
                :next-text="`<b class='focus:outline-none'>Next </b><i class='fas fa-angle-right'></i>`"
                :container-class="'pagination'"
                class="flex justify-end focus:outline-none ml-auto"
                prev-class="focus:outline-none text-sm mr-2 fali-bg hover:bg-yellow-500 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline" 
                next-class="focus:outline-none text-sm ml-2 fali-bg hover:bg-yellow-500 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"  
                page-link-class="focus:outline-none text-sm mt-10 mx-2 hover:bg-yellow-500 text-bg-gray-800 py-1 px-2 rounded focus:outline-none focus:shadow-outline" 
                active-class="focus:outline-none text-sm fali-bg hover:bg-yellow-500 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"
                >
            </paginate>
        </div>
        <modal name="form" draggable=".window-header" :height="'auto'" :width="'40%'" :clickToClose="false">
            <div class="window-header bg-gray-900 flex py-2 px-2">
                <p class="font-bold text-yellow-500">Input Agent Name</p>
                <button class="ml-auto text-white focus:outline-none" @click="closeModal">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="9" x2="15" y2="15"></line><line x1="15" y1="9" x2="9" y2="15"></line></svg>
                </button>
            </div>
            <div>
                <div class="personal w-full border-t border-gray-400 pt-4 my-auto">
                    <div class="flex items-center justify-between mt-4">
                        <div class='w-full px-3 mb-4'>
                            <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Full Name</label>
                            <input v-model="form.name" class='appearance-none block w-full bg-white text-gray-700 border-orange-400 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-orange-500' type='text'  required>
                        </div>
                    </div>
                    <div class="flex justify-end mb-4">
                        <button v-if="!isLoading" @click="saveAgent" class="focus:outline-none bg-yellow-500 ml-auto fali-bg hover:bg-yellow-300 text-gray-900 font-bold py-2 px-4 rounded inline-flex items-center mr-4">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mr-2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                            <span>{{isEdit ? 'Update' : 'Save'}} Agent</span>
                        </button>
                        <button v-else disabled class="focus:outline-none ml-auto fali-bg hover:bg-orange-400 text-white font-bold py-2 px-4 rounded inline-flex items-center mr-4">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mr-2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                            <span>Saving....</span>
                        </button>
                    </div>
                </div>
            </div>
        </modal>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        data: () => ({
            isLoading: false,
            fullPage: true,
            form: {
                id:'0',
                name: '',
            },
            search: '',
            sortBy: '',
            isEdit: false,
        }),
        watch: {
            search: _.debounce(function(newVal){
                this.getAgents(1)
            }, 200)
        },
        computed: {
            ...mapGetters({
                errors: 'agent/errors',
                agents: 'agent/agents',
                pagination: 'agent/pagination'
            }),
        },
        methods: {
            clearForm() {
                this.id = '0'
                this.form.name = ''
            },
            addAgentModal() {
                this.isEdit = false
                this.clearForm()
                this.openModal()
            },
            editAgentModal(agent) {
                this.isEdit = true;
                this.form.id = agent.id
                this.form.name = agent.name
                this.openModal();
            },
            openModal() {
                this.$modal.show('form')
            },
            closeModal() {
                this.$modal.hide('form')
            },
            async getAgents(page = 1) {
                await this.$store.dispatch('agent/getAgents', {
                    params: {
                        page: page,
                        search: this.search
                    }
                })
            },
            async saveAgent () {
                this.isLoading = true
                if(this.isEdit) {
                    await this.$store.dispatch('agent/updateAgent', this.form)
                    if(Object.keys(this.errors).length == 0) {
                        this.getAgents();
                        this.closeModal();
                    }
                } else {
                    await this.$store.dispatch('agent/saveAgent', this.form)
                    if(Object.keys(this.errors).length == 0) {
                        this.getAgents();
                        this.closeModal();
                    }
                }
                this.isLoading = false
            },
            async deleteAgent (id) {
                this.isLoading = true
                await this.$store.dispatch('agent/deleteAgent', { id: id })
                this.getAgents()
                this.isLoading = false
            },
            confirmDelete (id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Agent will be deleted",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.deleteAgent(id)
                    }
                }) 
            },
        },

        created() {
            this.getAgents();
        }
    }
</script>

