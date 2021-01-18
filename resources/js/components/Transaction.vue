<template>
    <div class="text-yellow-500 bg-gray-800 vld-parent">
        <loading :active.sync="isLoading" 
            :can-cancel="false" 
            :is-full-page="fullPage">
        </loading>
        <div class="p-4 justify-between items-center">
            <div>
                <h1 class="text-4xl font-bold fali-color">
                    P {{ amount }}
                </h1>
            </div>
            <div>
                <h1 class="fali-color pt-2">
                    TOTAL AMOUNT PAID FOR ALL BUYER
                </h1>
            </div>
        </div>
        <div class="p-4 flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-bold fali-color">
                    Transactions
                </h1>
            </div>
            <div class="flex items-center">
                <div class="relative text-gray-600 mr-4">
                    <label class='block uppercase tracking-wide text-gray-300 text-xs font-bold mb-2' >Area:</label>
                    <input v-model="area" class="border border-yellow-500 bg-white h-10 px-5 rounded-lg text-sm focus:outline-none"
                    type="date" name="search" placeholder="Area">
                </div>
                <div v-show="type == 'specific'" class="relative text-gray-600 mr-4 mt-5">
                    <input v-model="search_date" class="border border-yellow-500 bg-white h-10 px-5 rounded-lg text-sm focus:outline-none"
                    type="date" name="search" placeholder="Area">
                </div>
                <div v-show="type == 'between'" class="relative text-gray-600 mr-4">
                    <label class='block uppercase tracking-wide text-gray-300 text-xs font-bold mb-2' >From:</label>
                    <input v-model="from_date" class="border border-yellow-500 bg-white h-10 px-5 rounded-lg text-sm focus:outline-none"
                    type="date" name="search" placeholder="Area">
                </div>
                <div v-show="type == 'between'" class="relative text-gray-600 mr-4">
                    <label class='block uppercase tracking-wide text-gray-300 text-xs font-bold mb-2' >To:</label>
                    <input v-model="to_date" class="border border-yellow-500 bg-white h-10 px-5 rounded-lg text-sm focus:outline-none"
                    type="date" name="search" placeholder="Area">
                </div>
                <div>
                    <select required v-model="type" class='text-gray-900 border mt-5 border-yellow-500 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none'>
                        <option selected value="specific">Specific Date</option>
                        <option value="between">Between Dates</option>
                    </select>
                </div>
                <div class="mt-5">
                    <button @click="print()" class="focus:outline-none bg-yellow-500 fali-bg hover:bg-yellow-300 text-gray-900 font-bold py-3 px-5 rounded inline-flex items-center ml-4">
                        <span>Print</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="px-3 py-4 flex justify-center">
            <table class="w-full text-md bg-white shadow-md rounded mb-4">
                <tbody>
                    <tr class="border-b text-gray-900">
                        <th class="text-left fali-color p-3 px-5">Buyer</th>
                        <th class="text-left fali-color p-3 px-5">Lot</th>
                        <th class="text-left fali-color p-3 px-5">OR No.</th>
                        <th class="text-left fali-color p-3 px-5">Amount</th>
                        <th class="text-left fali-color p-3 px-5">balance</th>
                        <th class="text-left fali-color p-3 px-5">Total Recievable</th>
                        <th class="text-left fali-color p-3 px-5">Date and Time</th>
                    </tr>
                    <tr v-for="transaction in transactions.data" class="border-b hover:bg-orange-100 bg-gray-100 hover:bg-orange-200">
                        <td class="p-3 px-5">
                            <p class="font-bold text-gray-900">{{ transaction.applicant.name }}</p>
                        </td>
                        <td class="p-3 px-5">
                            <p class="text-gray-900">{{ `${transaction.lot.name} Block:${transaction.lot.block_no} Lot:${transaction.lot.lot_no}`}}</p>
                        </td>
                        <td class="p-3 px-5">
                            <p class="font-bold text-gray-900">{{ transaction.or_no }}</p>
                        </td>
                        <td class="p-3 px-5">
                            <p class="font-bold text-gray-900">P {{ transaction.amount }}</p>
                        </td>
                        <td class="p-3 px-5">
                            <p class="font-bold text-gray-900">P {{ transaction.balance }}</p>
                        </td>
                        <td class="p-3 px-5">
                            <p class="font-bold text-gray-900">P {{ transaction.recievable }}</p>
                        </td>
                        <td class="p-3 px-5">
                            <p class="text-gray-900">{{ transaction.created_at }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex px-3">
           <paginate
                :page-count="pagination.meta.last_page"
                :click-handler="getTransactions"
                :prev-text="`<i class='fas fa-angle-left'></i><b class='focus:outline-none'> Prev</b>`"
                :next-text="`<b class='focus:outline-none'>Next </b><i class='fas fa-angle-right'></i>`"
                :container-class="'pagination'"
                class="flex justify-end focus:outline-none ml-auto"
                prev-class="focus:outline-none text-sm mr-2 fali-bg hover:bg-yellow-500 text-white py-1 px-2 rounded focus:shadow-outline" 
                next-class="focus:outline-none text-sm ml-2 fali-bg hover:bg-yellow-500 text-white py-1 px-2 rounded focus:shadow-outline"  
                page-link-class="focus:outline-none text-sm mt-10 mx-2 hover:bg-yellow-500 text-bg-gray-800 py-1 px-2 rounded focus:shadow-outline" 
                active-class="focus:outline-none text-sm fali-bg hover:bg-yellow-500 text-white py-1 px-2 rounded focus:shadow-outline"
                >
            </paginate>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        data: () => ({
            isLoading: false,
            fullPage: true,
            search_date: '',
            from_date: '',
            to_date: '',
            isEdit: false,
            amount: '',
            type:'specific',
            area:'',
        }),
        watch: {
            search_date: _.debounce(function(newVal){
                this.getTransactions(1)
            }, 400),
            from_date: _.debounce(function(newVal){
                this.getTransactions(1)
            }, 400),
            to_date: _.debounce(function(newVal){
                this.getTransactions(1)
            }, 400),
        },
        computed: {
            ...mapGetters({
                transactions: 'transaction/transactions',
                pagination: 'transaction/pagination'
            }),
        },
        methods: {
            print() {
                var from = this.type == 'specific' ? this.search_date : this.from_date;
                var to = this.to_date;
                window.open(`transaction-print/${this.type}/${from}/${to}`);
            },
            async getTransactions(page = 1) {
                if(this.type == 'between') {
                    if(this.from_date == '' || this.to_date == '') {
                        return
                    }
                }
                this.isLoading = true
                await this.$store.dispatch('transaction/getTransactions', {
                    params: {
                        page: page,
                        date: this.search_date,
                        from: this.from_date,
                        to: this.to_date,
                        type: this.type
                    }
                })
                this.isLoading = false
            },
            async getIncome(page = 1) {
                await axios.get('/get-income')
                .then( response => {
                    this.amount = response.data
                });
            },
        },

        created() {
            this.getTransactions()
            this.getIncome()
        }
    }
</script>

