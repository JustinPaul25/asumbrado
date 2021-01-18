<template>
    <div class="text-gray-800 bg-gray-500 vld-parent">
        <loading :active.sync="isLoading" 
            :can-cancel="false" 
            :is-full-page="fullPage">
        </loading>
        <div class="p-4 flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-bold fali-color">
                    Fill-Up Form
                </h1>
            </div>
        </div>
        <div class="px-4">
            <form @submit.prevent="submit">
                <label class='block uppercase tracking-wide text-gray-800 text-lg font-bold mb-2 mt-2 underline'>Personal Information</label>
                <div class="w-full flex pb-2">
                    <div class="w-2/4">
                        <label class='block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2' >Full Name:</label>
                        <input required v-model="form.name" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none focus:border-yellow-500 h-8' type='text'>
                    </div>
                    <div class="w-1/4 px-2">
                        <label class='block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2' >Birth Date:</label>
                        <input required v-model="birth_date" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='date'>
                    </div>
                    <div class="w-1/4">
                        <label class='block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2' >Age:</label>
                        <input required v-model="form.age" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='number'>
                    </div>
                </div>
                <div class="w-full flex pb-2">
                    <div class="w-3/4">
                        <label class='block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2' >Address:</label>
                        <input required v-model="form.address" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                    </div>
                    <div class="w-1/4 pl-2">
                        <label class='block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2' >Place of Birth:</label>
                        <input required v-model="form.birth_place" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                    </div>
                </div>
                <div class="w-full flex pb-2">
                    <div class="w-1/4">
                        <label class='block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2' >Email Address:</label>
                        <input v-model="form.email" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                    </div>
                    <div class="w-1/4 px-2">
                        <label class='block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2' >Mobile No.:</label>
                        <input required v-model="form.mobile_number" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                    </div>
                    <div class="w-1/4 pr-2">
                        <label class='block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2' >Occupation:</label>
                        <input required v-model="form.occupation" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                    </div>
                    <div class="w-1/4">
                        <label class='block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2' >Employer's Name:</label>
                        <input v-model="form.employers_name" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                    </div>
                </div>
                <div class="w-full flex pb-2">
                    <div class="w-2/4">
                        <label class='block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2' >Civil Status:</label>
                        <select required v-model="form.civil_status" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-1 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8'>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="widow">Widow</option>
                            <option value="legaly separated">Legaly Separated</option>
                        </select>
                    </div>
                    <div v-show="form.civil_status == 'married'" class="w-2/4 pl-2">
                        <label class='block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2' >Spouse:</label>
                        <input v-model="form.spouse" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                    </div>
                </div>
                <label class='underline block uppercase tracking-wide text-gray-800 text-lg font-bold mb-2 mt-2' >Two Personal Reference</label>
                <div class="w-full flex">
                    <div class="w-1/2">
                        <div class="w-full pr-2 mb-2">
                            <label class='block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2' >Name:</label>
                            <input v-model="form.reference_one_name" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                        </div>
                        <div class="w-full pr-2 mb-2">
                            <label class='block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2'>Address:</label>
                            <input v-model="form.reference_one_address" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                        </div>
                        <div class="w-full pr-2 mb-2">
                            <label class='block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2'>Mobile no.:</label>
                            <input v-model="form.reference_one_mobile_no" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                        </div>
                        <div class="w-full pr-2 mb-2">
                            <label class='block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2'>Relationship:</label>
                            <input v-model="form.reference_one_relationship" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                        </div>
                    </div>
                    <div class="w-1/2">
                        <div class="w-full pr-2 mb-2">
                            <label class='block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2' >Name:</label>
                            <input v-model="form.reference_two_name" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                        </div>
                        <div class="w-full pr-2 mb-2">
                            <label class='block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2'>Address:</label>
                            <input v-model="form.reference_two_address" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                        </div>
                        <div class="w-full pr-2 mb-2">
                            <label class='block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2'>Mobile no.:</label>
                            <input v-model="form.reference_two_mobile_no" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                        </div>
                        <div class="w-full pr-2 mb-2">
                            <label class='block uppercase tracking-wide text-gray-800 text-xs font-bold mb-2'>Relationship:</label>
                            <input v-model="form.reference_two_relationship" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-700 p-4 rounded">
                    <label class='underline block uppercase tracking-wide text-gray-200 text-lg font-bold mb-2 mt-2' >Lot Purchased</label>
                    <div class="w-full flex mb-2">
                        <div class="w-full flex">
                            <div class="w-1/4">
                                <label class='block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2'>Purchase at:</label>
                                <input required v-model="form.lot_name" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                            </div>
                            <div class="w-1/4 px-2">
                                <label class='block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2'>Block:</label>
                                <input required v-model="form.block_no" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                            </div>
                            <div class="w-1/4">
                                <label class='block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2'>Lot:</label>
                                <input required v-model="form.lot_no" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                            </div>
                            <div class="w-1/4 pl-2">
                                <label class='block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2'>Area(sqm):</label>
                                <input required v-model="form.area" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                            </div>
                        </div>
                    </div>
                    <div class="w-full flex mb-2">
                        <div class="w-1/3 pr-1">
                            <label class='block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2'>Total Price:</label>
                            <input required v-model="form.total_price" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='number'>
                        </div>
                        <div class="w-1/3 px-1">
                            <label class='block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2'>Required Reservation Fee:</label>
                            <input v-model="reservation" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                        </div>
                        <div class="w-1/3 px-1">
                            <label class='block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2'>Required Downpayment:</label>
                            <input v-model="downpayment" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='number'>
                        </div>
                        <!-- <div v-show="parseInt(form.total_price) > parseInt(downpayment)" class="w-1/4 px-2">
                            <label class='block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2'>Months of Payment:</label>
                            <select required v-model="months" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8'>
                                <option value="3">3 Months</option>
                                <option value="6">6 Months</option>
                                <option value="9">9 Months</option>
                                <option value="12">12 Months</option>
                            </select>
                        </div> -->
                    </div>
                    <!-- <label class='underline block uppercase tracking-wide text-gray-200 text-lg font-bold mb-2 mt-8' >Payment</label>
                    <div class="w-full flex">
                        <div class="w-1/4 pr-1">
                            <label class='block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2'>Initial Payment:</label>
                            <input v-model="initial_payment" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='number'>
                        </div>
                        <div class="w-1/4 px-1">
                            <label class='block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2'>Or No.:</label>
                            <input required v-model="form.or_no" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                        </div>
                        <div v-show="parseInt(form.total_price) > parseInt(downpayment)" class="w-1/4 px-1">
                            <label class='block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2'>Monthly Payment:</label>
                            <input required v-model="form.monthly_payment" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                        </div>
                        <div class="w-1/4 pl-1">
                            <label class='block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2'>Remaining Balance:</label>
                            <input required v-model="form.monthly_payment" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                        </div>
                    </div> -->
                    <label class='underline block uppercase tracking-wide text-gray-200 text-lg font-bold mb-2 mt-8' >Agent</label>
                    <div class="w-full flex">
                        <div class="w-3/4">
                            <label class='block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2'>Agent Full Name:</label>
                            <input v-model="form.agent_name" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'>
                        </div>
                        <div class="w-1/4 ml-2">
                            <label class='block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2'>Rate(%):</label>
                            <input v-model="form.agent_rate" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='number'>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mr-3 mb-4">
                    <div class="w-full my-4">
                        <button v-if="!isLoading" type="submit" value="Submit" class="w-full focus:outline-none bg-gray-900 hover:bg-gray-700 text-white font-bold py-4 px-6 rounded flex justify-center items-center">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mr-2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                            <span class="text-lg">Save Purchase</span>
                        </button>
                        <button v-else disabled class="w-full focus:outline-none bg-gray-900 hover:bg-gray-700 text-white font-bold py-4 px-6 rounded items-center flex justify-center">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mr-2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                            <span class="text-lg">Saving....</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <modal name="payment-modal" draggable=".window-header" :height="'600px'" :width="'40%'" :clickToClose="false">
            <div class="window-header bg-gray-900 flex py-2 px-2">
                <p class="font-bold text-yellow-500">Costumer Payment</p>
                <button class="ml-auto text-white focus:outline-none" @click="closePayModal">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="9" x2="15" y2="15"></line><line x1="15" y1="9" x2="9" y2="15"></line></svg>
                </button>
            </div>
            <div>
                <div class="container">
                    <div class="flex items-center justify-between mt-4">
                        <div class='w-full px-3 mb-4'>
                            <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Amount</label>
                            <input v-model="initial_payment" class='appearance-none block w-full bg-white text-gray-700 border-orange-400 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-orange-500' type='text'  required>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <div class='w-full px-3 mb-4'>
                            <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >OR number</label>
                            <input v-model="form.or_no" class='appearance-none block w-full bg-white text-gray-700 border-orange-400 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-orange-500' type='text'  required>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <div class='w-full px-3 mb-4'>
                            <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Remaining Balance</label>
                            <input :value="form.total_price - form.initial_payment" class='appearance-none block w-full bg-white text-gray-700 border-orange-400 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-orange-500' type='text'  required>
                        </div>
                    </div>
                    <div v-show="initial_payment < form.total_price" class="flex items-center justify-between mt-4">
                        <div class='w-full px-3 mb-4'>
                            <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Months of Payment</label>
                            <select required v-model="months" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8'>
                                <option value="3">3 Months</option>
                                <option value="6">6 Months</option>
                                <option value="9">9 Months</option>
                                <option value="12">12 Months</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <div class='w-full px-3 mb-4'>
                            <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Monthly Payment</label>
                            <input v-model="form.monthly_payment" class='appearance-none block w-full bg-white text-gray-700 border-orange-400 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-orange-500' type='text'  required>
                        </div>
                    </div>
                    <div class="flex justify-end mb-4">
                        <button v-if="!isLoading" @click="saveForm" class="focus:outline-none bg-yellow-500 ml-auto fali-bg hover:bg-yellow-300 text-gray-900 font-bold py-2 px-4 rounded inline-flex items-center mr-4">
                            <span>Save Payment</span>
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
            birth_date: '',
            form: {
                id:'',
                isNewAgent: false,
                agent:'',
                age:'',
                isNewLot: false,
                date_applied:'',
                name:'',
                address:'',
                birth_place:'',
                birth_date:'',
                email:'',
                mobile_number:'',
                occupation:'',
                employers_name:'',
                civil_status:'',
                spouse:'',
                reference_one_name:'',
                reference_one_address:'',
                reference_one_mobile_no:'',
                reference_one_relationship:'',
                reference_two_name:'',
                reference_two_address:'',
                reference_two_mobile_no:'',
                reference_two_relationship:'',
                lot_name:'',
                block_no:'',
                lot_no:'',
                area:'',
                total_price: 0,
                reservation_fee:'',
                downpayment:'',
                or_no:'',
                months:'',
                monthly_payment:'',
                agent_name: '',
                agent_rate: '',
                initial_payment: 0
            },
            downpayment:0,
            months:'',
            reservation:0,
            remaining_balance: 0,
            initial_payment: 0
        }),
        watch: {
            birth_date: _.debounce(function(newVal){
                this.form.birth_date = newVal
                this.getAge(newVal);
            }, 200),
            downpayment: _.debounce(function(newVal){
                this.calculateMonthly()
            }, 200),
            reservation: _.debounce(function(newVal){
                this.calculateMonthly()
            }, 200),
            months: _.debounce(function(newVal){
                this.calculateMonthly()
            }, 200),
            initial_payment: _.debounce(function(newVal){
                this.form.initial_payment = newVal
                this.remaining_balance = this.form.total_price - newVal
            }, 200)
        },
        methods: {
            clearForm() {
                this.form = {
                    id:'',
                    isNewAgent: false,
                    agent:'',
                    age:'',
                    isNewLot: false,
                    date_applied:'',
                    name:'',
                    address:'',
                    birth_place:'',
                    birth_date:'',
                    email:'',
                    mobile_number:'',
                    occupation:'',
                    employers_name:'',
                    civil_status:'',
                    spouse:'',
                    reference_one_name:'',
                    reference_one_address:'',
                    reference_one_mobile_no:'',
                    reference_one_relationship:'',
                    reference_two_name:'',
                    reference_two_address:'',
                    reference_two_mobile_no:'',
                    reference_two_relationship:'',
                    lot_name:'',
                    block_no:'',
                    lot_no:'',
                    area:'',
                    total_price:'',
                    reservation_fee:0,
                    downpayment:0,
                    months:'',
                    monthly_payment:'',
                    or_no:''
                }
            },
            getAge(birthday) {
                var parts = birthday.match(/(\d+)/g);
                var newBirthday = new Date(parts[0], parts[1]-1, parts[2]);
                var ageDifMs = Date.now() - newBirthday.getTime();
                var ageDate = new Date(ageDifMs); // miliseconds from epoch
                this.form.age = Math.abs(ageDate.getUTCFullYear() - 1970);
            },
            async saveForm() {
                this.isLoading = true
                await this.$store.dispatch('applicant/saveApplicant', this.form)
                this.isLoading = false
                window.location.href = 'lot';
                this.clearForm()
            },
            payLot() {
                this.$modal.show('payment-modal')
            },
            closePayModal() {
                this.$modal.hide('payment-modal')
                this.form.initial_payment = 0
                this.form.or_no = ''
                this.form.months = 0
            },
            async submit() {
                this.payLot()
            },
            calculateMonthly() {
                this.form.months = this.months
                this.form.downpayment = this.downpayment
                this.form.reservation_fee = this.reservation
                console.log(this.downpayment + this.reservation)
                if(this.months != '' && this.downpayment != 0) {
                    var price = this.form.total_price - (parseInt(this.downpayment) + parseInt(this.reservation))
                    this.form.monthly_payment = Math.round(price/this.months)
                }
            },
        },
    }
</script>

