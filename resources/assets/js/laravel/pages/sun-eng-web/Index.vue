<template>
	<router-view></router-view>
</template>

<style>
@media only screen and (max-width: 760px) {
	.button-container {
		bottom: 235px;
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
	export default {
		name: 'SunEngWeb',
		metaInfo: {
			title: 'Sun English Web!'
		}
	}
</script>
