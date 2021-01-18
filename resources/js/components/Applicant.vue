<template>
    <div class="text-yellow-500 bg-gray-800 vld-parent">
        <loading :active.sync="isLoading" 
            :can-cancel="false" 
            :is-full-page="fullPage">
        </loading>
        <div class="p-4 flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-bold fali-color">
                    Buyers
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
            </div>
        </div>
        <div class="px-3 py-4 flex justify-center">
            <table class="w-full text-md bg-white shadow-md rounded mb-4">
                <tbody>
                    <tr class="border-b text-gray-900">
                        <th class="text-left fali-color p-3 px-5">Buyer</th>
                        <th class="text-left fali-color p-3 px-5">Lot</th>
                        <th class="text-left fali-color p-3 px-5">Agent</th>
                        <th class="text-left fali-color p-3 px-5">Balance</th>
                        <th></th>
                    </tr>
                    <tr v-for="applicant in applicants.data" class="border-b hover:bg-yellow-200 bg-gray-100">
                        <td class="p-3 px-5 text-gray-900 font-semibold">
                            <p>{{ applicant.name }}</p>
                        </td>
                        <td class="p-3 px-5 text-gray-900">
                            <div>
                                <p class="font-bold text-gray-900">{{ applicant.lot.name }}</p>
                                <p class="text-xs">{{ `Block: ${applicant.lot.block_no} - Lot: ${applicant.lot.lot_no}` }}</p>
                            </div>
                        </td>
                        <td class="p-3 px-5 text-gray-900 font-semibold">
                            <p>{{ applicant.agent != null ? applicant.agent.name : '' }}</p>
                        </td>
                        <td class="p-3 px-5 text-gray-900 font-semibold">
                            <p>P {{ applicant.lot.balance }}</p>
                        </td>
                        <td class="p-3 px-5 flex justify-end">
                            <button @click="payLot(applicant.lot)" type="button" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline flex">
                                Add Transaction
                            </button>
                            <button @click="transactionModal(applicant)" type="button" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline flex">
                                Transactions
                            </button>
                            <button @click="editAgentModal(applicant)" type="button" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline flex">
                                <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mb-1 mr-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                Edit
                            </button>
                            <button @click="confirmDelete(applicant.id)" type="button" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline flex">
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
                :click-handler="getApplicants"
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
        <modal name="applicant-form" draggable=".window-header" :height="'auto'" :width="'80%'" :clickToClose="false">
            <div class="window-header bg-gray-900 flex py-2 px-2">
                <p class="font-bold text-lg text-yellow-500">Applicant Form</p>
                <button class="ml-auto text-white focus:outline-none" @click="closeModal">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="9" x2="15" y2="15"></line><line x1="15" y1="9" x2="9" y2="15"></line></svg>
                </button>
            </div>
            <div class="bg-gray-700">
                <div class="personal w-full border-t border-gray-400 pt-4 my-auto px-2">
                    <label class='block uppercase tracking-wide text-yellow-500 text-lg font-bold mb-2 mt-2' >Personal Information</label>
                    <div class="w-full flex pb-2">
                        <div class="w-2/4">
                            <label class='block uppercase tracking-wide text-yellow-500 text-xs font-bold mb-2' >Full Name:</label>
                            <input v-model="form.name" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none focus:border-yellow-500 h-4' type='text'  required>
                        </div>
                        <div class="w-1/4 px-2">
                            <label class='block uppercase tracking-wide text-yellow-500 text-xs font-bold mb-2' >Birth Date:</label>
                            <input v-model="birth_date" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-4' type='date'  required>
                        </div>
                        <div class="w-1/4">
                            <label class='block uppercase tracking-wide text-yellow-500 text-xs font-bold mb-2' >Age:</label>
                            <input v-model="form.age" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-4' type='number'  required>
                        </div>
                    </div>
                    <div class="w-full flex pb-2">
                        <div class="w-3/4">
                            <label class='block uppercase tracking-wide text-yellow-500 text-xs font-bold mb-2' >Address:</label>
                            <input v-model="form.address" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-4' type='text'  required>
                        </div>
                        <div class="w-1/4 pl-2">
                            <label class='block uppercase tracking-wide text-yellow-500 text-xs font-bold mb-2' >Place of Birth:</label>
                            <input v-model="form.birth_place" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-4' type='text'  required>
                        </div>
                    </div>
                    <div class="w-full flex pb-2">
                        <div class="w-1/4">
                            <label class='block uppercase tracking-wide text-yellow-500 text-xs font-bold mb-2' >Email Address:</label>
                            <input v-model="form.email" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-4' type='text'  required>
                        </div>
                        <div class="w-1/4 px-2">
                            <label class='block uppercase tracking-wide text-yellow-500 text-xs font-bold mb-2' >Mobile No.:</label>
                            <input v-model="form.mobile_number" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-4' type='text'  required>
                        </div>
                        <div class="w-1/4 pr-2">
                            <label class='block uppercase tracking-wide text-yellow-500 text-xs font-bold mb-2' >Occupation:</label>
                            <input v-model="form.occupation" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-4' type='text'  required>
                        </div>
                        <div class="w-1/4">
                            <label class='block uppercase tracking-wide text-yellow-500 text-xs font-bold mb-2' >Employer's Name:</label>
                            <input v-model="form.employers_name" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-4' type='text'  required>
                        </div>
                    </div>
                    <div class="w-full flex pb-2">
                        <div class="w-2/4">
                            <label class='block uppercase tracking-wide text-yellow-500 text-xs font-bold mb-2' >Civil Status:</label>
                            <select v-model="form.civil_status" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-1 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8'  required>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="widow">Widow</option>
                                <option value="legaly separated">Legaly Separated</option>
                            </select>
                        </div>
                        <div v-show="form.civil_status == 'married'" class="w-2/4 pl-2">
                            <label class='block uppercase tracking-wide text-yellow-500 text-xs font-bold mb-2' >Spouse:</label>
                            <input v-model="form.spouse" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-8' type='text'  required>
                        </div>
                    </div>
                    <label class='block uppercase tracking-wide text-yellow-500 text-lg font-bold mb-2 mt-2' >Two Personal Reference</label>
                    <div class="w-full flex">
                        <div class="w-1/2">
                            <div class="w-full pr-2 mb-2">
                                <label class='block uppercase tracking-wide text-yellow-500 text-xs font-bold mb-2' >Name:</label>
                                <input v-model="form.reference_one_name" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-4' type='text'  required>
                            </div>
                            <div class="w-full pr-2 mb-2">
                                <label class='block uppercase tracking-wide text-yellow-500 text-xs font-bold mb-2'>Address:</label>
                                <input v-model="form.reference_one_address" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-4' type='text'  required>
                            </div>
                            <div class="w-full pr-2 mb-2">
                                <label class='block uppercase tracking-wide text-yellow-500 text-xs font-bold mb-2'>Mobile no.:</label>
                                <input v-model="form.reference_one_mobile_no" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-4' type='text'  required>
                            </div>
                            <div class="w-full pr-2 mb-2">
                                <label class='block uppercase tracking-wide text-yellow-500 text-xs font-bold mb-2'>Relationship:</label>
                                <input v-model="form.reference_one_relationship" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-4' type='text'  required>
                            </div>
                        </div>
                        <div class="w-1/2">
                            <div class="w-full pr-2 mb-2">
                                <label class='block uppercase tracking-wide text-yellow-500 text-xs font-bold mb-2' >Name:</label>
                                <input v-model="form.reference_two_name" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-4' type='text'  required>
                            </div>
                            <div class="w-full pr-2 mb-2">
                                <label class='block uppercase tracking-wide text-yellow-500 text-xs font-bold mb-2'>Address:</label>
                                <input v-model="form.reference_two_address" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-4' type='text'  required>
                            </div>
                            <div class="w-full pr-2 mb-2">
                                <label class='block uppercase tracking-wide text-yellow-500 text-xs font-bold mb-2'>Mobile no.:</label>
                                <input v-model="form.reference_two_mobile_no" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-4' type='text'  required>
                            </div>
                            <div class="w-full pr-2 mb-2">
                                <label class='block uppercase tracking-wide text-yellow-500 text-xs font-bold mb-2'>Relationship:</label>
                                <input v-model="form.reference_two_relationship" class='border-gray-400 appearance-none block w-full bg-white text-gray-700 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-yellow-500 h-4' type='text'  required>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mb-4">
                        <button v-if="!isLoading" @click="saveApplicant" class="focus:outline-none bg-yellow-500 ml-auto fali-bg hover:bg-yellow-300 text-gray-900 font-bold py-2 px-4 rounded inline-flex items-center mr-4">
                            <span>Save Applicant</span>
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </button>
                        <button v-else disabled class="focus:outline-none ml-auto fali-bg hover:bg-orange-400 text-white font-bold py-2 px-4 rounded inline-flex items-center mr-4">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 mr-2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                            <span>Saving....</span>
                        </button>
                    </div>
                </div>
            </div>
        </modal>
        <modal name="transaction-modal" draggable=".window-header" :height="'600px'" :width="'80%'" :clickToClose="false">
            <div class="window-header bg-gray-900 flex py-2 px-2">
                <p class="font-bold text-yellow-500">Lots</p>
                <button class="ml-auto text-white focus:outline-none" @click="closeTransactionModal">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="9" x2="15" y2="15"></line><line x1="15" y1="9" x2="9" y2="15"></line></svg>
                </button>
            </div>
            <div>
                <div class="w-full font-bold text-2xl text-gray-900 mx-2 my-4">
                    {{ applicantName }}
                </div>
                <div class="container">
                    <table class="text-left w-full">
                        <thead class="bg-gray-900 flex text-white w-full">
                            <tr class="flex w-full">
                                <th class="p-4 w-3/6">Lot</th>
                                <th class="p-4 w-1/6">Amount</th>
                                <th class="p-4 w-1/6">OR No</th>
                                <th class="p-4 w-2/6">Date and Time</th>
                            </tr>
                        </thead>
                    <!-- Remove the nasty inline CSS fixed height on production and replace it with a CSS class — this is just for demonstration purposes! -->
                        <tbody class="bg-grey-light flex flex-col items-center overflow-y-scroll w-full" style="height: 70vh;">
                            <tr class="flex w-full text-gray-900 hover:bg-yellow-200" v-for="transaction in applicantTransactions">
                                <td class="p-2 w-3/6 font-bold">{{ `${transaction.lot.name} Block:${transaction.lot.block_no} Lot:${transaction.lot.lot_no}` }}</b></td>
                                <td class="p-2 w-1/6">P {{ transaction.amount }}</td>
                                <td class="p-2 w-1/6">{{ transaction.or_no }}</td>
                                <td class="p-2 w-2/6">{{ transaction.created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex px-3">
                        <paginate
                            :page-count="transactionPaginate.meta.last_page"
                            :click-handler="getApplicantTransactions"
                            :prev-text="`<i class='fas fa-angle-left'></i><b class='focus:outline-none'> Prev</b>`"
                            :next-text="`<b class='focus:outline-none'>Next </b><i class='fas fa-angle-right'></i>`"
                            :container-class="'pagination'"
                            class="flex justify-end focus:outline-none ml-auto"
                            prev-class="focus:outline-none text-sm mr-2 fali-bg hover:bg-yellow-500 text-gray-900 py-1 px-2 rounded focus:outline-none focus:shadow-outline" 
                            next-class="focus:outline-none text-sm ml-2 fali-bg hover:bg-yellow-500 text-gray-900 py-1 px-2 rounded focus:outline-none focus:shadow-outline"  
                            page-link-class="focus:outline-none text-sm mt-10 mx-2 hover:bg-yellow-500 text-bg-gray-800 py-1 px-2 rounded focus:outline-none focus:shadow-outline" 
                            active-class="focus:outline-none text-sm fali-bg hover:bg-yellow-500 text-gray-900 py-1 px-2 rounded focus:outline-none focus:shadow-outline"
                            >
                        </paginate>
                    </div>
                </div>
            </div>
        </modal>
        <modal name="payment-modal" draggable=".window-header" :height="'300px'" :width="'40%'" :clickToClose="false">
            <div class="window-header bg-gray-900 flex py-2 px-2">
                <p class="font-bold text-yellow-500">Enter Amount and OR Number</p>
                <button class="ml-auto text-white focus:outline-none" @click="closePayModal">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="9" x2="15" y2="15"></line><line x1="15" y1="9" x2="9" y2="15"></line></svg>
                </button>
            </div>
            <div>
                <div class="container">
                    <div class="flex items-center justify-between mt-4">
                        <div class='w-full px-3 mb-4'>
                            <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >Amount</label>
                            <input v-model="paymentForm.amount" class='appearance-none block w-full bg-white text-gray-700 border-orange-400 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-orange-500' type='text'  required>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <div class='w-full px-3 mb-4'>
                            <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' >OR number</label>
                            <input v-model="paymentForm.or_no" class='appearance-none block w-full bg-white text-gray-700 border-orange-400 border shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-orange-500' type='text'  required>
                        </div>
                    </div>
                    <div class="flex justify-end mb-4">
                        <button v-if="!isLoading" @click="savePayment" class="focus:outline-none bg-yellow-500 ml-auto fali-bg hover:bg-yellow-300 text-gray-900 font-bold py-2 px-4 rounded inline-flex items-center mr-4">
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
    import { ModelListSelect } from 'vue-search-select'

    export default {
        components: {
            ModelListSelect
        },
        data: () => ({
            isLoading: false,
            fullPage: true,
            lotIsChecked: false,
            birth_date:'',
            showLotDetails: false,
            viewTransaction: false,
            transactions: {},
            applicantTransactions: {},
            transactionPaginate: {
                meta: {
                    last_page: 1
                }
            },
            applicant_id:'',
            lots: {},
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
            },
            paymentForm: {
                lot_id: '',
                or_number:'',
                amount: '',
            },
            lotName: '',
            applicantName: '',
            months: '',
            downpayment:'',
            search: '',
            sortBy: '',
            isEdit: false,
        }),
        watch: {
            search: _.debounce(function(newVal){
                this.getApplicants(1)
            }, 200),
            birth_date: _.debounce(function(newVal){
                this.form.birth_date = newVal
                this.getAge(newVal);
            }, 200),
            downpayment: _.debounce(function(newVal){
                this.calculateMonthly()
            }, 200),
            months: _.debounce(function(newVal){
                this.calculateMonthly()
            }, 200),
        },
        computed: {
            ...mapGetters({
                errors: 'agent/errors',
                agents: 'agent/agentsSelect',
                pagination: 'agent/pagination',
                applicants: 'applicant/applicants'
            }),
        },
        methods: {
            transactionModal(applicant) {
                this.applicantName = applicant.name
                this.$modal.show('transaction-modal')
                this.applicant_id = applicant.id
                this.getApplicantTransactions(1);
            },
            async getApplicantTransactions(page = 1) {
                await axios.get(`/getApplicantTransactions?page=${page}`, {
                        params: {
                            applicant_id: this.applicant_id
                        }
                    })
                    .then(response => {
                        this.applicantTransactions = response.data.data
                        this.transactionPaginate = response.data
                    });
            },
            closeTransactionModal() {
                this.$modal.hide('transaction-modal')
            },
            async openTransactions(lot) {
                this.viewTransaction = true
                this.lotName = `${lot.name} Block: ${lot.block_no} Lot: ${lot.lot_no}`
                await axios.get(`/lot-transactions/${lot.id}`)
                .then(response => {
                    this.transactions = response.data
                });
            },
            payLot(lot) {
                this.paymentForm.lot_id = lot.id
                this.$modal.show('payment-modal')
            },
            closePayModal() {
                this.$modal.hide('payment-modal')
                this.paymentForm = {
                    lot_id: '',
                    or_number:'',
                    amount: '',
                }
            },
            async savePayment() {
                this.isLoading = true
                await axios.put(`/payment/${this.paymentForm.lot_id}`, this.paymentForm)
                .then(response => {
                    this.closePayModal()
                    this.getApplicants(1)
                });
                this.isLoading = false
            },
            getAge(birthday) {
                var parts = birthday.match(/(\d+)/g);
                var newBirthday = new Date(parts[0], parts[1]-1, parts[2]);
                var ageDifMs = Date.now() - newBirthday.getTime();
                var ageDate = new Date(ageDifMs); // miliseconds from epoch
                this.form.age = Math.abs(ageDate.getUTCFullYear() - 1970);
            },
            name (item) {
                return `${item.name}`
            },
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
                }
            },
            addAgentModal() {
                this.isEdit = false
                this.clearForm()
                this.openModal()
            },
            editAgentModal(applicant) {
                this.isEdit = true;
                this.form = applicant
                this.openModal();
            },
            openModal() {
                this.$modal.show('applicant-form')
                this.$modal.hide('lot-form')
            },
            closeModal() {
                this.$modal.hide('applicant-form')
                this.$modal.hide('lot-form')
                this.lotExist = true
            },
            async getApplicants(page = 1) {
                await this.$store.dispatch('applicant/getApplicants', {
                    params: {
                        page: page,
                        search: this.search
                    }
                })
            },
            async getAgent() {
                await this.$store.dispatch('agent/agentSelect')
            },
            async saveApplicant () {
                this.isLoading = true
                if(this.isEdit) {
                    await this.$store.dispatch('applicant/updateApplicant', this.form)
                    if(Object.keys(this.errors).length == 0) {
                        this.getApplicants();
                        this.closeModal();
                    }
                } else {
                    await this.$store.dispatch('applicant/saveApplicant', this.form)
                    .then(response => {
                        this.form.id = response.data.id
                        this.lotModal(response.data);
                    });
                    if(Object.keys(this.errors).length == 0) {
                        this.getApplicants();
                    }
                }
                this.isLoading = false
            },
            async deleteAgent (id) {
                this.isLoading = true
                await this.$store.dispatch('agent/deleteAgent', { id: id })
                this.getApplicants()
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
            this.getApplicants();
            this.getAgent();
        }
    }
</script>

