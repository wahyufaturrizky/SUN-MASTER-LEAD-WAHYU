import * as types from '../types'
import qs from 'qs'

// initial state
// shape: [{ id, quantity }]
const state = {
  name: '',
  phone: '',
  email: '',
  birth: '',
  birthDate: {
      day: '',
      month: '',
      year: ''
  },
  gender: 'm',
  parents: {
    name: '',
    phone: '',
    email: ''
  },
  city: '',
  address: '',
  zipcode: {},
  phone_home: '',
  edu_grade: {},
  school_name: {},
  major_interest: '',
  destination: {},
  program: {},
  plan_year: {},
  marketing_source: {},
  office: {},
  program_interest: {},
  contact_sun: false,
  ziplist: [],
  highestEdu: [],
  precur: [],
  destOfStudy: [],
  programList: [],
  marketingList: [],
  officeList: [],
  years: [{
    id: 2019,
    name: '2019'
  }, {
    id: 2020,
    name: '2020'
  }, {
    id: 2021,
    name: '2021'
  }, {
    id: 2022,
    name: '2022'
  }, {
    id: 2023,
    name: '2023'
  }, {
    id: 2024,
    name: '2024'
  }, {
    id: 2025,
    name: '2025'
  }],
  isLoading: false,
  isSuccess: false,
  isError: false,
  isSubmitSuccss: false,
  isSubmitLoading: false,
  isSubmitError: false
}

// getters
const getters = {
  selectedEdu: (state, getters) => {
    return state.edu_grade.id ? state.edu_grade.id : ""
  },
  selectedZipcode: (state, getters) => {
    return state.zipcode.id ? state.zipcode.id : ""
  },
  selectedDestination: (state, getters) => {
    return state.destination.id ? state.destination.id : ""
  },
  selectedProgram: (state, getters) => {
    return state.program.id ? state.program.name : ""
  },
  selectedYear: (state, getters) => {
    return state.plan_year.id ? state.plan_year.id : ""
  },
  selectedOffice: (state, getters) => {
    return state.office ? state.office : ""
  },
  selectedPrecur: (state, getters) => {
    return state.school_name ? state.school_name : ""
  },
  selectedMarketing: (state, getters) => {
    return state.marketing_source.id ? state.marketing_source.id : ""
  },
  selectedProgramInterest: (state, getters) => {
    return state.program_interest.id ? state.program_interest.id : ""
  },
  submitStatus: (state, getters) => {
    return {
      isLoading: state.isSubmitLoading,
      isSuccess: state.isSubmitSuccess,
      isError: state.isSubmitError
    }
  }
  // cartProducts: (state, getters, rootState) => {
  //   return state.items.map(({ id, quantity }) => {
  //     const product = rootState.products.all.find(product => product.id === id)
  //     return {
  //       title: product.title,
  //       price: product.price,
  //       quantity
  //     }
  //   })
  // },

  // cartTotalPrice: (state, getters) => {
  //   return getters.cartProducts.reduce((total, product) => {
  //     return total + product.price * product.quantity
  //   }, 0)
  // }
}

