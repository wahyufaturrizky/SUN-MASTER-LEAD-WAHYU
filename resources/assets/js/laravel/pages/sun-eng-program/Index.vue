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
									<label class="formLabel active" for="tn_email">Date of Birth</label>
									<div class="row" style="margin-left:0px;">
										<div style="width:65px;display:inline-block;">
											<input type="text" maxlength="2" class="formInput" id='tn_birth_day' name="tn_birth_day" autocomplete="nope" spellcheck="false" placeholder="DD" @keypress="numberOnly" @keyup="checkDay" v-model="student.birthDate.day" />
											<span class="birthLabel">/</span>
										</div>
										<div style="width:70px;display:inline-block;">
											<input type="text" maxlength="2" class="formInput" id='tn_birth_month' name="tn_birth_month" autocomplete="nope" spellcheck="false" placeholder="MM" @keypress="numberOnly" @keyup="checkMonth" v-model="student.birthDate.month" />
											<span class="birthLabel">/</span>
										</div>
										<div style="width:50px;display:inline-block;">
											<input type="text" maxlength="4" class="formInput" id='tn_birth_year' name="tn_birth_year" autocomplete="nope" spellcheck="false" placeholder="YYYY" @keypress="numberOnly" v-model="student.birthDate.year" />
										</div>
									</div>
									<input type="text" name="tn_ui_birth" id="tn_ui_birth" hidden v-model="uiBirthDate" v-validate="'date_format:dd/MM/yyyy'" data-vv-as="Date of Birth">
									<input type="text" name="tn_birth" id="tn_birth" hidden v-model="birthDate">
									<div class='help-error help-error-birth'>{{ errors.first('tn_ui_birth') }}</div>
								</div>

								<div class="inputDivider">
									<div class="formLabel active">Gender</div>
									<label class="radio-inline"><input type="radio" value="m" name="tn_gender" checked v-model="student.gender"> Male</label>
									<label class="radio-inline"><input type="radio" value="f" name="tn_gender" v-model="student.gender"> Female</label>
									<div class='help-error help-error-gender'>{{ errors.first('tn_gender') }}</div>
								</div>

								<div class="inputDivider">
									<label class="formLabel" for="tn_parents_name">Parents Name</label>
									<input type="text" class="formInput" id='tn_parents_name' name="tn_parents_name" autocomplete="nope" spellcheck="false" v-model="parentsName" v-validate="'required|alpha_spaces'" data-vv-as="Parents Name" />
									<div class='help-error help-error-parents-name'>{{ errors.first('tn_parents_name') }}</div>
								</div>
                            </div>

							<div class="step" data-step-id='3'>
                                <div class="inputDivider">
									<label class="formLabel active" for="tn_parents_phone">Parents Phone</label>
									<input type="text" maxlength="16" class="formInput" id='tn_parents_phone' name="tn_parents_phone" autocomplete="nope" spellcheck="false" @keypress="phoneValidator" v-model="student.parents.phone" v-validate="'required|min:8|max:16'" data-vv-as="Parents Phone" />
									<div class='help-error help-error-parents-phone'>{{ errors.first('tn_parents_phone') }}</div>
								</div>

								<div class="inputDivider">
									<label class="formLabel" for="tn_parents_email">Parents Email</label>
									<input type="email" class="formInput" id='tn_parents_email' name="tn_parents_email" autocomplete="nope" spellcheck="false" v-model="student.parents.email" v-validate="'required|email'" data-vv-as="Parents Email" />
									<div class='help-error help-error-email'>{{ errors.first('tn_parents_email') }}</div>
								</div>

								<div class="inputDivider">
									<label class="formLabel" for="tn_home_phone">Fixed/Home Phone</label>
									<input type="text" maxlength="16" class="formInput" id='tn_home_phone' name="tn_home_phone" autocomplete="nope" spellcheck="false" v-model="student.phone_home" @keypress="phoneValidator" v-validate="'required|min:8|max:16'" data-vv-as="Fixed/Home Phone" />
									<div class='help-error help-error-home-phone'>{{ errors.first('tn_home_phone') }}</div>
								</div>
                            </div>

							<div class="step" data-step-id='4'>
								<div class="inputDivider">
									<label class="formLabel" for="tn_address">Address</label>
									<input type="text" class="formInput" id='tn_address' name="tn_address" autocomplete="nope" spellcheck="false" v-model="student.address" v-validate="'required'" data-vv-as="Address" />
									<div class='help-error help-error-address'>{{ errors.first('tn_address') }}</div>
								</div>

								<div class="inputDivider">
									<label class="formLabel active" for="tn_zipcode">Zip Code</label>
									<form autocomplete="off">
									<Dropdown
										autocomplete="nope"
										:options="student.ziplist"
										v-on:selected="setZipcode"
										v-on:filter="searchZipcode"
										:disabled="false"
										:maxItem="10"
										:selectedItem="student.zipcode"
										placeholder="Type to search zip code">
									</Dropdown>
									<input hidden type="text" id="tn_zipcode" name="tn_zipcode" v-model="selectedZipcode" v-validate="'required|min:5|max:5'" data-vv-as="Zip Code" />
									</form>
									<div class='help-error help-error-zipcode'>{{ errors.first('tn_zipcode') }}</div>
								</div>

								<div class="inputDivider">
									<label class="formLabel active" for="tn_edu_grade">Current Education Grade</label>
									<Dropdown
										:options="student.highestEdu"
										v-on:selected="setHighEdu"
										v-on:filter="searchHighEdu"
										:disabled="false"
										:selectedItem="student.edu_grade"
										:maxItem="10"
										placeholder="Type to search current Education Grade">
									</Dropdown>
									<input hidden type="text" id="tn_edu_grade" name="tn_edu_grade" v-model="selectedEdu" v-validate="'required'" data-vv-as="Current Education Grade" />
									<div class='help-error help-error-edu-grade'>{{ errors.first('tn_edu_grade') }}</div>
								</div>
                            </div>

							<div class="step" data-step-id='5'>
								<div class="inputDivider">
									<label class="formLabel" for="tn_school_name">Previous/Current School</label>
									<Dropdown
										:options="student.precur"
										v-on:selected="setPrecur"
										v-on:filter="searchPrecur"
										:disabled="false"
										:selectedItem="student.school_name"
										:maxItem="10"
										placeholder="Type to search previous/Current School">
									</Dropdown>
									<input hidden type="text" id="tn_school_name" name="tn_school_name" v-model="selectedPrecur" v-validate="'required'" data-vv-as="Previous/Current School" />
									<div class='help-error help-error-school-name'>{{ errors.first('tn_school_name') }}</div>
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

                            <div class="step step-confirm" data-step-id='6'>
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
                                        <div class="control-label col-md-4">Date of Birth</div>
                                        <div class="col-md-8">
                                            <div class="input-container">
                                                <input type="text" id="ck_ui_birth" name="ck_ui_birth" autocomplete="nope" spellcheck="false" class="form-control"  v-model="uiBirthDate" v-validate="'date_format:dd/MM/yyyy'" data-vv-as="Date of Birth" />
												<input type="text" name="ck_birth" id="ck_birth" hidden v-model="birthDate">
                                                <a href="javascript:void(0)" class="editInput">EDIT</a>
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <div class="control-label col-md-4">Gender</div>
                                        <div class="col-md-8">
                                            <div class="input-container">
                                                <select name="ck_gender" id="ck_gender" class="selectpicker form-control" v-model="student.gender" v-validate="'required'" data-vv-as="Gender">
                                                    <option value="m">Male</option>
                                                    <option value="f">Female</option>
                                                </select>
												<div class='help-error help-error-gender'>{{ errors.first('ck_gender') }}</div>
                                                <a href="javascript:void(0)" class="editInput">EDIT</a>
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <div class="control-label col-md-4">Parents Name</div>
                                        <div class="col-md-8">
                                            <div class="input-container">
                                                <input type="text" id="ck_parents_name" name="ck_parents_name" autocomplete="nope" spellcheck="false" class="form-control" v-model="parentsName" v-validate="'required|alpha_spaces'" data-vv-as="Parents Name" />
												<div class='help-error help-error-parents-name'>{{ errors.first('tn_parents_name') }}</div>
                                                <a href="javascript:void(0)" class="editInput">EDIT</a>
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <div class="control-label col-md-4">Parents Email</div>
                                        <div class="col-md-8">
                                            <div class="input-container">
                                                <input type="email" id="ck_parents_email" name="ck_parents_email" autocomplete="nope" spellcheck="false" class="form-control" v-model="student.parents.email" v-validate="'required|email'" data-vv-as="Parents Email" />
												<div class='help-error help-error-email'>{{ errors.first('tn_parents_email') }}</div>
                                                <a href="javascript:void(0)" class="editInput">EDIT</a>
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <div class="control-label col-md-4">Parents Phone</div>
                                        <div class="col-md-8">
                                            <div class="input-container">
                                                <input type="text" maxlength="16" id="ck_parents_phone" name="ck_parents_phone" autocomplete="nope" spellcheck="false" class="form-control" @keypress="phoneValidator" v-model="student.parents.phone" v-validate="'required|min:8|max:16'" data-vv-as="Parents Phone" />
                                                <div class='help-error help-error-parents-phone'>{{ errors.first('ck_parents_phone') }}</div>
												<a href="javascript:void(0)" class="editInput">EDIT</a>
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <div class="control-label col-md-4">Fixed/Home Phone</div>
                                        <div class="col-md-8">
                                            <div class="input-container">
                                                <input type="text" maxlength="16" id="ck_phone_home" name="ck_phone_home" autocomplete="nope" spellcheck="false" class="form-control" v-model="student.phone_home" @keypress="phoneValidator" v-validate="'required|min:8|max:16'" data-vv-as="Fixed/Home Phone" />
												<div class='help-error help-error-home-phone'>{{ errors.first('ck_phone_home') }}</div>
                                                <a href="javascript:void(0)" class="editInput">EDIT</a>
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <div class="control-label col-md-4">Address</div>
                                        <div class="col-md-8">
                                            <div class="input-container">
                                                <input type="text" id="ck_address" name="ck_address" autocomplete="nope" spellcheck="false" class="form-control" v-model="student.address" v-validate="'required'" data-vv-as="Address" />
												<div class='help-error help-error-address'>{{ errors.first('ck_address') }}</div>
                                                <a href="javascript:void(0)" class="editInput">EDIT</a>
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <div class="control-label col-md-4">Zip Code</div>
                                        <div class="col-md-8">
                                            <div class="input-container">
												<Dropdown
													class="review"
													name="ck_zipcode_drop"
													:options="student.ziplist"
													v-on:selected="setZipcode"
													v-on:filter="searchZipcode"
													:disabled="false"
													:maxItem="10"
													:selectedItem="student.zipcode"
													placeholder="Type to search zip code">
												</Dropdown>
												<input hidden type="text" id="ck_zipcode" name="ck_zipcode" v-model="selectedZipcode" v-validate="'required|min:5|max:5'" data-vv-as="Zip Code" />
												<div class='help-error help-error-school-name'>{{ errors.first('ck_zipcode') }}</div>
                                                <a href="javascript:void(0)" class="editInput">EDIT</a>
                                            </div>
                                        </div>
                                    </div>

									<div class="form-group">
                                        <div class="control-label col-md-4">Previous/Current Education Grade</div>
                                        <div class="col-md-8">
                                            <div class="input-container">
                                                <Dropdown
													class="review"
													name="ck_edu_grade_drop"
													:options="student.highestEdu"
													v-on:selected="setHighEdu"
													v-on:filter="searchHighEdu"
													:selectedItem="student.edu_grade"
													:disabled="false"
													:maxItem="10"
													placeholder="Type to search previous/current grade">
												</Dropdown>
												<input hidden type="text" id="ck_edu_grade" name="ck_edu_grade" v-model="selectedEdu" v-validate="'required'" data-vv-as="Previous/Current Grade" />
												<div class='help-error help-error-school-name'>{{ errors.first('ck_edu_grade') }}</div>
                                                <a href="javascript:void(0)" class="editInput">EDIT</a>
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <div class="control-label col-md-4">Previous/Current School</div>
                                        <div class="col-md-8">
                                            <div class="input-container">
												<Dropdown
													class="review"
													name="ck_school_name"
													:options="student.precur"
													v-on:selected="setPrecur"
													v-on:filter="searchPrecur"
													:disabled="false"
													:selectedItem="student.school_name"
													:maxItem="10"
													placeholder="Type to search previous/current school">
												</Dropdown>
												<input hidden type="text" id="ck_school_name" name="ck_school_name" v-model="selectedPrecur" v-validate="'required'" data-vv-as="Previous/Current School" />
												<div class='help-error help-error-school-name'>{{ errors.first('ck_school_name') }}</div>
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
                                        <div class="col-md-8 col-sm-12 col-md-offset-4 col-sm-offset-0">
                                            <label class="checkbox-inline agreement">
                                                <input id="agreement" name="agreement" type="checkbox"/>I agree with <a href="https://suneducationgroup.com/terms-of-use/" target="_blank">Terms of Use</a> and <a href="https://suneducationgroup.com/privacy-policy" target="_blank">Privacy Policy</a>.
                                            </label>
                                        </div>
                                    </div>

                                    <div class="step-confirm-buttons">
                                        <div>
                                            <a href="javascript:void(0)" class="btn btn-white btn-rounded finishBtn" @click="onSubmit">Ready, Let's Start!</a>
                                            <span>or press "Enter"</span>
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
		name: 'SunEngProgram',
		metaInfo: {
			title: 'Our Program ! - Sun English'
		},
		data() {
			return {
				program_name: '',
				splash: true
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
				zipcode,
				edu_grade,
				school_name,
				office,
			} = vm.student

			$('input[name=ck_zipcode_drop]').val(zipcode.name)
			$('input[name=ck_edu_grade_drop]').val(edu_grade.name)
			$('input[name=ck_school_name]').val(school_name.name)
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
			showForm() {
				const vm = this

				this.splash = false

				let tunaScript = document.createElement('script')
				tunaScript.setAttribute('src', '/form/js/main.js')
				document.body.appendChild(tunaScript)

				setTimeout(() => {
					tunaWizard.start()

					$(".step input").not(".step-confirm input").on("keypress", function(e) {
						if (e.keyCode === 13) {
							vm.nextStep()
						}
					})
				}, 1000)

				if (this.student.gender == "") {
					this.student.gender == "m"
				}
			},
            getParameter(param) {
				for (var t = window.location.search.substr(1).split("&"), e = 0; e < t.length; e++) {
					var n = t[e].split("=");
					if (n[0] == param) return decodeURIComponent(n[1])
				}
				return !1
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
						setTimeout(() => document.getElementById('tn_birth_day').focus(), 800)
						break;

					case 3:
						setTimeout(() => document.getElementById('tn_parents_phone').focus(), 800)
						break;

					case 4:
						setTimeout(() => document.getElementById('tn_address').focus(), 800)
						return true
						break;

					case 5:
						return true
						break;

					default:
						$('input[name=ck_zipcode_drop]').val(zipcode.name)
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
								vm.$validator.validate('tn_ui_birth')
								vm.$validator.validate('tn_parents_name')
								resolve()
								break;

							case 4:
								vm.$validator.validate('tn_parents_email')
								vm.$validator.validate('tn_parents_phone')
								vm.$validator.validate('tn_home_phone')
								resolve()
								break;

							case 5:
								vm.$validator.validate('tn_address')
								vm.$validator.validate('tn_zipcode')
								vm.$validator.validate('tn_edu_grade')
								resolve()
								break;

							case 6:
								vm.$validator.validate('tn_school_name')
								vm.$validator.validate('tn_office')
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
				const vm = this;
				this.student.zipcode = selected
				$('input[name=tn_zipcode_drop]').val(selected.name)
				$('input[name=ck_zipcode_drop]').val(selected.name)
			},
			searchZipcode(query) {
				query ? this.getZip(query) : this.getZip(15)
			},
			setHighEdu(selected) {
				this.student.edu_grade = selected
				$('input[name=ck_edu_grade_drop]').val(selected.name)
				$('input[name=ck_edu_grade_drop]').val(selected.name)
			},
			searchHighEdu(query) {
			},
			setPrecur(selected) {
				this.student.school_name = selected
				$('input[name=ck_school_name]').val(selected.name)
				$('input[name=ck_school_name]').val(selected.name)
			},
			searchPrecur(query) {
                this.getPrecurSchool(query)
			},
			setPlanYear(selected) {
				this.student.plan_year = selected
				$('input[name=ck_year_drop]').val(selected.name)
				$('input[name=ck_year_drop]').val(selected.name)
			},
			searchPlanYear(query) {
			},
			setOffice(selected) {
				this.student.office = selected
				$('input[name=ck_offices_drop]').val(selected.name)
				$('input[name=ck_offices_drop]').val(selected.name)
			},
			searchOffice(query) {
			},
			setMarketing(selected) {
				this.student.marketing_source = selected
				$('input[name=ck_marketing_drop]').val(selected.name)
				$('input[name=ck_marketing_drop]').val(selected.name)
			},
			searchMarketing(query) {},
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
						birth,
						gender,
						parents,
						phone_home,
						address,
						zipcode,
						school_name,
						edu_grade,
						plan_year,
						office,
						contact_sun,
						marketing_source
					} = this.student

					const dataToSend = {
						registration_type: this.program_name,
						program_name: this.program_name,
						full_name: name,
						email,
						mobile: phone,
						birth,
						gender,
						parents_name: parents.name,
						parents_email: parents.email,
						parents_mobile: parents.phone,
						fixed_phone: phone_home,
						address,
						zip_code: zipcode.id,
						precur_school_id: school_name.id,
						highest_edu_id: edu_grade.id,
						branch_id: office.id,
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
			},
		},
		mounted: function() {
			const vm = this;

            this.program_id = this.getParameter('id')

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
