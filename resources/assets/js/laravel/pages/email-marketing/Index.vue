<template>
    <v-app id="inspire" v-if="!showResults">
        <v-content>
        <v-container fluid fill-height>
            <v-layout align-start justify-center>
            <v-flex>
                <!-- <v-card> -->
                <v-card-text>
                    <v-form ref="form" v-model="isValid" lazy-validation="true">
                    <v-card-text>
                        <v-select
                            @change="selectTargetProfile()"
                            v-model="form.targetProfile"
                            :items="masterData.targetProfile"
                            label="Target Profile"
                            placeholder="Select one"
                            hint=""
                            persistent-hint
                            clearable
                            :error-messages="errors.collect('Target Profile')"
                            data-vv-name="Target Profile"
                        ></v-select>

                        <!-- Type Leads .Start -->
                        <v-select
                        v-if="form.targetProfile == 'Leads'"
                        v-model="form.typeLeads"
                        :items="masterData.typeLeads"
                        label="Type"
                        placeholder="All"
                        hint=""
                        persistent-hint
                        clearable
                        required
                        v-validate="'required'"
                        :error-messages="errors.collect('Type')"
                        data-vv-name="Type"
                        ></v-select>
                        <!-- Type Leads .End -->

                        <!-- Type Staff .Start -->
                        <!-- <v-select
                        v-if="form.targetProfile == 'Staff'"
                        @change="selectTypeStaff"
                        v-model="form.typeStaff"
                        :items="masterData.typeStaff"
                        label="Type Staff"
                        placeholder="All"
                        hint=""
                        persistent-hint
                        clearable
                        :error-messages="errors.collect('Type Staff')"
                        data-vv-name="Type Staff"
                        ></v-select> -->
                        <!-- Type Staff .End -->

                    </v-card-text>

                        <!-- Leads .Start -->
                        <div v-if="form.targetProfile == 'Leads'">
                            <hr class="v-divider theme--light" v-if="form.typeLeads != ''">
                            <!-- Leads - SAP . Start-->
                            <div v-if="form.typeLeads == 'SAP'">
                                <!-- Leads - SAP - Branch -->
                                <!-- <div class="title font-weight-regular justify-space-between">
                                    Branch
                                </div> -->
                                <v-card-text>
                                    <v-autocomplete
                                        v-model="form.branch"
                                        :items="masterData.branch"
                                        item-text="name"
                                        item-value="id"
                                        label="Branch"
                                        placeholder="All"
                                        multiple
                                        hint=""
                                        persistent-hint
                                        clearable
                                        :error-messages="errors.collect('Branch')"
                                        data-vv-name="Branch"
                                    ></v-autocomplete>

                                    <!-- Leads - SAP - Status -->
                                    <v-select
                                        v-model="form.SAPStatus"
                                        :items="masterData.SAPStatus"
                                        item-text="name"
                                        item-value="id"
                                        label="SAP Status"
                                        placeholder="All"
                                        multiple
                                        hint=""
                                        persistent-hint
                                        clearable
                                        :error-messages="errors.collect('SAP Status')"
                                        data-vv-name="SAP Status"
                                    ></v-select>
                                </v-card-text>
                                <br>
                                <hr class="v-divider theme--light">
                                <br>

                                <!-- Leads - SAP - Country -->
                                <!-- <div class="title font-weight-regular justify-space-between">
                                    Country
                                </div> -->
                                <v-card-text :style="{ paddingTop: '0px' }">
                                    <v-autocomplete
                                    @change="selectCountry"
                                    v-model="form.country"
                                    :items="masterData.destinationOfStudy"
                                    item-text="name"
                                    item-value="id"
                                    label="Country"
                                    placeholder="All"
                                    multiple
                                    hint=""
                                    persistent-hint
                                    clearable
                                    :error-messages="errors.collect('Country')"
                                    data-vv-name="Country"
                                    ></v-autocomplete>

                                    <!-- Leads - SAP - Country - Main Institution -->
                                    <v-autocomplete
                                    @keyup="searchInstitution($event.target.value)"
                                    v-model="form.mainInstitution"
                                    :items="masterData.institution"
                                    item-text="name"
                                    item-value="name"
                                    label="Main Institution"
                                    placeholder="All"
                                    multiple
                                    hint=""
                                    persistent-hint
                                    clearable
                                    :error-messages="errors.collect('Main Institution')"
                                    data-vv-name="Main Institution"
                                    ></v-autocomplete>

                                    <!-- Leads - SAP - Country - Start of Main Program (M) -->
                                    <v-select
                                    v-model="form.startOfMainProgramMonth"
                                    :items="masterData.month"
                                    item-text="name"
                                    item-value="id"
                                    label="Start of Main Program (M)"
                                    placeholder="All"
                                    hint=""
                                    persistent-hint
                                    clearable
                                    v-validate="customValidateMainProgram('startOfMainProgramMonth')"
                                    :error-messages="errors.collect('Start of Main Program (M)')"
                                    data-vv-name="Start of Main Program (M)"
                                    ></v-select>

                                    <!-- Leads - SAP - Country - Start of Main Program (Y) -->
                                    <v-select
                                    v-model="form.startOfMainProgramYear"
                                    :items="masterData.year"
                                    item-text="name"
                                    item-value="name"
                                    label="Start of Main Program (Y)"
                                    placeholder="All"
                                    hint=""
                                    persistent-hint
                                    clearable
                                    v-validate="customValidateMainProgram('startOfMainProgramYear')"
                                    :error-messages="errors.collect('Start of Main Program (Y)')"
                                    data-vv-name="Start of Main Program (Y)"
                                    ></v-select>

                                    <!-- Leads - SAP - Country - End of Main Program (M) -->
                                    <v-select
                                    v-model="form.endOfMainProgramMonth"
                                    :items="masterData.month"
                                    item-text="name"
                                    item-value="id"
                                    label="End of Main Program (M)"
                                    placeholder="All"
                                    hint=""
                                    persistent-hint
                                    clearable
                                    v-validate="customValidateMainProgram('endOfMainProgramMonth')"
                                    :error-messages="errors.collect('End of Main Program (M)')"
                                    data-vv-name="End of Main Program (M)"
                                    ></v-select>

                                    <!-- Leads - SAP - Country - End of Main Program (Y) -->
                                    <v-select
                                    v-model="form.endOfMainProgramYear"
                                    :items="masterData.year"
                                    item-text="name"
                                    item-value="name"
                                    label="End of Main Program (Y)"
                                    placeholder="All"
                                    hint=""
                                    persistent-hint
                                    clearable
                                    v-validate="customValidateMainProgram('endOfMainProgramYear')"
                                    :error-messages="errors.collect('End of Main Program (Y)')"
                                    data-vv-name="End of Main Program (Y)"
                                    ></v-select>
                                </v-card-text>
                                <br>
                                <hr class="v-divider theme--light">
                                <br>

                                <!-- Leads - SAP - School of Origin -->
                                <!-- <div class="title font-weight-regular justify-space-between">
                                    School of Origin
                                </div> -->
                                <v-card-text :style="{ paddingTop: '0px' }">
                                    <v-autocomplete
                                    @keyup="searchSchool($event.target.value)"
                                    v-model="form.schoolOfOrigin"
                                    :items="masterData.school"
                                    item-text="name"
                                    item-value="name"
                                    label="School of Origin"
                                    placeholder="All"
                                    multiple
                                    hint=""
                                    persistent-hint
                                    clearable
                                    no-filter
                                    :error-messages="errors.collect('School of Origin')"
                                    data-vv-name="School of Origin"
                                    :menu-props="{'maxHeight':200}"
                                    hide-no-data
                                    ></v-autocomplete>

                                    <!-- Leads - SAP - Current Year of Study -->
                                    <!-- <v-select
                                        v-model="form.currentYearOfStudy"
                                        :items="masterData.year"
                                        item-text="name"
                                        item-value="id"
                                        label="Current Year of Study"
                                        placeholder="All"
                                        multiple
                                        hint=""
                                        persistent-hint
                                        clearable
                                        :error-messages="errors.collect('Current Year of Study')"
                                        data-vv-name="Current Year of Study"
                                        ></v-select> -->

                                    <!-- Leads - SAP - Current Education Grade -->
                                    <v-select
                                        v-model="form.highestEdu"
                                        :items="masterData.highestEdu"
                                        item-text="name"
                                        item-value="name"
                                        label="Current Education Grade"
                                        placeholder="All"
                                        multiple
                                        hint=""
                                        persistent-hint
                                        clearable
                                        :error-messages="errors.collect('Current Education Grade')"
                                        data-vv-name="Current Education Grade"
                                        ></v-select>
                                </v-card-text>
                                <br>
                                <hr class="v-divider theme--light">
                                <br>

                                <!-- Leads - SAP - Program Study (Major & Degree) -->
                                <!-- <div class="title font-weight-regular justify-space-between">
                                    Program Study (Major & Degree)
                                </div> -->
                                <v-card-text :style="{ paddingTop: '0px' }">
                                    <v-select
                                    v-model="form.programStudy"
                                    :items="masterData.programStudy"
                                    item-text="name"
                                    item-value="name"
                                    label="Program Study (Major & Degree)"
                                    placeholder="All"
                                    multiple
                                    hint=""
                                    persistent-hint
                                    clearable
                                    :error-messages="errors.collect('Program Study (Major & Degree)')"
                                    data-vv-name="Program Study (Major & Degree)"
                                    :disabled="true"
                                    ></v-select>

                                    <!-- Leads - SAP - Study Classification -->
                                    <v-select
                                    v-model="form.studyClassification"
                                    :items="masterData.studyClassification"
                                    item-text="name"
                                    item-value="id"
                                    label="Study Classification"
                                    placeholder="All"
                                    multiple
                                    hint=""
                                    persistent-hint
                                    clearable
                                    :error-messages="errors.collect('Study Classification')"
                                    data-vv-name="Study Classification"
                                    ></v-select>

                                    <!-- Leads - SAP - Study Sector -->
                                    <v-select
                                    v-model="form.studySector"
                                    :items="masterData.studySector"
                                    item-text="name"
                                    item-value="id"
                                    label="Study Sector"
                                    placeholder="All"
                                    multiple
                                    hint=""
                                    persistent-hint
                                    clearable
                                    :error-messages="errors.collect('Study Sector')"
                                    data-vv-name="Study Sector"
                                    ></v-select>
                                </v-card-text>
                                <br>
                                <hr class="v-divider theme--light">
                                <br>

                                <!-- <div class="title font-weight-regular justify-space-between">
                                    Scholarship Seeker
                                </div> -->
                                <v-card-text :style="{ paddingTop: '0px' }">
                                    <!-- Leads - SAP - Scholarship Seeker -->
                                    <v-select
                                    v-model="form.scholarshipSeeker"
                                    :items="masterData.yesOrNo"
                                    label="Scholarship Seeker"
                                    placeholder="All"
                                    hint=""
                                    persistent-hint
                                    clearable
                                    :error-messages="errors.collect('Scholarship Seeker')"
                                    data-vv-name="Scholarship Seeker"
                                    ></v-select>

                                    <!-- Leads - SAP - Application Type -->
                                    <v-select
                                    v-model="form.applicationType"
                                    :items="masterData.applicationType"
                                    item-text="name"
                                    item-value="name"
                                    label="Application Type"
                                    placeholder="All"
                                    multiple
                                    hint=""
                                    persistent-hint
                                    clearable
                                    :error-messages="errors.collect('Application Type')"
                                    data-vv-name="Application Type"
                                    ></v-select>
                                </v-card-text>
                                <br>
                                <hr class="v-divider theme--light">
                                <br>

                                <!-- <div class="title font-weight-regular justify-space-between">
                                    Parent's Name
                                </div> -->
                                <!-- <v-card-text :style="{ paddingTop: '0px' }"> -->
                                    <!-- Leads - SAP - Parent's Name -->
                                    <!-- <v-autocomplete
                                    v-model="form.parentsName"
                                    :items="masterData.parentsName"
                                    item-text="name"
                                    item-value="id"
                                    label="Parent's Name"
                                    placeholder="All"
                                    multiple
                                    hint=""
                                    persistent-hint
                                    clearable
                                    :error-messages="errors.collect('Parents Name')"
                                    data-vv-name="Parent's Name"
                                    :allow-overflow="false"
                                    ></v-autocomplete> -->
                                <!-- </v-card-text> -->
                            </div>
                            <!-- Leads - SAP . End-->

                            <!-- Leads - Follow Up . Start-->
                            <div v-if="form.typeLeads == 'Follow Up'">
                                <!-- Leads - Follow Up - Branch .Start -->
                                    <!-- <div class="title font-weight-regular justify-space-between">
                                        Branch
                                    </div> -->
                                    <v-card-text>
                                        <v-autocomplete
                                            @change="selectBranchFollowUp"
                                            v-model="form.branch"
                                            :items="masterData.branch"
                                            item-text="name"
                                            item-value="id"
                                            label="Branch"
                                            placeholder="All"
                                            multiple
                                            hint=""
                                            persistent-hint
                                            clearable
                                            :error-messages="errors.collect('Branch')"
                                            data-vv-name="Branch"
                                        ></v-autocomplete>

                                        <!-- Leads - Follow Up - Counselor -->
                                        <v-select
                                            v-model="form.counselor"
                                            :items="masterData.counselor"
                                            item-text="name"
                                            item-value="id"
                                            label="Counselor"
                                            placeholder="All"
                                            multiple
                                            hint=""
                                            persistent-hint
                                            clearable
                                            :error-messages="errors.collect('Counselor')"
                                            data-vv-name="Counselor"
                                        ></v-select>

                                        <!-- Leads - Follow Up - Status -->
                                        <v-select
                                            v-model="form.followUpStatus"
                                            :items="masterData.followUpStatus"
                                            item-text="name"
                                            item-value="id"
                                            label="Follow Up Status"
                                            placeholder="All"
                                            multiple
                                            hint=""
                                            persistent-hint
                                            clearable
                                            :error-messages="errors.collect('Follow Up Status')"
                                            data-vv-name="Follow Up Status"
                                        ></v-select>
                                    </v-card-text>
                                    <br>
                                    <hr class="v-divider theme--light">
                                    <br>
                                <!-- Leads - Follow Up - Branch .End -->

                                <!-- Leads - Follow Up - Planning Year .Start -->
                                    <!-- <div class="title font-weight-regular justify-space-between">
                                        Planning Year
                                    </div> -->
                                    <v-card-text :style="{ paddingTop: '0px' }">
                                        <!-- Leads - Follow Up - Planning Year -->
                                        <v-select
                                            v-model="form.planningYear"
                                            :items="masterData.year"
                                            item-text="name"
                                            item-value="id"
                                            label="Planning Year"
                                            placeholder="All"
                                            multiple
                                            hint=""
                                            persistent-hint
                                            clearable
                                            :error-messages="errors.collect('Planning Year')"
                                            data-vv-name="Planning Year"
                                        ></v-select>

                                        <!-- Leads - Follow Up - Major Interested -->
                                        <v-text-field
                                            v-model="form.majorInterested"
                                            label="Major Interested"
                                            placeholder="All"
                                        ></v-text-field>

                                        <!-- Leads - Follow Up - Destination of Study -->
                                        <!-- <v-text-field
                                            v-model="form.destinationOfStudy"
                                            label="Destination of Study"
                                            placeholder="All"
                                        ></v-text-field> -->
                                        <v-autocomplete
                                          v-model="form.destinationOfStudy"
                                          :items="masterData.destinationOfStudy"
                                          item-text="name"
                                          item-value="name"
                                          label="Destination of Study"
                                          placeholder="All"
                                          multiple
                                          hint=""
                                          persistent-hint
                                          clearable
                                          :error-messages="errors.collect('Destination of Study')"
                                          data-vv-name="Destination of Study'"
                                        ></v-autocomplete>

                                        <!-- Leads - Follow Up - Program Interested -->
                                        <v-text-field
                                            v-model="form.programInterested"
                                            label="Program Interested"
                                            placeholder="All"
                                        ></v-text-field>
                                    </v-card-text>
                                    <br>
                                    <hr class="v-divider theme--light">
                                    <br>
                                <!-- Leads - Follow Up - Planning Year .End -->

                                <!-- Leads - Follow Up - School of Origin .Start -->
                                    <!-- <div class="title font-weight-regular justify-space-between">
                                        School of Origin
                                    </div> -->
                                    <v-card-text :style="{ paddingTop: '0px' }">
                                        <!-- Leads - Follow Up - School of Origin -->
                                        <v-autocomplete
                                            @keyup="searchSchool($event.target.value)"
                                            v-model="form.schoolOfOrigin"
                                            :items="masterData.school"
                                            item-text="name"
                                            item-value="name"
                                            label="School of Origin"
                                            placeholder="All"
                                            multiple
                                            hint=""
                                            persistent-hint
                                            clearable
                                            no-filter
                                            :error-messages="errors.collect('School of Origin')"
                                            data-vv-name="School of Origin"
                                            :menu-props="{'maxHeight':200}"
                                            hide-no-data
                                            ></v-autocomplete>

                                        <!-- Leads - Follow Up - Current Education Grade -->
                                        <v-select
                                            v-model="form.highestEdu"
                                            :items="masterData.highestEdu"
                                            item-text="name"
                                            item-value="name"
                                            label="Current Education Grade"
                                            placeholder="All"
                                            multiple
                                            hint=""
                                            persistent-hint
                                            clearable
                                            :error-messages="errors.collect('Current Education Grade')"
                                            data-vv-name="Current Education Grade"
                                            ></v-select>

                                        <!-- Leads - Follow Up - Current Year of Study -->
                                        <!-- <v-select
                                            v-model="form.currentYearOfStudy"
                                            :items="masterData.year"
                                            item-text="name"
                                            item-value="id"
                                            label="Current Year of Study"
                                            placeholder="All"
                                            multiple
                                            hint=""
                                            persistent-hint
                                            clearable
                                            :error-messages="errors.collect('Current Year of Study')"
                                            data-vv-name="Current Year of Study"
                                            ></v-select> -->
                                    </v-card-text>
                                    <br>
                                    <hr class="v-divider theme--light">
                                    <br>
                                <!-- Leads - Follow Up - School of Origin .End -->

                                <!-- Leads - Follow Up - Leads Type .Start -->
                                    <!-- <div class="title font-weight-regular justify-space-between">
                                        Leads Type
                                    </div> -->
                                    <v-card-text :style="{ paddingTop: '0px' }">
                                        <!-- Leads - Follow Up - Leads Type -->
                                        <v-select
                                        v-model="form.leadsType"
                                        :items="masterData.leadsType"
                                        item-text="name"
                                        item-value="id"
                                        label="Leads Type"
                                        placeholder="All"
                                        multiple
                                        hint=""
                                        persistent-hint
                                        clearable
                                        :error-messages="errors.collect('Leads Type')"
                                        data-vv-name="Leads Type"
                                        ></v-select>

                                        <!-- Leads - Follow Up - Event Year -->
                                        <v-select
                                        @change="selectEventYear"
                                        v-model="form.eventYear"
                                        :items="masterData.year"
                                        item-text="name"
                                        item-value="id"
                                        label="Event Year"
                                        placeholder="All"
                                        multiple
                                        hint=""
                                        persistent-hint
                                        clearable
                                        :error-messages="errors.collect('Event Year')"
                                        data-vv-name="Event Year"
                                        ></v-select>

                                        <!-- Leads - Follow Up - Name of Event -->
                                        <v-select
                                        @change="selectNameOfEvent"
                                        v-model="form.nameOfEvent"
                                        :items="masterData.event"
                                        item-text="name"
                                        item-value="name"
                                        label="Name of Event"
                                        placeholder="All"
                                        multiple
                                        hint=""
                                        persistent-hint
                                        clearable
                                        :error-messages="errors.collect('Name of Event')"
                                        data-vv-name="Name of Event"
                                        ></v-select>

                                        <!-- Leads - Follow Up - Booth Visited -->
                                        <v-autocomplete
                                        v-model="form.boothVisited"
                                        :items="masterData.booth"
                                        item-text="name"
                                        item-value="name"
                                        label="Booth Visited"
                                        placeholder="All"
                                        multiple
                                        hint=""
                                        persistent-hint
                                        clearable
                                        :error-messages="errors.collect('Booth Visited')"
                                        data-vv-name="Booth Visited"
                                        :disabled="form.nameOfEvent == ''"
                                        ></v-autocomplete>

                                        <!-- Leads - Follow Up - Marketing Source -->
                                        <v-select
                                        v-model="form.marketingSource"
                                        :items="masterData.marketingSource"
                                        item-text="name"
                                        item-value="name"
                                        label="Marketing Source"
                                        placeholder="All"
                                        multiple
                                        hint=""
                                        persistent-hint
                                        clearable
                                        :error-messages="errors.collect('Marketing Source')"
                                        data-vv-name="Marketing Source"
                                        ></v-select>

                                        <!-- Leads - Follow Up - Visit SUN -->
                                        <v-select
                                        v-model="form.visitSUN"
                                        :items="masterData.yesOrNo"
                                        item-text="name"
                                        item-value="name"
                                        label="Visit SUN"
                                        placeholder="All"
                                        hint=""
                                        persistent-hint
                                        clearable
                                        :error-messages="errors.collect('Visit SUN')"
                                        data-vv-name="Visit SUN"
                                        ></v-select>
                                    </v-card-text>
                                    <br>
                                    <hr class="v-divider theme--light">
                                    <br>
                                <!-- Leads - Follow Up - Leads Type .End -->

                                <!-- Leads - Follow Up - Scholarship Seeker .Start-->
                                    <!-- <div class="title font-weight-regular justify-space-between">
                                        Scholarship Seeker
                                    </div> -->
                                    <v-card-text :style="{ paddingTop: '0px' }">
                                        <!-- Leads - Follow Up - Scholarship Seeker -->
                                        <v-select
                                            v-model="form.scholarshipSeeker"
                                            :items="masterData.yesOrNo"
                                            label="Scholarship Seeker"
                                            placeholder="All"
                                            hint=""
                                            persistent-hint
                                            clearable
                                            :error-messages="errors.collect('Scholarship Seeker')"
                                            data-vv-name="Scholarship Seeker"
                                        ></v-select>
                                    </v-card-text>
                                    <br>
                                    <hr class="v-divider theme--light">
                                    <br>

                                <!-- </v-card-text> -->

                                <!-- <div class="title font-weight-regular justify-space-between">
                                    Parent's Name
                                </div> -->
                                <!-- <v-card-text :style="{ paddingTop: '0px' }"> -->
                                    <!-- Leads - SAP - Parent's Name -->
                                    <!-- <v-autocomplete
                                    v-model="form.parentsName"
                                    :items="masterData.parentsName"
                                    item-text="name"
                                    item-value="id"
                                    label="Parent's Name"
                                    placeholder="All"
                                    multiple
                                    hint=""
                                    persistent-hint
                                    clearable
                                    :error-messages="errors.collect('Parents Name')"
                                    data-vv-name="Parent's Name"
                                    :allow-overflow="false"
                                    ></v-autocomplete> -->
                                <!-- </v-card-text> -->
                            </div>
                            <!-- Leads - Follow Up . End-->
                        </div>
                        <!-- Leads .End -->

                        <!-- Staff .Start -->
                        <div v-if="form.targetProfile == 'Staff'">
                            <hr class="v-divider theme--light" v-if="form.targetProfile == 'Staff'">
                            <!-- <div v-if="form.targetProfile == 'Branch'"> -->
                                <!-- Leads - SAP - Branch -->
                                <!-- <div class="title font-weight-regular justify-space-between">
                                    Branch
                                </div> -->
                                <v-card-text>
                                    <v-autocomplete
                                        v-model="form.branch"
                                        :items="masterData.branch"
                                        item-text="name"
                                        item-value="id"
                                        label="Branch"
                                        placeholder="All"
                                        multiple
                                        hint=""
                                        persistent-hint
                                        clearable
                                        :error-messages="errors.collect('Branch')"
                                        data-vv-name="Branch"
                                    ></v-autocomplete>
                                </v-card-text>
                            <!-- </div> -->
                            <!-- <div v-if="form.typeStaff == 'Role'"> -->
                                <!-- Leads - SAP - Branch -->
                                <!-- <div class="title font-weight-regular justify-space-between">
                                    Role
                                </div> -->
                                <v-card-text :style="{ paddingTop: '0px' }">
                                    <v-select
                                        v-model="form.role"
                                        :items="masterData.role"
                                        item-text="name"
                                        item-value="id"
                                        label="Role"
                                        placeholder="All"
                                        multiple
                                        hint=""
                                        persistent-hint
                                        clearable
                                        :error-messages="errors.collect('Role')"
                                        data-vv-name="Role"
                                    ></v-select>
                                </v-card-text>
                            <!-- </div> -->
                        </div>
                        <!-- Staff .End -->

                        <!-- Event .Start -->
                        <div v-if="form.targetProfile == 'Event'">
                            <hr class="v-divider theme--light">
                            <div v-if="form.targetProfile == 'Event'">
                                <!-- <div class="title font-weight-regular justify-space-between">
                                    Event
                                </div> -->
                                <v-card-text>
                                    <!-- Event - Event Year -->
                                    <v-select
                                    @change="selectEventYear"
                                    v-model="form.eventYear"
                                    :items="masterData.year"
                                    item-text="name"
                                    item-value="id"
                                    label="Event Year"
                                    placeholder="All"
                                    multiple
                                    hint=""
                                    persistent-hint
                                    clearable
                                    :error-messages="errors.collect('Event Year')"
                                    data-vv-name="Event Year"
                                    ></v-select>

                                    <!-- Event - Name of Event -->
                                    <!-- <v-select
                                    v-model="form.nameOfEvent"
                                    :items="masterData.event"
                                    item-text="name"
                                    item-value="name"
                                    label="Name of Event"
                                    placeholder="All"
                                    multiple
                                    hint=""
                                    persistent-hint
                                    clearable
                                    :error-messages="errors.collect('Name of Event')"
                                    data-vv-name="Name of Event"
                                    ></v-select> -->

                                    <v-autocomplete
                                        @change="selectNameOfEvent"
                                        v-model="form.nameOfEvent"
                                        :items="masterData.event"
                                        item-text="name"
                                        item-value="id"
                                        label="Name of Event"
                                        placeholder="All"
                                        multiple
                                        hint=""
                                        persistent-hint
                                        clearable
                                        :error-messages="errors.collect('Name of Event')"
                                        data-vv-name="Name of Event"
                                    ></v-autocomplete>

                                    <!-- Event - Booth Visited -->
                                    <v-autocomplete
                                    v-model="form.boothVisited"
                                    :items="masterData.booth"
                                    item-text="name"
                                    item-value="name"
                                    label="Booth Visited"
                                    placeholder="All"
                                    multiple
                                    hint=""
                                    persistent-hint
                                    clearable
                                    :error-messages="errors.collect('Booth Visited')"
                                    data-vv-name="Booth Visited"
                                    :disabled="form.nameOfEvent == ''"
                                    ></v-autocomplete>

                                    <!-- Event - Marketing Source -->
                                    <v-autocomplete
                                    v-model="form.marketingSource"
                                    :items="masterData.marketingSource"
                                    item-text="name"
                                    item-value="name"
                                    label="Marketing Source"
                                    placeholder="All"
                                    multiple
                                    hint=""
                                    persistent-hint
                                    clearable
                                    :error-messages="errors.collect('Marketing Source')"
                                    data-vv-name="Marketing Source"
                                    ></v-autocomplete>
                                </v-card-text>
                            </div>
                        </div>
                        <!-- Event .End -->

                        <!-- Institution .Start -->
                        <div v-if="form.targetProfile == 'Institution'">
                            <hr class="v-divider theme--light">
                            <div v-if="form.targetProfile == 'Institution'">
                                <!-- <div class="title font-weight-regular justify-space-between">
                                    Institution
                                </div> -->
                                <v-card-text>
                                    <!-- Institution - Country MD -->
                                    <!-- <v-autocomplete
                                    @change="selectCountryInstitution"
                                    v-model="form.countryMD"
                                    :items="masterData.countryMD"
                                    item-text="name"
                                    item-value="id"
                                    label="Country"
                                    placeholder="All"
                                    multiple
                                    hint=""
                                    persistent-hint
                                    clearable
                                    :error-messages="errors.collect('Country')"
                                    data-vv-name="Country"
                                    ></v-autocomplete> -->

                                    <!-- Institution - Type -->
                                    <v-select
                                    v-model="form.contactType"
                                    :items="masterData.contactType"
                                    label="Type"
                                    placeholder="Select one"
                                    hint=""
                                    persistent-hint
                                    clearable
                                    required
                                    :error-messages="errors.collect('Type')"
                                    data-vv-name="Type"
                                    ></v-select>

                                    <!-- Institution - Group Institution -->
                                    <v-autocomplete
                                    v-if="form.contactType == 'Group'"
                                    v-model="form.institutionGroupMD"
                                    :items="masterData.institutionGroupMD"
                                    item-text="name"
                                    item-value="id"
                                    label="Group Name"
                                    placeholder="All"
                                    multiple
                                    hint=""
                                    persistent-hint
                                    clearable
                                    required
                                    :error-messages="errors.collect('Group Name')"
                                    data-vv-name="Group Name"
                                    ></v-autocomplete>

                                    <!-- Institution - Main Institution -->
                                    <v-autocomplete
                                    v-if="form.contactType == 'Institution'"
                                    v-model="form.institutionMD"
                                    :items="masterData.institutionMD"
                                    item-text="name"
                                    item-value="id"
                                    label="Institution Name"
                                    placeholder="All"
                                    multiple
                                    hint=""
                                    persistent-hint
                                    clearable
                                    required
                                    :error-messages="errors.collect('Institution Name')"
                                    data-vv-name="Institution Name"
                                    ></v-autocomplete>
                                </v-card-text>
                            </div>
                        </div>
                        <!-- Institution .End -->

                        <!-- Parents .Start -->
                        <div v-if="form.targetProfile == 'Parents'">
                            <hr class="v-divider theme--light">
                            <div v-if="form.targetProfile == 'Parents'">
                                <!-- <div class="title font-weight-regular justify-space-between">
                                    Parents
                                </div> -->
                                <v-card-text>
                                    <!-- Parents - Student Name -->
                                    <v-autocomplete
                                    @keyup="searchStudentName($event.target.value)"
                                    v-model="form.studentName"
                                    :items="masterData.studentName"
                                    item-text="name"
                                    item-value="id"
                                    label="Student Name"
                                    placeholder="All"
                                    multiple
                                    hint=""
                                    persistent-hint
                                    clearable
                                    hide-no-data
                                    :error-messages="errors.collect('Student Name')"
                                    data-vv-name="Student Name"
                                    ></v-autocomplete>
                                </v-card-text>
                            </div>
                        </div>
                        <!-- Parents .End -->

                        <hr class="v-divider theme--light" v-if="isChecked">
                        <!-- <v-card-text>
                            <v-layout align-center justify-start fill-height>
                              <span>
                                Email Count:
                              </span>
                              <span>
                                <div v-if="loading" style="margin-left: 10px; padding-top: 6px">
                                  <scale-loader :loading="true" :color="'rgb(93, 197, 150)'" :height="'15px'"></scale-loader>
                                </div>
                                <div v-else style="margin-left: 10px;">
                                  {{ count.total }}
                                </div>
                              </span>
                            </v-layout>
                        </v-card-text> -->
                        <hr class="v-divider theme--light" v-if="isChecked">

                        <v-card-text>
                          <div :style="{ position: 'fixed', bottom: '60px', left: 0, padding: '10px', paddingLeft: '50px', background: '#eee', width: '100%'}">
                            <span>
                              <div v-if="loading" style="margin-left: 10px; padding-top: 6px">
                                <scale-loader :loading="true" :color="'rgb(93, 197, 150)'" :height="'15px'"></scale-loader>
                              </div>
                              <div v-else style="margin-left: 10px;">
                                Email Count: {{ count.total }}
                              </div>
                            </span>
                          </div>
                        </v-card-text>
                        <v-card-text>
                          <div :style="{ position: 'fixed', bottom: 0, left: 0, padding: '10px', paddingLeft: '50px', background: 'rgb(250, 250, 250)', width: '100%'}">
                            <v-btn depressed small :color="'info'" @click="submit('check')">Check</v-btn>
                            <!-- <v-btn depressed small v-if="isChecked == true" @click="submit('import')" disabled>Submit</v-btn> -->
                            <v-btn depressed small :color="'warning'" @click="submit('validate')">Validate</v-btn>
                            <!-- <v-btn depressed small @click="submit('import')">Import</v-btn> -->
                            <v-btn depressed small @click="reset">Reset</v-btn>
                            <!-- <div v-for="(index, data) in pusher" :key="index">
                                {{pusher}}<br><br><br>
                            </div> -->
                          </div>
                        </v-card-text>
                    </v-form>

                    <!-- <v-simple-table>
                        <thead>
                            <tr>
                                <th class="text-left">Name</th>
                                <th class="text-left">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(index, pusherResponse) in pusherResponses" :key="index" >
                                <td>{{ pusherResponse.name }}</td>
                                <td>{{ pusherResponse.email }}</td>
                            </tr>
                        </tbody>
                    </v-simple-table> -->
                </v-card-text>
                <!-- </v-card> -->
            </v-flex>
            </v-layout>
        </v-container>
        </v-content>
    </v-app>
    <v-app v-else class="mt-5">
        <v-flex>
        <v-layout>
            <v-container>
                <v-content>
                    <!-- <v-layout v-if="showFinishImport" justify-space-between>
                        <v-flex xs12 md6>
                        <div role="alert" class="v-alert mb-4 v-sheet theme--dark success" null="true">
                            <div class="v-alert__wrapper"><i aria-hidden="true" class="v-icon notranslate v-alert__icon mdi mdi-check-circle theme--dark"></i>
                            <div class="v-alert__content">
                                Success
                            </div>
                            </div>
                        </div>
                        </v-flex>
                    </v-layout> -->
                    <v-layout justify-space-between>
                        <v-flex xs6 md2>
                            <!-- <v-progress-circular
                            :size="30"
                            color="primary"
                            indeterminate
                            ></v-progress-circular> -->
                            {{ results[0].percentage }}%
                        </v-flex>
                        <v-flex xs6 md2>
                            Remaining: {{ results[0].count.total - results[0].count.ok - results[0].count.fail - results[0].count.unknown }}
                        </v-flex>
                        <v-flex xs6 md2>
                            Total: {{ results[0].count.total }}
                        </v-flex>
                        <v-flex xs6 md2>
                            Ok: {{ results[0].count.ok }}
                        </v-flex>
                        <v-flex xs6 md2>
                            Fail: {{ results[0].count.fail }}
                        </v-flex>
                        <v-flex xs6 md2>
                            Unkown: {{ results[0].count.unknown }}
                        </v-flex>
                        <!-- <v-flex xs6 md2>
                            <v-btn depressed small @click="submit('check')">Check</v-btn>
                        </v-flex> -->
                    </v-layout>
                    <hr class="v-divider theme--light">
                    <div class="v-data-table theme--light">
                        <div class="v-data-table__wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th style="text-align: left">Name</th>
                                        <th style="text-align: left">Email</th>
                                        <th style="text-align: left">Email Status</th>
                                        <th style="text-align: left">Manual Import</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(data, index) in results" :key="index">
                                        <td class="text-left">{{ data.name }}</td>
                                        <td class="text-left">{{ data.email }}</td>
                                        <td class="text-left">
                                            <template v-if="data.status == 'ok'">
                                                <v-icon :color="'success'" center>check_circle</v-icon>
                                            </template>
                                            <template v-if="data.status == 'fail'">
                                                <v-icon :color="'danger'" center>block</v-icon>
                                            </template>
                                            <template v-if="data.status == 'unknown'">
                                                <v-icon :color="'danger'" center>block</v-icon>
                                            </template>
                                        </td>
                                        <td class="text-left">
                                                <v-btn @click="forceImportEmail(data)" text icon color="green" small>
                                                    <v-icon v-if="data.is_forced == false" :color="'success'" center>check_circle</v-icon>
                                                    <v-icon v-else>mdi-plus</v-icon>
                                                </v-btn>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <v-form v-if="!isValidate" ref="form" v-model="isValid" lazy-validation>
                        <v-btn depressed small :color="'warning'" @click="submit('validate')">Validate</v-btn>
                        <v-btn depressed small :color="'success'" @click="submit('import')">Import</v-btn>
                        <v-btn depressed small @click="reset">Reset</v-btn>
                    </v-form> -->

                    <v-card-text>
                        <div :style="{ position: 'fixed', bottom: 0, left: 0, padding: '10px', paddingLeft: '50px', background: 'rgb(250, 250, 250)', width: '100%'}">
                        <!-- <v-btn depressed small :color="'info'" @click="submit('check')">Check</v-btn> -->
                        <!-- <v-btn depressed small :color="'warning'" @click="submit('validate')">Validate</v-btn> -->
                        <!-- <v-btn depressed small @click="reset">Reset</v-btn> -->

                        <!-- <v-btn depressed small :color="'warning'" @click="submit('validate')">Validate</v-btn> -->
                        <v-btn depressed small :color="'success'" @click="submit('import')">Import</v-btn>
                        <v-btn depressed small @click="reset">Reset</v-btn>
                        </div>
                    </v-card-text>

                    <v-snackbar v-model="snackbar">
                        {{ snackbarText }}
                    </v-snackbar>
                </v-content>
            </v-container>
        </v-layout>
        </v-flex>
    </v-app>
