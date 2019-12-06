<template>
	<div>
		<div class="tuna-loader-container">
			<div class="tuna-loader"></div>
		</div>

		<div class='tuna-signup-container'>
			<div class='container-fluid'>
				<div class='row'>
                    <div class='tuna-signup-right col-md-12 col-sm-12 '>
						<div class="row">
							<div class="col-lg-8 col-md-8 header-form-title">
								<h2>Fill in the registration form below and our staff will contact you immediately</h2>

							</div>

							<div class="col-lg-4 col-md-4 pull-right">
								<div class='steps-count'>
									STEP <span class="step-current">1</span>/<span class="step-count"></span>
								</div>
							</div>
						</div>

                        <div class="tuna-steps">
                            <div class="step step-active" data-step-id='1'>
								<div class="inputDivider">
									<label class="formLabel" for="tn_name">Full Name</label>
									<input type="text" class="formInput" id='tn_name' name="tn_name" autocomplete="nope" spellcheck="false" v-model="fullName" v-validate="'required|alpha_spaces'" data-vv-as="Full Name" />
									<div class='help-error help-error-name'>{{ errors.first('tn_name') }}</div>
								</div>

								<div class="inputDivider">
									<label class="formLabel" for="tn_email">Email</label>
									<input type="email" class="formInput" id='tn_email' name="tn_email" autocomplete="nope" spellcheck="false" v-model="student.email" v-validate="'required|email'" data-vv-as="Email" />
									<div class='help-error help-error-email'>{{ errors.first('tn_email') }}</div>
								</div>

								<div class="inputDivider">
									<label class="formLabel" for="tn_phone">Mobile Number</label>
									<input type="text" maxlength="16" class="formInput" id='tn_phone' name="tn_phone" @keypress="phoneValidator" autocomplete="nope" spellcheck="false" v-model="student.phone" v-validate="'required|min:8|max:16'" data-vv-as="Mobile Number" />
									<div class='help-error help-error-phone'>{{ errors.first('tn_phone') }}</div>
								</div>
                            </div>

							<div class="step" data-step-id='2'>
								<div class="inputDivider">
									<label class="formLabel" for="tn_city">City</label>
									<input type="text" class="formInput" id='tn_city' name="tn_city" autocomplete="nope" spellcheck="false" v-model="student.city" v-validate="'required'" data-vv-as="City" />
									<div class='help-error help-error-city'>{{ errors.first('tn_city') }}</div>
								</div>

                                <div class="inputDivider">
									<label class="formLabel active" for="tn_program">Program Interested</label>
									<form autocomplete="off">
									<Dropdown
										autocomplete="nope"
										:options="programs"
										v-on:selected="setProgram"
										v-on:filter="searchProgram"
										:disabled="false"
										:maxItem="10"
										:selectedItem="student.program_interest"
										placeholder="Type to search your interest program">
									</Dropdown>
									<input hidden type="text" id="tn_program" name="tn_program" v-model="selectedProgramInterest" v-validate="'required'" data-vv-as="Program Interested" />
									</form>
									<div class='help-error help-error-program'>{{ errors.first('tn_program') }}</div>
								</div>

								<div class="inputDivider">
									<label class="formLabel active" for="tn_offices">SUN Office Near you?</label>
									<Dropdown
										:options="student.officeList"
										v-on:selected="setOffice"
										v-on:filter="searchOffice"
										:disabled="false"
										:selectedItem="student.office"
										:maxItem="50"
										placeholder="Type to search SUN Office Near you">
									</Dropdown>
									<input hidden type="text" id="tn_office" name="tn_office" v-model="selectedOffice" v-validate="'required'" data-vv-as="SUN Office Near you?" />
									<div class='help-error help-error-year'>{{ errors.first('tn_office') }}</div>
								</div>
                            </div>

							<div class="step" data-step-id='3'>
								<div class="inputDivider">
									<label class="formLabel" for="tn_message">Message</label>
									<input type="text" class="formInput" id='tn_message' name="tn_message" autocomplete="nope" spellcheck="false" v-model="student.message" v-validate="'required'" data-vv-as="Message" />
									<div class='help-error help-error-message'>{{ errors.first('tn_message') }}</div>
								</div>
							</div>

                            <div class="step step-confirm" data-step-id='4'>
                                <form v-on:submit.prevent="onSubmit" v-on:keyup.enter="onSubmit" name='signupForm' autocomplete="off" class="form-horizontal">
                                    <div class="form-group">
                                        <div class="control-label col-md-4">Full Name</div>
                                        <div class="col-md-8">
                                            <div class="input-container">
                                                <input type="text" id="ck_name" name="ck_name" autocomplete="nope" spellcheck="false" class="form-control" v-model="fullName" v-validate="'required|alpha_spaces'" data-vv-as="Full Name"/>
												<div class='help-error help-error-school-name'>{{ errors.first('ck_name') }}</div>
                                                <a href="javascript:void(0)" class="editInput">EDIT</a>
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <div class="control-label col-md-4">Email</div>
                                        <div class="col-md-8">
                                            <div class="input-container">
                                                <input type="email" id="ck_email" name="ck_email" autocomplete="nope" spellcheck="false" class="form-control" v-model="student.email" v-validate="'required|email'" data-vv-as="Email" />
												<div class='help-error help-error-email'>{{ errors.first('tn_email') }}</div>
                                                <a href="javascript:void(0)" class="editInput">EDIT</a>
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <div class="control-label col-md-4">Mobile Phone</div>
                                        <div class="col-md-8">
                                            <div class="input-container">
                                                <input type="text" maxlength="16" id="ck_phone" name="ck_phone" autocomplete="nope" spellcheck="false" class="form-control" @keypress="phoneValidator" v-model="student.phone" v-validate="'required|min:8|max:16'" data-vv-as="Mobil Phone" />
												<div class='help-error help-error-phone'>{{ errors.first('tn_phone') }}</div>
                                                <a href="javascript:void(0)" class="editInput">EDIT</a>
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <div class="control-label col-md-4">City</div>
                                        <div class="col-md-8">
                                            <div class="input-container">
                                                <input type="text" id="ck_city" name="ck_city" autocomplete="nope" spellcheck="false" class="form-control" v-model="student.city" v-validate="'required'" data-vv-as="City" />
												<div class='help-error help-error-city'>{{ errors.first('ck_city') }}</div>
                                                <a href="javascript:void(0)" class="editInput">EDIT</a>
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <div class="control-label col-md-4">Program Interest</div>
                                        <div class="col-md-8">
                                            <div class="input-container">
												<Dropdown
													class="review"
													name="ck_program_drop"
													autocomplete="nope"
													:options="programs"
													v-on:selected="setProgram"
													v-on:filter="searchProgram"
													:disabled="false"
													:maxItem="10"
													:selectedItem="student.program_interest"
													placeholder="Type to search your interest program">
												</Dropdown>
												<input hidden type="text" id="ck_program" name="ck_program" v-model="selectedProgramInterest" v-validate="'required'" data-vv-as="Program Interest" />
												<div class='help-error help-error-program'>{{ errors.first('ck_program') }}</div>
                                                <a href="javascript:void(0)" class="editInput">EDIT</a>
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <div class="control-label col-md-4">SUN Office Near you?</div>
                                        <div class="col-md-8">
                                            <div class="input-container">
                                                <Dropdown
													class="review"
													name="ck_offices_drop"
													:options="student.officeList"
													v-on:selected="setOffice"
													v-on:filter="searchOffice"
													:disabled="false"
													:selectedItem="student.office"
													:maxItem="50"
													placeholder="Type to search SUN Office Near you">
												</Dropdown>
												<input hidden type="text" id="ck_office" name="ck_office" v-model="selectedOffice" v-validate="'required'" data-vv-as="SUN Office Near you?" />
												<div class='help-error help-error-office'>{{ errors.first('ck_office') }}</div>
                                                <a href="javascript:void(0)" class="editInput">EDIT</a>
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <div class="control-label col-md-4">Message</div>
                                        <div class="col-md-8">
                                            <div class="input-container">
                                                <input type="text" id="ck_message" name="ck_message" autocomplete="nope" spellcheck="false" class="form-control" v-model="student.message" v-validate="'required'" data-vv-as="Message" />
												<div class='help-error help-error-message'>{{ errors.first('ck_message') }}</div>
                                                <a href="javascript:void(0)" class="editInput">EDIT</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-8 col-sm-12 col-md-offset-4 col-sm-offset-0">
                                            <label class="checkbox-inline agreement">
                                                <input id="agreement" name="agreement" type="checkbox"/>I agree with <a href="https://suneducationgroup.com/terms-of-use/" target="_blank">Terms of Use</a> and <a href="https://suneducationgroup.com/privacy-policy" target="_blank">Privacy Policy</a>.
                                            </label>
                                        </div>
                                    </div>

                                    <div class="step-confirm-buttons">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <a href="javascript:void(0)" class='btn btn-white-transparent btn-rounded prevStep' @click="goToAdvanced">Complete it</a>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <a href="javascript:void(0)" class="btn btn-white btn-rounded finishBtn" @click="onSubmit">Submit !</a>
                                                <span>or press "Enter"</span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class='button-container'>
                            <div>
                                <a href="javascript:void(0)" class="btn btn-white btn-rounded nextStep" tabindex="0" :disabled="errors.items.length > 0" @click="nextStep">Next Step →</a>
                                <span>or press "Enter"</span>
                            </div>
                            <a href="javascript:void(0)" class='btn btn-white-transparent btn-rounded prevStep' tabindex="1" @click="prevStep">← Previous</a>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</template>

