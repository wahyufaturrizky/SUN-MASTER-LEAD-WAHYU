import Vue from 'vue'
import Vuex from 'vuex'
import firstForm from './modules/firstForm'
import secondForm from './modules/secondForm'
import VuexPersistence from 'vuex-persist'
import createPromise from 'vuex-promise'

Vue.use(Vuex)

const vuexLocal = new VuexPersistence({
	storage: window.localStorage
})

export default new Vuex.Store({
  modules: {
    firstForm,
    secondForm
  },
  plugins: [
    vuexLocal.plugin,
    createPromise({
      debug: true,
      status: {
        PENDING: 'PENDING',
        SUCCESS: 'FULFILLED',
        FAILURE: 'REJECTED'
      },
      silent: false
    })
  ]
})