</template>

<script>
  export default {
    $_veeValidate: {
      validator: 'new'
    },
    props: {
      source: String,
      list_uid: '',
      public_key: '',
      private_key: '',
    },
    data(){
      return {
        snackbar: true,
        snackbarText: '',
        showFinishImport: false,
        results: [{
            name: '',
            email: '',
            status: '',
            count: {
                total: 0,
                ok: 0,
                fail: 0,
                unknown: 0,
            },
            is_forced: false,
        }],
        showResults: false,
        pusher: false,
        pusherResponse: [],
        loading: true,
        isValid: '',
        isChecked: false,
        count: {
            total: 0,
            ok: 0,
            fail: 0,
            unknown: 0,
        },
        form:{
          list_uid: this.list_uid,
          public_key: this.public_key,
          private_key: this.private_key,
          targetProfile: [],
          typeLeads: '',
          typeStaff: '',
          branch: [],
          SAPStatus: [],
          country: [],
          mainInstitution: [],
          startOfMainProgramMonth: '',
          startOfMainProgramYear: '',
          endOfProgramMonth: '',
          endOfProgramYear: '',
          schoolOfOrigin: [],
          currentYearOfStudy: [],
          programStudy: [],
          studyClassification: [],
          studySector: [],
          eventYear: [],
          nameOfEvent: [],
          marketingSource: [],
          scholarshipSeeker: [],
          applicationType: [],
          counselor: [],
          status: [],
          planningYear: [],
          majorInterested: [],
          destinationOfStudy: [],
          programInterested: [],
          schoolOfOrigin: [],
          currentYearOfStudy: [],
          leadsType: [],
          eventYear: [],
          nameOfEvent: [],
          boothVisited: [],
          visitSUN: [],
          status: [],
          highestEdu: [],
          formType: '', // check or submit
          countryMD: [],
          institutionGroupMD: [],
          institutionMD: [],
          parentsName: [],
          studentName: [],
          contactType: '',
        },
        rules:{
          required: [
            v => !!v || 'Name is required',
            v => (v && v.length <= 10) || 'Name must be less than 10 characters'
          ],
          name: '',
          nameRules: [
            v => !!v || 'Name is required',
            v => (v && v.length <= 10) || 'Name must be less than 10 characters'
          ],
          email: '',
          emailRules: [
            v => !!v || 'E-mail is required',
            v => /.+@.+/.test(v) || 'E-mail must be valid'
          ],
          select: null,
          items: [
            'Item 1',
            'Item 2',
            'Item 3',
            'Item 4'
          ],
          checkbox: false
        },

        // All Master Data
        masterData:{
          targetProfile: ['Leads','Staff','Event','Institution','Parents'],
          typeLeads: ['SAP','Follow Up'],
          typeStaff: ['Role','Branch'],
          branch: [{
            id: '',
            name: '',
          }],
          SAPStatus: [
            {
              id: 'A',
              name: 'Apply'
            },
            {
              id: 'CLO',
              name: 'CLO'
            },
            {
              id: 'FLO',
              name: 'FLO'
            },
            {
              id: 'Paid',
              name: 'Paid'
            },
            {
              id: 'Visa',
              name: 'Visa'
            },
            {
              id: 'Goal',
              name: 'Goal'
            }
          ],
          followUpStatus: [
            {
                id: 'UNHANDLED',
                name: 'Unhandled',
            },
            {
                id: 'HP',
                name: 'Hot Prospect',
            },
            {
                id: 'P',
                name: 'Prospect',
            },
            {
                id: 'FP',
                name: 'Future Prospect',
            },
            {
                id: 'NP',
                name: 'Not Prospect',
            },
            {
                id: 'APPLY',
                name: 'Apply',
            },
            // {
            //     id: 'IP',
            //     name: 'In Progress',
            // },
            // {
            //     id: 'GOAL',
            //     name: 'Goal',
            // },
            // {
            //     id: 'CANCEL',
            //     name: 'Cancel',
            // },
            // {
            //     id: 'PAID',
            //     name: 'Paid',
            // },
            // {
            //     id: 'VISA',
            //     name: 'Visa',
            // },
          ],
          country:[],
          institution: [{
            id: '',
            name: '',
          }],
          month: [
            {
              id: '01',
              name: 'January',
            },
            {
              id: '02',
              name: 'February',
            },
            {
              id: '03',
              name: 'March',
            },
            {
              id: '04',
              name: 'April',
            },
            {
              id: '05',
              name: 'May',
            },
            {
              id: '06',
              name: 'June',
            },
            {
              id: '07',
              name: 'July',
            },
            {
              id: '08',
              name: 'August',
            },
            {
              id: '09',
              name: 'September',
            },
            {
              id: '10',
              name: 'October',
            },
            {
              id: '11',
              name: 'November',
            },
            {
              id: '12',
              name: 'December',
            },
          ],
          year: ['2017','2018','2019','2020','2021','2022','2023','2024','2025'],
          school:[],
          programStudy:[],
          studyClassification: [{
            id: '',
            name: '',
          }],
          studySector: [{
            id: '',
            name: '',
          }],
          event: [{
            id: '',
            name: '',
          }],
          marketingSource: [{
            id: '',
            name: '',
          }],
          counselor: [{
            id: '',
            name: '',
          }],
          majorInterested: [{
            id: '',
            name: '',
          }],
          destinationOfStudy: [{
            id: '',
            name: '',
          }],
          programInterested:[],
          highestEdu:[],
          applicationType: [ 'Self-funded', 'Scholarship', 'VIP'],
          yesOrNo: ['Yes','No'],
          contactType: ['Group','Institution'],
          countryMD: [{
            id: '',
            name: '',
          }],
          institutionGroupMD: [{
            id: '',
            name: '',
          }],
          institutionMD: [{
            id: '',
            name: '',
          }],
          leadsType: [
            {
              id: 'call-in',
              name: 'Call In'
            },
            {
              id: 'walk-in',
              name: 'Walk In'
            },
            {
              id: 'reference',
              name: 'Reference'
            },
            {
              id: 'web',
              name: 'Web Site / Digital Marketing'
            },
          ],
          booth: [{
            id: '',
            name: '',
          }],
          parentsName: [{
            id: '',
            name: '',
          }],
          studentName: [{
            id: '',
            name: '',
          }],
        },

        isValidate: false,
        activeForm: '',
      }
    },
    created(){
    //   alert(this.list_uid)
      this.init()

    },
    // ready () {
    //     var channel = this.$pusher.subscribe('dashboard');

    //     channel.bind('user.log', ({ log }) => {
    //         console.log(`User ${log.user.name} has ${log.action} at ${log.time}`);
    //     });
    // },
    mounted(){
      // alert(this.list_uid)
      var self = this

      this.$nextTick(() => {
          setTimeout(function(){
              console.log(self.masterData)
              self.loading = false
          }, 1000);
      });


        // Work, Disabled Temporary
        // var self = this
        var channel = this.$pusher.subscribe('my-channel');

        channel.bind('my-event-' + self.list_uid, function(response) {
            self.results.unshift(response)
            console.log(response)
            // self.showResults = true
            self.pusher = true
            // self.pusherResponses = response
            self.pusherResponse = response
            // self.$notify({
            //     group: 'defaultNotication',
            //     name: response.name,
            //     email: response.email,
            //     status: response.status,
            //     count: response.count,
            //     duration: 60000,
            //     speed: 500,
            //     // data: response.data,
            // });


            if(self.activeForm == 'validate'){
              if(response.is_done == true){
              console.log(self.activeForm)
              console.log('self.activeFormFalse')
                self.isValidate = false
              } else {
              console.log(self.activeForm)
              console.log('self.activeFormTtrue')
                self.isValidate = true
              }
            }

            if(response.is_done == true){
                console.log(response)
                // location.reload();
                // parent.location.reload();
            }
            if(response.import == true){
              self.showFinishImport = true
            //     console.log(response)
            //     alert('import')
            //     // location.reload();
            //     // parent.location.reload();
            }


            // this is called when the event notification is received...
        });
        // / End. Work, Disabled Temporary
    },
    methods: {
      init(){
        var self = this
        axios.get('data/branch-sunnies')
        .then(response => {
          self.masterData.branch = response.data
        }).catch(error => {
          console.log(error)
          this.errored = true
        })

        axios.get('data/highest-edu')
        .then(response => {
          self.masterData.highestEdu = response.data
          console.log(self.masterData.highestEdu)
        }).catch(error => {
          console.log(error)
          this.errored = true
        })

        axios.get('data/precur-school')
        .then(response => {
          self.masterData.precurSchool = response.data.precurSchool
        }).catch(error => {
          console.log(error)
          this.errored = true
        })

        axios.get('data/destination-study')
        .then(response => {
          self.masterData.destinationOfStudy = response.data
        }).catch(error => {
          console.log(error)
          this.errored = true
        })

        axios.get('data/program-interested')
        .then(response => {
          self.masterData.programInterested = response.data.programInterested
        }).catch(error => {
          console.log(error)
          this.errored = true
        })

        axios.get('data/marketing-source')
        .then(response => {
          self.masterData.marketingSource = response.data
        }).catch(error => {
          console.log(error)
          this.errored = true
        })

        axios.get('data/school')
        .then(response => {
          self.masterData.school = response.data
        }).catch(error => {
          console.log(error)
          this.errored = true
        })

        axios.get('data/institution')
        .then(response => {
          self.masterData.institution = response.data
        }).catch(error => {
          console.log(error)
          this.errored = true
        })

        axios.get('data/program-study')
        .then(response => {
          self.masterData.programStudy = response.data
        }).catch(error => {
          console.log(error)
          this.errored = true
        })

        axios.get('data/study-classification')
        .then(response => {
          self.masterData.studyClassification = response.data
        }).catch(error => {
          console.log(error)
          this.errored = true
        })

        axios.get('data/study-sector')
        .then(response => {
          self.masterData.studySector = response.data
        }).catch(error => {
          console.log(error)
          this.errored = true
        })

        axios.get('data/event')
        .then(response => {
          self.masterData.event = response.data
        }).catch(error => {
          console.log(error)
          this.errored = true
        })

        axios.get('data/counselor')
        .then(response => {
          self.masterData.counselor = response.data.counselor
        }).catch(error => {
          console.log(error)
          this.errored = true
        })

        axios.get('data/major-interested')
        .then(response => {
          self.masterData.majorInterested = response.data.majorInterested
        }).catch(error => {
          console.log(error)
          this.errored = true
        })

        axios.get('data/role-sunnies')
        .then(response => {
          self.masterData.role = response.data
        }).catch(error => {
          console.log(error)
          this.errored = true
        })

        axios.get('data/country-md')
        .then(response => {
          self.masterData.countryMD = response.data
        }).catch(error => {
          console.log(error)
          this.errored = true
        })

        axios.get('data/institution-group-md')
        .then(response => {
          self.masterData.institutionGroupMD = response.data
        }).catch(error => {
          console.log(error)
          this.errored = true
        })

        axios.get('data/institution-md')
        .then(response => {
          self.masterData.institutionMD = response.data
        }).catch(error => {
          console.log(error)
          this.errored = true
        })

        // axios.post('data/student-name')
        // .then(response => {
        //   self.masterData.studentName = response.data
        // }).catch(error => {
        //   console.log(error)
        //   this.errored = true
        // })
        this.masterData.studentName = []
      },
      forceImportEmail(data){
        var self = this;
        axios.post('mailapp/importEmail', {
            list_uid: self.list_uid,
            public_key: self.public_key,
            private_key: self.private_key,
            email: data.email,
            full_name: data.name,
        }).then(response => {
            self.snackbarText = data.email + ' has been successfully imported';
            self.snackbar = true;
        }).catch(error => {
            console.log(error)
            this.errored = true
        });
      },
      selectTargetProfile(){
          this.init()
          this.form.typeLeads = ''
          this.form.typeStaff = ''
          this.form.branch = []
          this.form.SAPStatus = []
          this.form.country = []
          this.form.mainInstitution = []
          this.form.startOfMainProgramMonth = ''
          this.form.startOfMainProgramYear = ''
          this.form.endOfProgramMonth = ''
          this.form.endOfProgramYear = ''
          this.form.schoolOfOrigin = []
          this.form.currentYearOfStudy = []
          this.form.programStudy = []
          this.form.studyClassification = []
          this.form.studySector = []
          this.form.eventYear = []
          this.form.nameOfEvent = []
          this.form.marketingSource = []
          this.form.scholarshipSeeker = []
          this.form.applicationType = []
          this.form.counselor = []
          this.form.status = []
          this.form.planningYear = []
          this.form.majorInterested = []
          this.form.destinationOfStudy = []
          this.form.programInterested = []
          this.form.schoolOfOrigin = []
          this.form.currentYearOfStudy = []
          this.form.leadsType = []
          this.form.eventYear = []
          this.form.nameOfEvent = []
          this.form.boothVisited = []
          this.form.visitSUN = []
          this.form.status = []
          this.form.highestEdu = []
      },
      selectTypeStaff(){
          this.form.typeLeads = ''
        //   this.form.typeStaff = ''
          this.form.branch = []
          this.form.SAPStatus = []
          this.form.country = []
          this.form.mainInstitution = []
          this.form.startOfMainProgramMonth = ''
          this.form.startOfMainProgramYear = ''
          this.form.endOfProgramMonth = ''
          this.form.endOfProgramYear = ''
          this.form.schoolOfOrigin = []
          this.form.currentYearOfStudy = []
          this.form.programStudy = []
          this.form.studyClassification = []
          this.form.studySector = []
          this.form.eventYear = []
          this.form.nameOfEvent = []
          this.form.marketingSource = []
          this.form.scholarshipSeeker = []
          this.form.applicationType = []
          this.form.counselor = []
          this.form.status = []
          this.form.planningYear = []
          this.form.majorInterested = []
          this.form.destinationOfStudy = []
          this.form.programInterested = []
          this.form.schoolOfOrigin = []
          this.form.currentYearOfStudy = []
          this.form.leadsType = []
          this.form.eventYear = []
          this.form.nameOfEvent = []
          this.form.boothVisited = []
          this.form.visitSUN = []
          this.form.status = []
          this.form.highestEdu = []
      },
      selectNameOfEvent(){
        var self = this
        axios.post('data/booth',{
          nameOfEvent: self.form.nameOfEvent
        }).then(response => {
          self.masterData.booth = response.data
        }).catch(error => {
          console.log(error)
          this.errored = true
        })
      },
      selectEventYear(){
        var self = this
        axios.post('data/event',{
          eventYear: self.form.eventYear
        }).then(response => {
          self.masterData.event = response.data
        }).catch(error => {
          console.log(error)
          this.errored = true
        })
      },
      selectCountry(){
        var self = this
        axios.post('data/institution',{
          destinationOfStudy: self.form.country
        }).then(response => {
          self.masterData.institution = response.data
        }).catch(error => {
          console.log(error)
          this.errored = true
        })
      },
      selectCountryInstitution(){
        var self = this
        axios.post('data/institution-md',{
          countryMD: self.form.countryMD
        }).then(response => {
          self.masterData.institutionMD = response.data
        }).catch(error => {
          console.log(error)
          this.errored = true
        })
      },
      selectBranchFollowUp(){
          var self = this
          if(this.form.branch != '' && this.form.branch != null){
            axios.post('data/counselor', {
                branch_ids: self.form.branch
            })
            .then(response => {
                self.masterData.counselor = response.data
            }).catch(error => {
                console.log(error)
                this.errored = true
            })
          } else {
              this.masterData.counselor = []
          }
      },
      searchSchool(q){
        var self = this
        axios.post('data/school',{ q }).then(response => {
          self.masterData.school = response.data
        }).catch(error => {
          console.log(error)
          this.errored = true
        })
      },
      searchInstitution(q){
        var self = this
        axios.post('data/institution',{
          destinationOfStudy: self.form.country,
          q: q,
        }).then(response => {
          self.masterData.institution = response.data
        }).catch(error => {
          console.log(error)
          this.errored = true
        })
      },
      searchStudentName(q){
        var self = this
        axios.post('data/student-name',{
          studentName: self.form.studentName,
          q: q,
        }).then(response => {
          self.masterData.studentName = response.data
        }).catch(error => {
          console.log(error)
          this.errored = true
        })
      },
      customValidateMainProgram(type){
        if(type == 'startOfMainProgramMonth'){
          if(this.form.startOfMainProgramYear != null && this.form.startOfMainProgramYear != ''){
            return 'required';
          }
          if(this.form.endOfMainProgramMonth != null && this.form.endOfMainProgramMonth != ''){
            return 'required';
          }
          if(this.form.endOfMainProgramYear != null && this.form.endOfMainProgramYear != ''){
            return 'required';
          }
        }
        if(type == 'startOfMainProgramYear'){
          if(this.form.startOfMainProgramMonth != null && this.form.startOfMainProgramMonth != ''){
            return 'required';
          }
          if(this.form.endOfMainProgramMonth != null && this.form.endOfMainProgramMonth != ''){
            return 'required';
          }
          if(this.form.endOfMainProgramYear != null && this.form.endOfMainProgramYear != ''){
            return 'required';
          }
        }
        if(type == 'endOfMainProgramMonth'){
          if(this.form.startOfMainProgramMonth != null && this.form.startOfMainProgramMonth != ''){
            return 'required';
          }
          if(this.form.startOfMainProgramYear != null && this.form.startOfMainProgramYear != ''){
            return 'required';
          }
          if(this.form.endOfMainProgramYear != null && this.form.endOfMainProgramYear != ''){
            return 'required';
          }
        }
        if(type == 'endOfMainProgramYear'){
          if(this.form.startOfMainProgramMonth != null && this.form.startOfMainProgramMonth != ''){
            return 'required';
          }
          if(this.form.startOfMainProgramYear != null && this.form.startOfMainProgramYear != ''){
            return 'required';
          }
          if(this.form.endOfMainProgramMonth != null && this.form.endOfMainProgramMonth != ''){
            return 'required';
          }
        }

        return ''
      },

    //   check(){
    //     this.loading = true
    //     var self = this
    //     // this.form.list_uid = this.list_uid
    //     this.$validator.validateAll().then((result) => {
    //       if (result) {
    //         axios.post('mailapp/check', self.form)
    //         .then(response => {
    //           self.count = response.data.count
    //           this.isChecked = true
    //         }).catch(error => {
    //           this.isChecked = false
    //           console.log(error)
    //           this.errored = true
    //         }).finally(function () {
    //           self.loading = false
    //         });
    //       } else {
    //           self.loading = false
    //       }
    //       if(!result){
    //         console.log('Oops!');
    //       }
    //     });
    //   },
      submit(formType){
        // this.results = [{
        //     name: '',
        //     email: '',
        //     status: '',
        //     count:{
        //         total: 0,
        //         ok: 0,
        //         fail: 0,
        //         unknown: 0,
        //     },
        //     percentage: 0,
        //     is_done: false,
        // }]

        this.results = []

        this.form.formType = formType
        this.loading = true
        var self = this
        // this.form.list_uid = this.list_uid
        this.$validator.validateAll().then((result) => {
          if (result) {
            if(formType == 'import' || formType == 'validate'){
                this.showResults = true
            }

            this.activeForm = formType

            if(formType == 'validate'){
              this.isValidate = false
            }

            axios.post('mailapp/submit', self.form)
            .then(response => {
                console.log('responssse')
                console.log(response)
              self.count = response.data.count
              this.isChecked = true
            }).catch(error => {
              this.isChecked = false
              console.log(error)
              this.errored = true
            }).finally(function () {
              self.loading = false
            });
          } else {
              self.loading = false
          }
          if(!result){
            console.log('Oops!');
          }
        });
      },
      reset(){
        this.showResults = false
        this.$refs.form.reset()
        this.$nextTick(() => {
            this.errors.clear()
            this.isChecked = false
        })
        this.count.total = 0
      },
      resetValidation () {
        this.$refs.form.resetValidation()
      },
    },
    watch:{
      // list_uid(list_uid){
      //   alert(list_uid)
      // }
    }
  }
</script>

<style>
.theme--light {
  background: #ffffff !important;
}
</style>