// actions
const actions = {
  searchZip: ({ commit }, query) => {
    commit('searchZip', axios.get(`/data/postal-code/search/${query}`))
  },
  searchPrecur: ({ commit }, query) => {
      commit('searchPrecur', axios.get(`/data/school/search/${query}`))
  },
  getHighestEdu: ({ commit }) => {
    commit('getHighestEdu', axios.get(`/data/highest-edu`))
  },
  getPrecurSchool: ({ commit }) => {
    commit('getPrecurSchool', axios.get(`/data/precur-school`))
  },
  getDestinationStudy: ({ commit }) => {
    commit('getDestinationStudy', axios.get(`/data/destination-study`))
  },
  getProgramList: ({ commit }) => {
    commit('getProgramList', axios.get(`/data/program-interested`))
  },
  getMarketingSource: ({ commit }) => {
    commit('getMarketingSource', axios.get(`/data/marketing-source`))
  },
  getOfficeList: ({ commit }) => {
    commit('getOfficeList', axios.get(`/data/branch`))
  },
  submitData: ({ commit }, data) => {
    commit('submitData', axios.post(`/registration/add`, qs.stringify(data), {
      headers: {
        'Accept': 'application/json'
      }
    }))
  },
  resetForm: ({ commit }) => {
      commit('resetForm')
  }
  // searchZip: ({ commit }, query) => {
  //   commit(types.SEARCH_ZIP_LOADING)
  //   axios.get(`/apply/postal-code/search/${query}`)
  //   .then(response => {
  //     commit(types.SEARCH_ZIP_FULFILLED, response.data)
  //   })
  //   .catch(e => {
  //     commit(types.SEARCH_ZIP_REJECTED);
  //   });
  // }
  // checkout ({ commit, state }, products) {
  //   const savedCartItems = [...state.items]
  //   commit('setCheckoutStatus', null)
  //   // empty cart
  //   commit('setCartItems', { items: [] })
  //   shop.buyProducts(
  //     products,
  //     () => commit('setCheckoutStatus', 'successful'),
  //     () => {
  //       commit('setCheckoutStatus', 'failed')
  //       // rollback to the cart saved before sending the request
  //       commit('setCartItems', { items: savedCartItems })
  //     }
  //   )
  // },

  // addProductToCart ({ state, commit }, product) {
  //   commit('setCheckoutStatus', null)
  //   if (product.inventory > 0) {
  //     const cartItem = state.items.find(item => item.id === product.id)
  //     if (!cartItem) {
  //       commit('pushProductToCart', { id: product.id })
  //     } else {
  //       commit('incrementItemQuantity', cartItem)
  //     }
  //     // remove 1 item from stock
  //     commit('products/decrementProductInventory', { id: product.id }, { root: true })
  //   }
  // }
}