<style>
@media only screen and (max-width: 760px) {
	.tuna-steps .step {
		top: 32%;
	}
	.button-container {
		bottom: 28% !important;
		right: 0;
	}
    .formLabel, .formInput, .step-label {
        font-size: 16px;
    }
    .inputDivider {
        margin-bottom: 30px;
    }
    .h2, h2 {
        font-size: 22px !important;
    }
}
</style>


<script>
	import { mapState, mapActions, mapGetters } from 'vuex'
	import LeftSidebar from '../../components/LeftSidebar'
	import Dropdown from '../../components/Dropdown';

	export default {
		name: 'SunEngSimple',
		metaInfo: {
			title: 'Just Simple ! - Sun English Web'
		},
		data() {
			return {
				program_name: '',
				splash: true,
				programs: [{
					id: "IELTS",
					name: "IELTS"
				},
				{
					id: "TOEFL iBT",
					name: "TOEFL iBT"
				},
				{
					id: "GMAT",
					name: "GMAT"
				},
				{
					id: "GRE",
					name: "GRE"
				},
				{
					id: "SAT",
					name: "SAT"
				},
				{
					id: "PTE Academic",
					name: "PTE Academic"
				},
				{
					id: "General English",
					name: "General English"
				},
				{
					id: "English Conversation",
					name: "English Conversation"
				},
				{
					id: "Business English",
					name: "Business English"
				},
				{
					id: "Versant",
					name: "Versant"
				}]
			}
		},
		components: {
			LeftSidebar,
			Dropdown
		},
		computed: {
			fullName: {
				get: function() {
					return this.student.name
				},
				set: function(val) {
					this.student.name = val.toLowerCase().replace(/\b[a-z]/g, function(letter) {
						return letter.toUpperCase();
					});
				}
			},
			parentsName: {
				get: function() {
					return this.student.parents.name
				},
				set: function(val) {
					this.student.parents.name = val.toLowerCase().replace(/\b[a-z]/g, function(letter) {
						return letter.toUpperCase();
					});
				}
			},
			uiBirthDate: function() {
				return `${this.student.birthDate.day}/${this.student.birthDate.month}/${this.student.birthDate.year}`
			},
			birthDate: function() {
				this.student.birth = `${this.student.birthDate.year ? this.student.birthDate.year : '0000'}-${this.student.birthDate.month ? this.student.birthDate.month : '00'}-${this.student.birthDate.day ? this.student.birthDate.day : '00'}`
				return this.student.birth
			},
			...mapState({
				student: state => state.firstForm
			}),
			...mapGetters('firstForm', [
				'selectedEdu',
				'selectedZipcode',
				'selectedYear',
				'selectedOffice',
				'selectedPrecur',
				'selectedMarketing',
                'selectedProgram',
                'selectedProgramInterest',
				'submitStatus'
			])
		},
		created() {
			this.getZip(15)
			this.getHighestEdu()
			this.getPrecurSchool('')
			this.getMarketingSource()
			this.getOfficeList()

            this.program_name = this.$route.params.program

            let tunaScript = document.createElement('script')
			tunaScript.setAttribute('src', '/form/js/main.js')
			document.body.appendChild(tunaScript)

			setTimeout(() => {
				$(document).on('ready', function() {
					tunaWizard.start()
				})
			}, 1000)
		},
		updated() {
			const vm = this

			const {
				program_interest,
				office,
			} = vm.student

			$('input[name=ck_program_drop]').val(program_interest.name)
			$('input[name=ck_offices_drop]').val(office.name)
		},
		methods: {
			...mapActions({
                getZip: 'firstForm/searchZip',
                getPrecurSchool: 'firstForm/searchPrecur',
				getHighestEdu: 'firstForm/getHighestEdu',
				getMarketingSource: 'firstForm/getMarketingSource',
				getOfficeList: 'firstForm/getOfficeList',
				submitData: 'firstForm/submitData',
				resetForm: 'firstForm/resetForm'
			}),
            goToAdvanced(){
                this.$router.push({ path: 'advanced' })
            },
			isEmail(value) {
				value = value.toLowerCase();
				const reg = new RegExp(/^[a-z]{1}[\d\w\.-]+@[\d\w-]{3,}\.[\w]{2,3}(\.\w{2})?$/);
				return reg.test(value);
			},
			phoneValidator($event) {
				const checker = new RegExp(/[0-9()+]/g)
				checker.test($event.key) ? true : $event.preventDefault()
			},
			numberOnly($event) {
				const checker = new RegExp(/^\d*$/g)
				checker.test($event.key) ? true : $event.preventDefault()
			},
			checkDay($event) {
				if ($event.target.value.length == 2) {
					setTimeout(() => document.getElementById('tn_birth_month').focus(), 500)
				}
			},
			checkMonth($event) {
				if ($event.target.value.length == 2) {
					setTimeout(() => document.getElementById('tn_birth_year').focus(), 500)
				}
			},
			prevStep() {
				var currentStep = $(".step-active").attr("data-step-id")
				var nextStep = parseFloat(currentStep) - 1;

				this.$validator.reset();
				tunaWizard.changeStep(currentStep, nextStep);
			},
			nextStep() {
				const currentStep = $(".step-active").attr("data-step-id")
				const nextStep = parseFloat(currentStep) + 1
				const vm = this

				this.validating()
				.then((response) => vm.errors.items.length > 0 ? false : tunaWizard.changeStep(currentStep, nextStep))
				.catch(() => tunaWizard.changeStep(currentStep, nextStep))

				switch(nextStep) {
					case 2:
						setTimeout(() => document.getElementById('tn_city').focus(), 800)
						break;

					case 3:
						setTimeout(() => document.getElementById('tn_message').focus(), 800)
						break;

					default:
						return true
				}

				if (nextStep == $(".tuna-steps .step").length) {
					$(".steps-count").html("CONFIRM DETAILS")
				}
			},
			validating() {
                const currentStep = $(".step-active").attr("data-step-id")
                const nextStep = parseFloat(currentStep) + 1
				const vm = this

				return new Promise(function(resolve, reject) {
					try {
						switch(nextStep) {
							case 2:
								vm.$validator.validate('tn_name')
								vm.$validator.validate('tn_email')
								vm.$validator.validate('tn_phone')
								resolve()
								break;

							case 3:
								vm.$validator.validate('tn_city')
								vm.$validator.validate('tn_program')
								vm.$validator.validate('tn_office')
								resolve()
								break;

							case 4:
								vm.$validator.validate('tn_message')
								resolve()
								break;

							default:
								resolve()
								break;
						}
					} catch {
						rejected()
					}
				})
			},
			reviewValidate() {
				const vm = this;

				return new Promise((resolve, reject) => {
					vm.$validator.validateAll()
				})
			},
			setZipcode(selected) {
				this.student.zipcode = selected
				$('input[name=ck_zip_drop]').val(selected.name)
			},
			searchZipcode(query) {
				query ? this.getZip(query) : this.getZip(15)
			},
			setHighEdu(selected) {
				this.student.edu_grade = selected
				$('input[name=ck_edu_grade_drop]').val(selected.name)
			},
			searchHighEdu(query) {
			},
			setPrecur(selected) {
				this.student.school_name = selected
				$('input[name=ck_school_name]').val(selected.name)
			},
			searchPrecur(query) {
                this.getPrecurSchool(query)
			},
			setPlanYear(selected) {
				this.student.plan_year = selected
				$('input[name=ck_year_drop]').val(selected.name)
			},
			searchPlanYear(query) {
			},
			setOffice(selected) {
				this.student.office = selected
				$('input[name=ck_offices_drop]').val(selected.name)
			},
			searchOffice(query) {
			},
			setProgram(selected) {
				this.student.program_interest = selected
				$('input[name=ck_program_drop]').val(selected.name)
			},
			searchProgram(query) {},
			onSubmit() {
				const submitForm = $("form[name='signupForm']")

				submitForm.find(".confirm-input-error").removeClass("confirm-input-error");

				this.$validator.validateAll().then((result) => {
				if (result) {
					if (!$("input[name='agreement']").prop("checked")) {
						swal({
							title: "Warning!",
							text: "You must agree with the terms and conditions.",
							type: "warning",
							confirmButtonText: 'OK',
  							confirmButtonColor: '#007bff',
						});
						return;
					}

					const {
						name,
						email,
						phone,
						program_interest,
						city,
						office,
						message
					} = this.student

					const dataToSend = {
                        registration_type: "sun-eng-general-registration",
                        form_type: "simple",
						program_name: program_interest.id,
						full_name: name,
						email,
						mobile: phone,
						kabupaten: city,
						branch_id: office.id,
						message
					}

					this.submitData(dataToSend)
				}
					return false;
				})
			}
		},
		watch: {
			submitStatus(data) {
                const { isLoading, isSuccess, isError } = data
                const vm = this

				if (isLoading) {
					swal({
						title: null,
						text: "<img class='tuna_loading' src='/form/images/loading.svg'/> Mengirim...",
						html: true,
						showConfirmButton: false
					});
				}

				if (isSuccess) {
					swal({
						title: "Registration sent!",
						text: "A confirmation email has been sent, please check your email to receive the updates.",
						type: "success",
						confirmButtonText: 'Done',
						confirmButtonColor: '#007bff',
					}, () => {
                        vm.resetForm()
						location.reload()
					});
				}

				if (isError) {
					swal({
						title: "Error!",
						text: "Failed connect to the server, please try again.",
						type: "error",
						confirmButtonText: 'Close',
						// confirmButtonColor: '#007bff',
					});
				}
            },
            student() {
                return this.student
            }
		},
		mounted: function() {
			const vm = this;

			if (this.student.gender == "") {
				this.student.gender == "m"
			}

			$(".step input").not(".step-confirm input").on("keypress", function(e) {
				if (e.keyCode === 13) {
					vm.nextStep()
				}
			})
		}
	}
</script>