// mutations
const mutations = {
    searchZip: (state, { payload, meta }) => {
        if (meta) {
            switch(meta.promise) {
                case 'PENDING':
                state.isLoading = true
                state.isSuccess = false
                state.isError = false
                break;

                case 'FULFILLED':
                state.ziplist = payload.data
                state.isLoading = false
                state.isSuccess = true
                state.isError = false
                break;

                case 'REJECTED':
                state.isLoading = false
                state.isSuccess = false
                state.isError = true
                break;

                default:
                return
            }
        }
    },
    searchPrecur: (state, { payload, meta }) => {
        if (meta) {
            switch(meta.promise) {
                case 'PENDING':
                state.isLoading = true
                state.isSuccess = false
                state.isError = false
                break;

                case 'FULFILLED':
                state.precur = payload.data
                state.isLoading = false
                state.isSuccess = true
                state.isError = false
                break;

                case 'REJECTED':
                state.isLoading = false
                state.isSuccess = false
                state.isError = true
                break;

                default:
                return
            }
        }
    },
    getHighestEdu: (state, { payload, meta }) => {
        if (meta) {
            switch(meta.promise) {
                case 'PENDING':
                state.highestEdu = []
                state.isLoading = true
                state.isSuccess = false
                state.isError = false
                break;

                case 'FULFILLED':
                state.highestEdu = payload.data
                state.isLoading = false
                state.isSuccess = true
                state.isError = false
                break;

                case 'REJECTED':
                state.highestEdu = []
                state.isLoading = false
                state.isSuccess = false
                state.isError = true
                break;

                default:
                return
            }
        }
    },
    getPrecurSchool: (state, { payload, meta }) => {
        if (meta) {
            switch(meta.promise) {
                case 'PENDING':
                state.precur = []
                state.isLoading = true
                state.isSuccess = false
                state.isError = false
                break;

                case 'FULFILLED':
                state.precur = payload.data
                state.isLoading = false
                state.isSuccess = true
                state.isError = false
                break;

                case 'REJECTED':
                state.precur = []
                state.isLoading = false
                state.isSuccess = false
                state.isError = true
                break;

                default:
                return
            }
        }
    },
    getDestinationStudy: (state, { payload, meta }) => {
        if (meta) {
            switch(meta.promise) {
                case 'PENDING':
                state.destOfStudy = []
                state.isLoading = true
                state.isSuccess = false
                state.isError = false
                break;

                case 'FULFILLED':
                state.destOfStudy = payload.data
                state.isLoading = false
                state.isSuccess = true
                state.isError = false
                break;

                case 'REJECTED':
                state.destOfStudy = []
                state.isLoading = false
                state.isSuccess = false
                state.isError = true
                break;

                default:
                return
            }
        }
    },
    getProgramList: (state, { payload, meta }) => {
        if (meta) {
            switch(meta.promise) {
                case 'PENDING':
                state.programList = []
                state.isLoading = true
                state.isSuccess = false
                state.isError = false
                break;

                case 'FULFILLED':
                state.programList = payload.data
                state.isLoading = false
                state.isSuccess = true
                state.isError = false
                break;

                case 'REJECTED':
                state.programList = []
                state.isLoading = false
                state.isSuccess = false
                state.isError = true
                break;

                default:
                return
            }
        }
    },
    getMarketingSource: (state, { payload, meta }) => {
        if (meta) {
            switch(meta.promise) {
                case 'PENDING':
                state.marketingList = []
                state.isLoading = true
                state.isSuccess = false
                state.isError = false
                break;

                case 'FULFILLED':
                state.marketingList = payload.data
                state.isLoading = false
                state.isSuccess = true
                state.isError = false
                break;

                case 'REJECTED':
                state.marketingList = []
                state.isLoading = false
                state.isSuccess = false
                state.isError = true
                break;

                default:
                return
            }
        }
    },
    getOfficeList: (state, { payload, meta}) => {
      if (meta) {
        switch(meta.promise) {
          case 'PENDING':
          state.marketingList = []
          state.isLoading = true
          state.isSuccess = false
          state.isError = false
          break;

          case 'FULFILLED':
          state.officeList = payload.data
          state.isLoading = false
          state.isSuccess = true
          state.isError = false
          break;

          case 'REJECTED':
          state.marketingList = []
          state.isLoading = false
          state.isSuccess = false
          state.isError = true
          break;

          default:
          return
        }
      }
    },
    submitData: (state, { payload, meta }) => {
      if (meta) {
          switch(meta.promise) {
              case 'PENDING':
              state.isSubmitLoading = true
              state.isSubmitSuccess = false
              state.isSubmitError = false
              break;

              case 'FULFILLED':
              state.isSubmitLoading = false
              state.isSubmitSuccess = true
              state.isSubmitError = false
              break;

              case 'REJECTED':
              state.isSubmitLoading = false
              state.isSubmitSuccess = false
              state.isSubmitError = true
              break;

              default:
              return
          }
      }
    },
    resetForm: (state) => {
        state.name = ''
        state.phone = ''
        state.email = ''
        state.birth = ''
        state.birthDate.day = ''
        state.birthDate.month = ''
        state.birthDate.year = ''
        state.gender = 'm'
        state.parents.name = ''
        state.parents.phone = ''
        state.parents.email = ''
        state.city = ''
        state.address = ''
        state.zipcode = {}
        state.phone_home = ''
        state.edu_grade = {}
        state.school_name = {}
        state.major_interest = ''
        state.destination = {}
        state.program = {}
        state.plan_year = {}
        state.marketing_source = {}
        state.office = {}
        state.program_interest = {}
        state.contact_sun = false
    }
  // [types.SEARCH_ZIP_LOADING]: (state, payload) => {
  //   state.isLoading = true
  //   state.isSuccess = false
  //   state.isError = false
  //   state.errors = []
  // },
  // [types.SEARCH_ZIP_FULFILLED]: (state, payload) => {
  //   state.ziplist = payload
  //   state.isLoading = false
  //   state.isSuccess = true
  //   state.isError = false
  //   state.errors = []
  // },
  // [types.SEARCH_ZIP_REJECTED]: (state, payload) => {
  //   state.ziplist = []
  //   state.isLoading = false
  //   state.isSuccess = false
  //   state.isError = true
  // }
  // pushProductToCart (state, { id }) {
  //   state.items.push({
  //     id,
  //     quantity: 1
  //   })
  // },

  // incrementItemQuantity (state, { id }) {
  //   const cartItem = state.items.find(item => item.id === id)
  //   cartItem.quantity++
  // },

  // setCartItems (state, { items }) {
  //   state.items = items
  // },

  // setCheckoutStatus (state, status) {
  //   state.checkoutStatus = status
  // }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
